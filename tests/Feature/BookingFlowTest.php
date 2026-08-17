<?php

use App\Livewire\Client\Checkout;
use App\Livewire\Client\VehicleDetail;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('allows a user to view the vehicle catalog', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available']);

    $this->get(route('catalog'))
        ->assertSee($vehicle->make)
        ->assertSee($vehicle->model);
});

it('allows a user to select dates on the vehicle detail page', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);

    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->set('pickup_date', now()->addDay()->format('Y-m-d'))
        ->set('return_date', now()->addDays(3)->format('Y-m-d'))
        ->call('calculateQuote')
        ->assertSet('days', 2)
        ->assertSet('total_estimate', 200)
        ->call('continueToBooking')
        ->assertRedirect(route('checkout', $vehicle));
});

it('allows a user to complete the checkout process', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);
    $user = User::factory()->create();

    session([
        'booking_pickup_date' => now()->addDay()->format('Y-m-d'),
        'booking_return_date' => now()->addDays(3)->format('Y-m-d'),
        'booking_estimate' => 200,
        'booking_days' => 2,
    ]);

    Livewire::actingAs($user)
        ->test(Checkout::class, ['vehicle' => $vehicle])
        ->set('first_name', 'John')
        ->set('last_name', 'Doe')
        ->set('email', 'john@example.com')
        ->set('phone', '1234567890')
        ->set('address', '123 Main St')
        ->set('date_of_birth', '1990-01-01')
        ->set('drivers_license', 'DL123456')
        ->set('pickup_location', 'Rock Sound International Airport')
        ->set('pickup_time', '12:00')
        ->set('return_location', 'Rock Sound International Airport')
        ->set('return_time', '12:00')
        ->set('payment_type', 'Credit Card')
        ->set('agreed_to_terms', true)
        ->set('renter_name', 'John Doe')
        ->set('renter_signature', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==')
        ->call('processBooking')
        ->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('orders', [
        'vehicle_id' => $vehicle->id,
        'guest_email' => 'john@example.com',
        'status' => 'confirmed'
    ]);

    $this->assertDatabaseHas('rental_agreements', [
        'vehicle_id' => $vehicle->id,
        'email' => 'john@example.com',
        'payment_type' => 'Credit Card',
        'total_due' => 300, // 200 estimate + 100 deposit
    ]);
});

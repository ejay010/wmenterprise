<?php

use App\Livewire\Client\Checkout;
use App\Livewire\Client\VehicleDetail;
use App\Mail\AdminNewBookingMail;
use App\Mail\RentalConfirmationMail;
use App\Models\BlackoutDate;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('detects when dates overlap with an existing confirmed order and prevents booking', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);

    // Create an existing order for days 5 to 10
    Order::factory()->create([
        'vehicle_id' => $vehicle->id,
        'start_date' => now()->addDays(5)->format('Y-m-d'),
        'end_date' => now()->addDays(10)->format('Y-m-d'),
        'status' => 'confirmed',
    ]);

    // Test overlapping range in VehicleDetail
    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->set('pickup_date', now()->addDays(6)->format('Y-m-d'))
        ->set('return_date', now()->addDays(8)->format('Y-m-d'))
        ->call('calculateQuote')
        ->assertSet('is_available', false)
        ->call('continueToBooking')
        ->assertHasErrors(['pickup_date']);

    // Non-overlapping range should succeed
    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->set('pickup_date', now()->addDays(1)->format('Y-m-d'))
        ->set('return_date', now()->addDays(3)->format('Y-m-d'))
        ->call('calculateQuote')
        ->assertSet('is_available', true)
        ->call('continueToBooking')
        ->assertHasNoErrors()
        ->assertRedirect(route('checkout', $vehicle));
});

it('prevents booking when dates fall within a vehicle-specific blackout date', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);
    $otherVehicle = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);

    BlackoutDate::create([
        'vehicle_id' => $vehicle->id,
        'start_date' => now()->addDays(10)->format('Y-m-d'),
        'end_date' => now()->addDays(15)->format('Y-m-d'),
        'reason' => 'Scheduled Maintenance',
    ]);

    // First vehicle is blocked
    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->set('pickup_date', now()->addDays(11)->format('Y-m-d'))
        ->set('return_date', now()->addDays(13)->format('Y-m-d'))
        ->call('calculateQuote')
        ->assertSet('is_available', false)
        ->call('continueToBooking')
        ->assertHasErrors(['pickup_date']);

    // Other vehicle is unaffected and available
    Livewire::test(VehicleDetail::class, ['vehicle' => $otherVehicle])
        ->set('pickup_date', now()->addDays(11)->format('Y-m-d'))
        ->set('return_date', now()->addDays(13)->format('Y-m-d'))
        ->call('calculateQuote')
        ->assertSet('is_available', true)
        ->call('continueToBooking')
        ->assertHasNoErrors();
});

it('prevents booking any vehicle when dates fall within a platform-wide blackout date', function () {
    $vehicle1 = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);
    $vehicle2 = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);

    // Platform-wide closure (vehicle_id = null)
    BlackoutDate::create([
        'vehicle_id' => null,
        'start_date' => now()->addDays(20)->format('Y-m-d'),
        'end_date' => now()->addDays(22)->format('Y-m-d'),
        'reason' => 'Holiday Platform Closure',
    ]);

    // Vehicle 1 is blocked
    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle1])
        ->set('pickup_date', now()->addDays(20)->format('Y-m-d'))
        ->set('return_date', now()->addDays(21)->format('Y-m-d'))
        ->call('calculateQuote')
        ->assertSet('is_available', false)
        ->call('continueToBooking')
        ->assertHasErrors(['pickup_date']);

    // Vehicle 2 is also blocked
    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle2])
        ->set('pickup_date', now()->addDays(21)->format('Y-m-d'))
        ->set('return_date', now()->addDays(22)->format('Y-m-d'))
        ->call('calculateQuote')
        ->assertSet('is_available', false)
        ->call('continueToBooking')
        ->assertHasErrors(['pickup_date']);
});

it('sends email notifications to both customer and admin upon booking', function () {
    Mail::fake();

    $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin@wmenterprises.test']);
    $customer = User::factory()->create(['role' => 'registered', 'email' => 'customer@test.com']);
    $vehicle = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);

    session([
        'booking_pickup_date' => now()->addDays(2)->format('Y-m-d'),
        'booking_return_date' => now()->addDays(4)->format('Y-m-d'),
        'booking_estimate' => 200,
        'booking_days' => 2,
    ]);

    Livewire::actingAs($customer)
        ->test(Checkout::class, ['vehicle' => $vehicle])
        ->set('first_name', 'Jane')
        ->set('last_name', 'Customer')
        ->set('email', 'customer@test.com')
        ->set('phone', '1234567890')
        ->set('address', '123 Ocean Blvd')
        ->set('date_of_birth', '1995-05-15')
        ->set('drivers_license', 'DL998877')
        ->set('pickup_location', 'Rock Sound International Airport')
        ->set('pickup_time', '10:00')
        ->set('return_location', 'Rock Sound International Airport')
        ->set('return_time', '10:00')
        ->set('payment_type', 'Credit Card')
        ->set('agreed_to_terms', true)
        ->set('renter_name', 'Jane Customer')
        ->set('renter_signature', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==')
        ->call('processBooking');

    // Customer confirmation email sent
    Mail::assertSent(RentalConfirmationMail::class, function ($mail) {
        return $mail->hasTo('customer@test.com');
    });

    // Admin notification email sent
    Mail::assertSent(AdminNewBookingMail::class, function ($mail) {
        return $mail->hasTo('admin@wmenterprises.test');
    });
});

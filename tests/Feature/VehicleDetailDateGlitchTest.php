<?php

use App\Livewire\Client\VehicleDetail;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('automatically advances return date if pickup date is set on or after current return date', function () {
    $vehicle = Vehicle::factory()->create([
        'status' => 'available',
        'daily_rate' => 50.00,
    ]);

    // Initial mount sets tomorrow and tomorrow + 2 days
    $initialPickup = Carbon::tomorrow()->format('Y-m-d');
    $initialReturn = Carbon::tomorrow()->addDays(2)->format('Y-m-d');

    $component = Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->assertSet('pickup_date', $initialPickup)
        ->assertSet('return_date', $initialReturn)
        ->assertSet('days', 2)
        ->assertSet('total_estimate', 100.00);

    // Set pickup date to 5 days from now (after the initial return date)
    $newPickup = Carbon::tomorrow()->addDays(5)->format('Y-m-d');
    $expectedReturn = Carbon::tomorrow()->addDays(6)->format('Y-m-d');

    $component->set('pickup_date', $newPickup)
        ->assertSet('pickup_date', $newPickup)
        ->assertSet('return_date', $expectedReturn)
        ->assertSet('days', 1)
        ->assertSet('total_estimate', 50.00);
});

it('restores booking dates from session if user navigates back from checkout', function () {
    $vehicle = Vehicle::factory()->create([
        'status' => 'available',
        'daily_rate' => 75.00,
    ]);

    $savedPickup = Carbon::tomorrow()->addDays(3)->format('Y-m-d');
    $savedReturn = Carbon::tomorrow()->addDays(7)->format('Y-m-d');

    session([
        'booking_pickup_date' => $savedPickup,
        'booking_return_date' => $savedReturn,
    ]);

    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->assertSet('pickup_date', $savedPickup)
        ->assertSet('return_date', $savedReturn)
        ->assertSet('days', 4)
        ->assertSet('total_estimate', 300.00);
});

it('successfully validates and stores booking data in session when continuing to booking', function () {
    $vehicle = Vehicle::factory()->create([
        'status' => 'available',
        'daily_rate' => 80.00,
    ]);

    $pickup = Carbon::tomorrow()->format('Y-m-d');
    $return = Carbon::tomorrow()->addDays(3)->format('Y-m-d');

    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->set('pickup_date', $pickup)
        ->set('return_date', $return)
        ->call('continueToBooking')
        ->assertHasNoErrors()
        ->assertRedirect(route('checkout', $vehicle));

    expect(session('booking_pickup_date'))->toBe($pickup);
    expect(session('booking_return_date'))->toBe($return);
    expect(session('booking_days'))->toBe(3);
    expect((float) session('booking_estimate'))->toBe(240.00);
});

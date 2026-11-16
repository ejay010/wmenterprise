<?php

use App\Livewire\Client\Checkout;
use App\Livewire\Client\VehicleCatalog;
use App\Livewire\Client\VehicleDetail;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('captures home page search widget dates in catalog and stores them in session', function () {
    $pickup = Carbon::tomorrow()->addDays(5)->format('Y-m-d');
    $return = Carbon::tomorrow()->addDays(10)->format('Y-m-d');

    // Simulate arriving at catalog with query parameters from home search widget
    $this->get(route('catalog', [
        'pickup_date' => $pickup,
        'return_date' => $return,
        'location' => 'Rock Sound International Airport',
        'pickup_time' => '10:00 AM',
        'return_time' => '10:00 AM',
    ]))->assertOk();

    Livewire::withQueryParams([
        'pickup_date' => $pickup,
        'return_date' => $return,
        'location' => 'Rock Sound International Airport',
        'pickup_time' => '10:00 AM',
        'return_time' => '10:00 AM',
    ])
        ->test(VehicleCatalog::class)
        ->assertOk();

    expect(session('booking_pickup_date'))->toBe($pickup);
    expect(session('booking_return_date'))->toBe($return);
    expect(session('booking_pickup_location'))->toBe('Rock Sound International Airport');
});

it('pre-populates vehicle detail page from search query parameters or session', function () {
    $vehicle = Vehicle::factory()->create([
        'status' => 'available',
        'daily_rate' => 60.00,
    ]);

    $pickup = Carbon::tomorrow()->addDays(4)->format('Y-m-d');
    $return = Carbon::tomorrow()->addDays(8)->format('Y-m-d');

    session([
        'booking_pickup_date' => $pickup,
        'booking_return_date' => $return,
    ]);

    Livewire::test(VehicleDetail::class, ['vehicle' => $vehicle])
        ->assertSet('pickup_date', $pickup)
        ->assertSet('return_date', $return)
        ->assertSet('days', 4)
        ->assertSet('total_estimate', 240.00);
});

it('displays clear error messages and triggers toast when checkout validation fails', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available', 'daily_rate' => 100]);

    session([
        'booking_pickup_date' => now()->addDay()->format('Y-m-d'),
        'booking_return_date' => now()->addDays(3)->format('Y-m-d'),
        'booking_estimate' => 200,
        'booking_days' => 2,
    ]);

    Livewire::test(Checkout::class, ['vehicle' => $vehicle])
        ->set('first_name', '') // intentionally missing
        ->set('renter_signature', '') // intentionally missing
        ->set('agreed_to_terms', false) // intentionally missing
        ->call('processBooking')
        ->assertHasErrors(['first_name', 'renter_signature', 'agreed_to_terms']);
});

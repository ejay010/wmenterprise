<?php

use App\Livewire\Admin\BlackoutDates;
use App\Models\BlackoutDate;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('prevents non-admins from accessing the blackout dates management page', function () {
    $user = User::factory()->create(['role' => 'registered']);

    $this->actingAs($user)
        ->get(route('admin.blackout-dates.index'))
        ->assertForbidden();
});

it('allows an admin to view blackout dates and create a platform-wide blackout period', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Livewire::actingAs($admin)
        ->test(BlackoutDates::class)
        ->set('vehicle_id', '') // platform-wide
        ->set('start_date', '2026-12-24')
        ->set('end_date', '2026-12-26')
        ->set('reason', 'Christmas Platform Closure')
        ->call('save')
        ->assertHasNoErrors();

    $blackout = BlackoutDate::where('reason', 'Christmas Platform Closure')->first();
    $this->assertNotNull($blackout);
    $this->assertNull($blackout->vehicle_id);
    $this->assertEquals('2026-12-24', $blackout->start_date->format('Y-m-d'));
    $this->assertEquals('2026-12-26', $blackout->end_date->format('Y-m-d'));
});

it('allows an admin to create a vehicle-specific blackout period and delete it', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $vehicle = Vehicle::factory()->create();

    $component = Livewire::actingAs($admin)
        ->test(BlackoutDates::class)
        ->set('vehicle_id', $vehicle->id)
        ->set('start_date', '2026-11-01')
        ->set('end_date', '2026-11-05')
        ->set('reason', 'Engine Maintenance')
        ->call('save')
        ->assertHasNoErrors();

    $blackout = BlackoutDate::where('vehicle_id', $vehicle->id)->first();
    $this->assertNotNull($blackout);

    // Delete the blackout date
    $component->call('deleteBlackoutDate', $blackout->id);

    $this->assertDatabaseMissing('blackout_dates', [
        'id' => $blackout->id,
    ]);
});

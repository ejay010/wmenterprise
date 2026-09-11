<?php

use App\Livewire\Admin\VehicleForm;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('allows an admin to create a vehicle with only make and model provided', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Livewire::actingAs($admin)
        ->test(VehicleForm::class)
        ->set('make', 'Honda')
        ->set('model', 'Civic')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.vehicles.index'));

    $this->assertDatabaseHas('vehicles', [
        'make' => 'Honda',
        'model' => 'Civic',
        'year' => null,
        'color' => null,
        'class' => null,
        'max_passengers' => null,
        'fuel_type' => 'Gas',
        'gearbox' => null,
        'license_plate' => null,
        'daily_rate' => 0,
        'status' => 'available',
    ]);
});

it('requires make and model when saving a vehicle', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Livewire::actingAs($admin)
        ->test(VehicleForm::class)
        ->set('make', '')
        ->set('model', '')
        ->call('save')
        ->assertHasErrors(['make' => 'required', 'model' => 'required']);
});

it('allows an admin to update an existing vehicle with optional fields left blank or populated', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $vehicle = Vehicle::factory()->create([
        'make' => 'Toyota',
        'model' => 'Corolla',
        'year' => '2022',
        'daily_rate' => 65.00,
    ]);

    Livewire::actingAs($admin)
        ->test(VehicleForm::class, ['vehicle' => $vehicle])
        ->set('make', 'Toyota')
        ->set('model', 'Corolla Hybrid')
        ->set('year', '')
        ->set('daily_rate', '')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.vehicles.index'));

    $vehicle->refresh();
    expect($vehicle->model)->toBe('Corolla Hybrid');
    expect($vehicle->year)->toBeNull();
    expect((float) $vehicle->daily_rate)->toBe(0.0);
});

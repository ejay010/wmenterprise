<?php

namespace App\Livewire\Admin;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * The VehicleList component handles displaying the fleet of vehicles to the admin.
 * It uses standard Livewire to separate logic from the view.
 */
class VehicleList extends Component
{
    // We include the WithPagination trait to easily handle paginating long lists of vehicles.
    // Livewire will automatically handle the page state in the URL query string.
    use WithPagination;

    /**
     * Delete a specific vehicle.
     *
     * @param  int  $id  The ID of the vehicle to delete.
     */
    public function deleteVehicle($id)
    {
        // First, we find the vehicle by ID. We use findOrFail to automatically throw a 404 error if it doesn't exist.
        $vehicle = Vehicle::findOrFail($id);

        // Delete the vehicle from the database.
        $vehicle->delete();

        // After deleting, we use Flux's toast notification system.
        \Flux::toast(text: 'Vehicle deleted successfully.', variant: 'success');
    }

    /**
     * The render method tells Livewire which view to load for this component.
     */
    public function render()
    {
        // We fetch the vehicles, ordered by the newest first, and paginate them (10 per page).
        $vehicles = Vehicle::latest()->paginate(10);

        // We pass the $vehicles variable to the Blade view.
        return view('livewire.admin.vehicle-list', [
            'vehicles' => $vehicles,
        ]);
    }
}

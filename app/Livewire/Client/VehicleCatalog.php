<?php

namespace App\Livewire\Client;

use App\Models\Vehicle;
use Livewire\Component;

/**
 * The VehicleCatalog component displays a public grid of all available vehicles.
 */
class VehicleCatalog extends Component
{
    public function render()
    {
        // Fetch only vehicles that are 'available'. We eager load the 'images' relationship 
        // to avoid N+1 queries when rendering the featured images in the view.
        $vehicles = Vehicle::with('images')->where('status', 'available')->get();

        // Pass the vehicles to the view. 
        // We use a custom guest layout (usually 'layouts.guest' or a custom frontend layout)
        return view('livewire.client.vehicle-catalog', [
            'vehicles' => $vehicles,
        ])->layout('layouts.client'); // We stick with layouts.app for simplicity in this MVP.
    }
}

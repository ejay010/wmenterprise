<?php

namespace App\Livewire\Client;

use App\Models\Vehicle;
use Livewire\Component;

/**
 * The VehicleCatalog component displays a public grid of all available vehicles.
 */
class VehicleCatalog extends Component
{
    /**
     * Capture search criteria from the homepage booking widget (GET parameters)
     * and persist them into the session so when a user selects a vehicle,
     * their selected dates and locations are preserved.
     */
    public function mount()
    {
        if (request()->filled('pickup_date')) {
            session([
                'booking_pickup_date' => request('pickup_date'),
                'booking_return_date' => request('return_date'),
                'booking_pickup_location' => request('location'),
                'booking_pickup_time' => request('pickup_time'),
                'booking_return_time' => request('return_time'),
            ]);
        }
    }

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

<?php

namespace App\Livewire\Client;

use App\Models\Order;
use Livewire\Component;

/**
 * The ThankYou component displays booking confirmation details to renters
 * (both guests and registered users) immediately following checkout.
 */
class ThankYou extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        // Load relationships needed for rendering the summary
        $this->order = $order->load(['vehicle.images', 'rentalAgreement', 'transactions']);
    }

    public function render()
    {
        return view('livewire.client.thank-you')->layout('layouts.client');
    }
}

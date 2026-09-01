<?php

namespace App\Livewire\Client;

use App\Models\Vehicle;
use Carbon\Carbon;
use Livewire\Component;

/**
 * The VehicleDetail component shows the full details of a vehicle and
 * provides a dynamic quote calculator based on selected dates.
 */
class VehicleDetail extends Component
{
    // The vehicle model being viewed
    public Vehicle $vehicle;

    // User input fields for the date picker
    public $pickup_date;

    public $return_date;

    // The calculated cost
    public $total_estimate = 0;

    public $days = 0;

    public $is_available = true;

    public $availability_message = null;

    /**
     * Called when the component is mounted (initialized).
     */
    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        // Set initial default dates
        $this->pickup_date = Carbon::tomorrow()->format('Y-m-d');
        $this->return_date = Carbon::tomorrow()->addDays(2)->format('Y-m-d');

        // Calculate the initial quote and check availability
        $this->calculateQuote();
    }

    /**
     * This magic Livewire method is triggered automatically whenever ANY property is updated.
     * We use it to recalculate the quote if the user changes the dates.
     */
    public function updated($property)
    {
        if (in_array($property, ['pickup_date', 'return_date'])) {
            $this->resetErrorBag();
            $this->calculateQuote();
        }
    }

    /**
     * Calculate the rental duration in days and multiply by the daily rate.
     */
    public function calculateQuote()
    {
        $this->is_available = true;
        $this->availability_message = null;

        if ($this->pickup_date && $this->return_date) {
            try {
                $start = Carbon::parse($this->pickup_date)->startOfDay();
                $end = Carbon::parse($this->return_date)->startOfDay();

                // Ensure the return date is after the pick up date
                if ($end->greaterThan($start)) {
                    $this->days = $start->diffInDays($end);
                    $this->total_estimate = $this->days * $this->vehicle->daily_rate;

                    // Check availability for these dates
                    if (! $this->vehicle->isAvailableForDates($this->pickup_date, $this->return_date)) {
                        $this->is_available = false;
                        $this->availability_message = 'This vehicle is not available for the selected dates (already booked or blacked out). Please select different dates.';
                    }
                } else {
                    $this->days = 0;
                    $this->total_estimate = 0;
                }
            } catch (\Exception $e) {
                $this->days = 0;
                $this->total_estimate = 0;
            }
        }
    }

    /**
     * Handles the "Continue to Booking" action.
     * Stores the selected dates in the session so the checkout page can read them,
     * then redirects to the checkout route.
     */
    public function continueToBooking()
    {
        // 1. Validate dates are selected and valid
        $this->validate([
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        // 2. Enforce availability check
        if (! $this->vehicle->isAvailableForDates($this->pickup_date, $this->return_date)) {
            $this->is_available = false;
            $this->addError('pickup_date', 'This vehicle is not available for the selected dates.');

            return;
        }

        // 3. Store the dates in session
        session([
            'booking_pickup_date' => $this->pickup_date,
            'booking_return_date' => $this->return_date,
            'booking_days' => $this->days,
            'booking_estimate' => $this->total_estimate,
        ]);

        // 4. Redirect to the checkout page
        return $this->redirectRoute('checkout', $this->vehicle, navigate: true);
    }

    public function render()
    {
        return view('livewire.client.vehicle-detail', [
            'unavailableRanges' => $this->vehicle->getUnavailableDateRanges(),
        ])->layout('layouts.client');
    }
}

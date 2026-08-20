<?php

namespace App\Livewire\Client;

use App\Models\Order;
use App\Models\RentalAgreement;
use App\Models\Transaction;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

/**
 * The Checkout component handles capturing the renter's details, signature,
 * and processing a simulated mock payment.
 */
class Checkout extends Component
{
    public Vehicle $vehicle;

    // Fields mapping to the Rental Agreement PDF
    public $first_name;

    public $last_name;

    public $date_of_birth;

    public $drivers_license;

    public $address;

    public $email;

    public $phone;

    public $pickup_location = 'Rock Sound International Airport';

    public $pickup_time = '10:00';

    public $return_location = 'Rock Sound International Airport';

    public $return_time = '10:00';

    public $payment_type = 'Credit Card';

    public $agreed_to_terms = false;

    public $renter_name; // Printed name for signature

    public $renter_signature; // Base64 data from Alpine canvas

    // Data passed from the VehicleDetail component via Session
    public $pickup_date;

    public $return_date;

    public $days;

    public $total_estimate;

    public $deposit = 0;

    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        // Retrieve session data that was set in VehicleDetail
        $this->pickup_date = session('booking_pickup_date');
        $this->return_date = session('booking_return_date');
        $this->days = session('booking_days');
        $this->total_estimate = session('booking_estimate');

        // Let's enforce a standard deposit of $100 for this MVP
        $this->deposit = 100.00;

        // If someone landed here without session data, kick them back to catalog
        if (! $this->pickup_date || ! $this->return_date || ! $this->days) {
            return redirect()->route('catalog');
        }

        // If the user is logged in, auto-fill some fields to save them time
        if (auth()->check()) {
            $user = auth()->user();
            $names = explode(' ', $user->name, 2);
            $this->first_name = $names[0] ?? '';
            $this->last_name = $names[1] ?? '';
            $this->email = $user->email;
        }
    }

    /**
     * Finalizes the booking by saving all data to the database in a transaction.
     */
    public function processBooking()
    {
        // 1. Comprehensive Validation to ensure all required fields are present
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'drivers_license' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'pickup_location' => 'required|string',
            'pickup_time' => 'required|string',
            'return_location' => 'required|string',
            'return_time' => 'required|string',
            'payment_type' => 'required|in:Cash,Credit Card,Direct Deposit',
            'agreed_to_terms' => 'accepted', // Must be true/1/on
            'renter_name' => 'required|string|max:255',
            'renter_signature' => 'required|string', // Base64 image data
        ]);

        // 2. Database Transaction
        // We use a database transaction to ensure that if something fails (e.g. payment issue),
        // we don't end up with partial data in the database. It's an all-or-nothing operation.
        DB::transaction(function () {

            $totalDue = $this->total_estimate + $this->deposit;

            // Step A: Create the Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'vehicle_id' => $this->vehicle->id,
                'guest_name' => $this->first_name.' '.$this->last_name,
                'guest_email' => $this->email,
                'guest_phone' => $this->phone,
                'start_date' => $this->pickup_date,
                'end_date' => $this->return_date,
                'total_amount' => $totalDue,
                'status' => 'confirmed',
            ]);

            // Step B: Create the formal Rental Agreement matching the PDF structure
            $agreement = RentalAgreement::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'vehicle_id' => $this->vehicle->id,

                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'date_of_birth' => $this->date_of_birth,
                'drivers_license' => $this->drivers_license,
                'address' => $this->address,
                'email' => $this->email,
                'phone' => $this->phone,

                'pickup_location' => $this->pickup_location,
                'pickup_date' => $this->pickup_date,
                'pickup_time' => $this->pickup_time,
                'return_location' => $this->return_location,
                'return_date' => $this->return_date,
                'return_time' => $this->return_time,

                'price_per_day' => $this->vehicle->daily_rate,
                'deposit' => $this->deposit,
                'total_due' => $totalDue,
                'payment_type' => $this->payment_type,

                'agreed_to_terms' => $this->agreed_to_terms,
                'renter_name' => $this->renter_name,
                'renter_signature' => $this->renter_signature,

                // Company rep will sign later, or we leave it blank for the PDF
                'company_representative_name' => null,
                'company_signature' => null,
                'signed_at' => now(),
                'status' => 'completed',
            ]);

            // Step C: Simulate Payment Gateway processing (Mock)
            // In a real app, you would call the PowerTranz API here and wait for a success response
            Transaction::create([
                'order_id' => $order->id,
                'amount' => $totalDue,
                'payment_method' => $this->payment_type,
                'gateway_reference' => 'MOCK-PTZ-'.uniqid(),
                'status' => 'successful',
            ]);

        });

        // 3. Clear session data so the user can't accidentally resubmit
        session()->forget(['booking_pickup_date', 'booking_return_date', 'booking_days', 'booking_estimate']);

        // 4. Provide feedback and redirect to dashboard where they can download their PDF
        \Flux::toast(text: 'Booking confirmed! You can now download your agreement.', variant: 'success');

        // If they are a guest, we might normally redirect to a generic success page.
        // For this MVP, we redirect to dashboard if logged in, or catalog if guest.
        if (auth()->check()) {
            return $this->redirectRoute('dashboard', navigate: true);
        } else {
            return $this->redirectRoute('catalog', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.client.checkout')->layout('layouts.client');
    }
}

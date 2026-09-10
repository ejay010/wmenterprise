<?php

namespace App\Livewire\Client;

use App\Mail\AdminContactInquiryMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

/**
 * The ContactForm component handles visitor inquiries.
 * It validates inputs, sends notification emails to administrators,
 * and displays instant feedback to the user.
 */
class ContactForm extends Component
{
    /**
     * Form input properties bound via wire:model in the view.
     */
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $airport = 'Rock Sound International (RSD)';

    public string $message = '';

    /**
     * Tracks whether the form was successfully submitted.
     */
    public bool $submitted = false;

    /**
     * Validation rules for the contact inquiry form.
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'airport' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    /**
     * Custom friendly validation messages.
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'Please provide your full name.',
            'email.required' => 'Please provide a valid email address so we can reach you.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please enter your message or inquiry.',
            'message.min' => 'Please enter at least 10 characters in your message.',
        ];
    }

    /**
     * Submit the inquiry and email administrator(s).
     */
    public function submit(): void
    {
        // 1. Validate the form inputs against the defined rules
        $validated = $this->validate();

        // 2. Locate administrator email addresses to receive the inquiry
        $adminEmails = User::where('role', 'admin')->pluck('email')->filter()->all();

        // Fallback to default configured system mail address if no admin user is in database
        if (empty($adminEmails) && config('mail.from.address')) {
            $adminEmails = [config('mail.from.address')];
        }

        // 3. Send email notification to each administrator
        try {
            foreach ($adminEmails as $adminEmail) {
                Mail::to($adminEmail)->send(new AdminContactInquiryMail(
                    senderName: $this->name,
                    senderEmail: $this->email,
                    senderPhone: $this->phone ? trim($this->phone) : null,
                    preferredAirport: $this->airport,
                    inquiryMessage: $this->message,
                ));
            }
        } catch (\Throwable $e) {
            // Log any mail server connection errors without breaking user experience
            Log::error('Failed to send admin contact inquiry email: '.$e->getMessage());
        }

        // 4. Reset input fields and toggle the success state
        $this->reset(['name', 'email', 'phone', 'message']);
        $this->submitted = true;
    }

    /**
     * Allows the visitor to send another inquiry from the same page.
     */
    public function sendAnother(): void
    {
        $this->submitted = false;
    }

    public function render()
    {
        return view('livewire.client.contact-form');
    }
}

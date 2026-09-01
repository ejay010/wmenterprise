<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\RentalAgreement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable to notify administrator(s) when a new vehicle booking is placed.
 */
class AdminNewBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
        public RentalAgreement $agreement
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Booking Received - Order #'.$this->order->id.' ('.$this->order->vehicle->make.' '.$this->order->vehicle->model.')',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-new-booking',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

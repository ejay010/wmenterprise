<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable to notify administrator(s) when a new contact inquiry is submitted.
 */
class AdminContactInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance with contact form submission details.
     */
    public function __construct(
        public string $senderName,
        public string $senderEmail,
        public ?string $senderPhone,
        public ?string $preferredAirport,
        public string $inquiryMessage
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Inquiry from '.$this->senderName.' - WM Car Rental',
            replyTo: [
                new Address($this->senderEmail, $this->senderName),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-contact-inquiry',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

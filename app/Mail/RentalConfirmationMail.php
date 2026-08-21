<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\RentalAgreement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable to send rental agreement confirmation and attached PDF to the renter.
 */
class RentalConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public RentalAgreement $agreement,
        public Order $order
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rental Agreement Confirmation - Order #'.$this->order->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.rental-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        // Generate the PDF in-memory and attach it to the email
        $pdfOutput = Pdf::loadView('pdf.rental-agreement', ['agreement' => $this->agreement])->output();

        return [
            Attachment::fromData(fn () => $pdfOutput, 'rental-agreement-'.$this->agreement->id.'.pdf')
                ->withMime('application/pdf'),
        ];
    }
}

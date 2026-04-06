<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment; // <-- Make sure this is imported
use Illuminate\Queue\SerializesModels;

class TicketSale extends Mailable
{
    use Queueable, SerializesModels;

    // Added $pdfData to the constructor, and changed to public
    public function __construct(public $sale, public $password, public $pdfData)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADDRESS'),
            subject: 'Your Event Tickets & Receipt',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.ticket-sale', // <-- Changed from markdown to view
            with: [
                'sale' => $this->sale,
                'password' => $this->password
            ]
        );
    }

    public function attachments(): array
    {
        // Properly attaching the PDF from inside the Mailable
        return [
            Attachment::fromData(fn () => $this->pdfData, 'tickets.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
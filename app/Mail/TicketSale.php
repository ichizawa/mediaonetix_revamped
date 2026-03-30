<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class TicketSale extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected $sale, protected $password)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADRESS'),
            subject: 'Ticket Sale',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        Log::info("This is from TicketSale Mailable" . $this->sale);
        Log::info("This is from TicketSale Mailable" . $this->password);
        return new Content(
            markdown: 'mail.ticket-sale',
            // with: [
            //     'sale' => $this->sale,
            //     'password' => $this->password
            // ]
        );
    }

    public function build()
    {
        /*
        $pdf_size = array(0, 0, 400, 700);
        $pdf = PDF::loadView('mail.ticket')->setPaper($pdf_size);
        $ticket_name = $this->sale->ticket_num . '.pdf';

        $pdf->save(storage_path($ticket_name));
        */
        return $this->markdown('mail.ticket-sale')->with([
            'sale' => $this->sale,
            'password' => $this->password
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

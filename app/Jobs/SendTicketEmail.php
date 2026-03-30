<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TicketSale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendTicketEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tick;
    protected $resp;
    protected $sales;
    protected $pdf_size;
    protected $password;

    /**
     * Create a new job instance.
     */
    public function __construct($resp, $tick, $sales, $password)
    {
        $this->tick = $tick;
        $this->resp = $resp;
        $this->sales = $sales;
        // $this->pdf_size = [0, 0, 349, 573]; original size
        $this->pdf_size = [0, 0, 864, 280]; // Large Landscape: 12" x 6" (864x432 points)
        $this->password = $password;
        Log::info('Data in here __construct sendticketemail.php: ' . print_r($resp, true));
        Log::info('Data in here __construct sendticketemail.php ticket: ' . print_r($tick, true));
        Log::info('Data in here __construct sendticketemail.php sales: ' . print_r($sales, true));
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $mail = new TicketSale($this->resp, $this->password);
            // Log the data passed to the PDF
            Log::info('PDF data - tick:', (array) $this->tick);
            Log::info('PDF data - sales:', (array) $this->sales);
            $pdf = Pdf::loadView('mail.ticket', ['tick' => $this->tick, 'sales' => $this->sales])
                ->setPaper($this->pdf_size);

            // Set margins to zero using DomPDF options
            $pdf->getDomPDF()->getOptions()->set('margin_top', 0);
            $pdf->getDomPDF()->getOptions()->set('margin_right', 0);
            $pdf->getDomPDF()->getOptions()->set('margin_bottom', 0);
            $pdf->getDomPDF()->getOptions()->set('margin_left', 0);

            // Enable remote content for Google Fonts
            // $pdf->getDomPDF()->set_option('isRemoteEnabled', true);

            Log::info('Attempting to send email to: ' . $this->resp->customer_email);
            Mail::to($this->resp->customer_email)->send($mail->attachData($pdf->output(), 'tickets.pdf'));
            Log::info('Email successfully sent to: ' . $this->resp->customer_email);
        } catch (\Exception $e) {
            Log::error("Error sending email from jobs: " . $e->getMessage());
        }
    }
}

<?php

namespace App\Events;

use App\Models\Sales;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MerchantSales implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sale;

    public function __construct(Sales $sale)
    {
        $this->sale = $sale;
    }

    private function applyDiscount(Sales $sale): float
    {
        $ticket_price = floatval($sale->ticket->ticket_price ?? 0);

        if (!empty($sale->promo_code)) {
            $ticket_name = strtoupper($sale->ticket->ticket_type);

            if (in_array($ticket_name, ['PLATINUM', 'SVIP'])) {
                $ticket_price -= $ticket_price * 0.10;
            } elseif (in_array($ticket_name, ['GOLD', 'SILVER'])) {
                $ticket_price -= $ticket_price * 0.20;
            }
        }

        return $ticket_price;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('merchant-sales-channel');
    }

    public function broadcastAs(): string
    {
        return 'merchant-sales-updated';
    }

    public function broadcastWith(): array
    {
        // make sure the ticket relation is loaded
        $this->sale->load('ticket');

        return [
            'id' => $this->sale->id,
            'customer_name' => $this->sale->customer_name ?? "-",
            'customer_email' => $this->sale->customer_email ?? "-",
            'customer_contact' => $this->sale->customer_contact ?? "-",
            'customer_quantity' => $this->sale->customer_quantity ?? "-",
            'total_price' => $this->applyDiscount($this->sale) * $this->sale->customer_quantity ?? "-",
            'status' => $this->sale->status ?? "-",
            'customer_address' => $this->sale->customer_address ?? "-",
            'payment_method' => $this->sale->payment_method ?? "-",
            'customer_city' => $this->sale->customer_city ?? "-",
            'ticket_type' => $this->sale->ticket->ticket_name?? "-",
            'purchase_type' => $this->sale->purchase_type?? "-",
            'is_online' => $this->sale->is_online?? "-",
            'birthdate' => $this->sale->birthdate?? "-",
            'refno' => $this->sale->refno?? "-",
            'txnid' => $this->sale->txnid?? "-",
            'promo_code' => $this->sale->promo_code ?? "-",
            'event_id' => $this->sale->event_id ?? "-",
            'created_at' => $this->sale->created_at->format('d/m/Y h:i A') ?? "-",
        ];
    }
}

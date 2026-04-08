<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $sales;

    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    public function collection()
    {
        return $this->sales;
    }

    public function headings(): array
    {
        return [
            'Reference Number',
            'Customer Name',
            'Customer Email',
            'Event Name',
            'Ticket Name',
            'Quantity',
            'Total Amount',
            'Payment Method',
            'Status',
            'Date Created',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->reference_number,
            $sale->customer_name,
            $sale->customer_email,
            $sale->event->event_name ?? 'N/A',
            $sale->ticket->name ?? 'N/A',
            $sale->quantity,
            number_format($sale->total_amount, 2),
            $sale->payment_method ?? 'N/A',
            $sale->status_label['label'] ?? 'Unknown',
            $sale->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

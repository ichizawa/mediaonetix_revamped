<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $sales;
    protected $includeEventColumn;

    public function __construct($sales, bool $includeEventColumn = true)
    {
        $this->sales = $sales;
        $this->includeEventColumn = $includeEventColumn;
    }

    public function collection()
    {
        return $this->sales;
    }

    public function headings(): array
    {
        $headings = [
            'Reference Number',
            'Transaction ID',
            'Customer Name',
            'Customer Email',
            'Ticket Name',
            'Quantity',
            'Total Amount',
            'Payment Method',
            'Status',
            'Date Created',
        ];

        if ($this->includeEventColumn) {
            array_splice($headings, 4, 0, 'Event Name');
        }

        return $headings;
    }

    public function map($sale): array
    {
        $row = [
            $sale->reference_number,
            $sale->transaction_id ?? 'N/A',
            $sale->customer_name,
            $sale->customer_email,
            $sale->ticket->name ?? 'N/A',
            $sale->quantity,
            number_format($sale->total_amount, 2),
            $sale->payment_method ?? 'N/A',
            $sale->status_label['label'] ?? 'Unknown',
            $sale->created_at->format('Y-m-d H:i:s'),
        ];

        if ($this->includeEventColumn) {
            array_splice($row, 4, 0, $sale->event->event_name ?? 'N/A');
        }

        return $row;
    }
}

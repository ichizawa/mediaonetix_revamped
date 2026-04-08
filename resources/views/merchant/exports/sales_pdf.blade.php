<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Export</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Sales Report</h2>
        <p>Generated on: {{ \Carbon\Carbon::now()->format('F d, Y h:i A') }}</p>
        @if(isset($startDate) && isset($endDate))
            <p>Period: {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th>Reference</th>
                <th>Customer</th>
                <th>Event</th>
                <th>Ticket</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr>
                <td>{{ $sale->reference_number }}</td>
                <td>
                    {{ $sale->customer_name }}<br>
                    <small style="color:#666;">{{ $sale->customer_email }}</small>
                </td>
                <td>{{ $sale->event->event_name ?? 'N/A' }}</td>
                <td>{{ $sale->ticket->name ?? 'N/A' }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>PHP {{ number_format($sale->total_amount, 2) }}</td>
                <td>{{ $sale->status_label['label'] ?? 'Unknown' }}</td>
                <td>{{ $sale->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center;">No sales found for the selected period.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

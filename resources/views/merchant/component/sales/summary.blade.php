<div class="checkout-summary-col">
    <h3>Order Summary</h3>
    <div class="event-card">
        <div class="event-name">{{ $event->event_name ?? '-' }}</div>
        <div class="event-meta">Ticket: {{ $ticket->ticket_type ?? $ticket->type ?? $ticket->name ?? '-' }}</div>
        <div class="event-meta">Quantity: {{ $quantity }}</div>
    </div>
    <div class="summary-line">
        <span class="label">Unit Price</span>
        <span class="value">₱{{ number_format($unitPrice, 2) }}</span>
    </div>
    @if($promo && $totalDiscount > 0)
        <div class="summary-line">
            <span class="label">Promo ({{ $promo_code }})</span>
            <span class="value" style="color:#38bdf8;">-₱{{ number_format($totalDiscount, 2) }}</span>
        </div>
    @endif
    <div class="summary-line">
        <span class="label">Subtotal</span>
        <span class="value">₱{{ number_format($subtotal, 2) }}</span>
    </div>
    <div class="total-row">
        <span class="total-label">Total</span>
        <span class="total-val">₱{{ number_format($total, 2) }}</span>
    </div>
</div>

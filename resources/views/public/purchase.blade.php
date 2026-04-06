@extends('layouts')

@section('content')

    <style>
        .checkout-wrap {
            max-width: 1100px;
            margin: 60px auto 120px;
            padding: 0 20px;
            color: #f0eeff;
            font-family: 'Outfit', sans-serif;
        }

        .checkout-header {
            margin-bottom: 30px;
        }

        .checkout-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 0.04em;
            color: #fff;
            margin-bottom: 8px;
        }

        .checkout-header p {
            color: var(--muted, #9590b0);
            font-size: 1rem;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
            align-items: start;
        }

        /* Form Column */
        .checkout-form-col {
            background: var(--card, #141226);
            border: 1px solid var(--rim, rgba(255, 255, 255, 0.07));
            border-radius: 24px;
            padding: 32px;
        }

        .checkout-form-col h3 {
            font-size: 1.2rem;
            margin-bottom: 24px;
            color: #fff;
            border-bottom: 1px solid var(--rim, rgba(255, 255, 255, 0.07));
            padding-bottom: 12px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted, #9590b0);
            margin-bottom: 8px;
            font-family: 'Space Mono', monospace;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--rim2, rgba(255, 255, 255, 0.12));
            border-radius: 12px;
            padding: 14px 16px;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--accent, #38bdf8);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
        }

        .form-group input::placeholder {
            color: var(--muted, #6b6585);
        }

        /* Summary Column */
        .checkout-summary-col {
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.05), rgba(124, 58, 237, 0.05));
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 24px;
            padding: 32px;
            position: sticky;
            top: 24px;
        }

        .checkout-summary-col h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .event-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--rim, rgba(255, 255, 255, 0.07));
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }

        .event-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 6px;
        }

        .event-meta {
            font-size: 0.8rem;
            color: var(--muted2, #9590b0);
            line-height: 1.5;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px dashed var(--rim, rgba(255, 255, 255, 0.07));
            font-size: 0.95rem;
        }

        .summary-line .label {
            color: var(--muted2, #9590b0);
        }

        .summary-line .value {
            color: #fff;
            font-weight: 600;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--rim2, rgba(255, 255, 255, 0.12));
        }

        .total-label {
            font-size: 0.8rem;
            color: var(--muted2, #9590b0);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-family: 'Space Mono', monospace;
        }

        .total-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            color: var(--accent, #38bdf8);
            letter-spacing: 0.04em;
            line-height: 1;
        }

        .checkout-btn {
            width: 100%;
            padding: 18px;
            background: var(--accent, #38bdf8);
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            margin-top: 32px;
            transition: all 0.2s;
            box-shadow: 0 4px 24px rgba(56, 189, 248, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .checkout-btn:hover {
            background: #0ea5e9;
            box-shadow: 0 8px 36px rgba(56, 189, 248, 0.4);
            transform: translateY(-2px);
        }

        /* Responsive Layout */
        @media (max-width: 850px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }

            .checkout-summary-col {
                order: -1;
                /* Puts the summary on top for mobile */
                position: relative;
                top: 0;
            }
        }
    </style>

    <div class="checkout-wrap">
        <div class="checkout-header">
            <h1>Complete Purchase</h1>
            <p>Review your order and enter your billing details securely.</p>
        </div>

        <div class="checkout-grid">

            <div class="checkout-form-col">
                <form action="{{ route('create.sale') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div
                            style="background: rgba(244, 63, 94, 0.1); border: 1px solid var(--red, #f43f5e); color: #ff8a9f; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-size: 0.9rem;">
                            <ul style="margin-left: 20px; list-style-type: disc;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="hidden" name="event" value="{{ $event->id }}">
                    <input type="hidden" name="ticket" value="{{ $ticketId ?? '' }}" required>
                    <input type="hidden" name="quantity" value="{{ $quantity ?? '' }}" required>

                    <h3>Contact Information</h3>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="buyerName" name="customer_name" placeholder="Juan dela Cruz"
                            autocomplete="name" required value="{{ old('customer_name') }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" id="buyerEmail" name="customer_email" placeholder="juan@example.com"
                                autocomplete="email" required value="{{ old('customer_email') }}">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" id="buyerPhone" name="customer_phone" placeholder="+63 9XX XXX XXXX"
                                autocomplete="tel" required value="{{ old('customer_phone') }}">
                        </div>
                    </div>

                    <h3 style="margin-top: 16px;">Billing Address</h3>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" id="buyerAddress" name="address" placeholder="Street Address, Barangay"
                            required value="{{ old('address') }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="buyerCity" name="city" placeholder="City / Municipality" required
                                value="{{ old('city') }}">
                        </div>
                        <div class="form-group">
                            <label>Promo Code <span
                                    style="color:var(--muted); text-transform:none; letter-spacing:normal;">(Optional)</span></label>
                            <input type="text" id="promoCode" name="promo_code" placeholder="Discount code"
                                value="{{ old('promo_code') }}">
                        </div>
                    </div>

                    <h3 style="margin-top: 16px;">Payment Method</h3>
                    <div class="form-group">
                        <select name="payment_method" id="paymentMethod" required onchange="toggleCardFields()">
                            <option value="">Select Payment Method...</option>
                            <option value="gcash" {{ old('payment_method') == 'gcash' ? 'selected' : '' }}>GCash</option>
                            <option value="paymaya" {{ old('payment_method') == 'paymaya' ? 'selected' : '' }}>PayMaya
                            </option>
                            <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Credit / Debit
                                Card</option>

                            <option value="dob_bdo">BDO Online Banking</option>
                            <option value="dob_landbank">Landbank Online Banking</option>
                            <option value="dob_metrobank">Metrobank Online Banking</option>
                        </select>
                    </div>

                    <div id="cardFields"
                        style="display: none; background: rgba(0,0,0,0.25); padding: 20px; border-radius: 16px; margin-bottom: 14px; border: 1px solid var(--rim2, rgba(255,255,255,0.12));">
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="text" name="card_number" id="cardNumber" placeholder="4343 4343 4343 4345">
                        </div>
                        <div class="form-row" style="margin-bottom: 0;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Exp Month</label>
                                <input type="number" name="exp_month" id="expMonth" placeholder="12" min="1"
                                    max="12">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Exp Year</label>
                                <input type="number" name="exp_year" id="expYear" placeholder="26" min="23">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>CVC</label>
                                <input type="text" name="cvc" id="cardCvc" placeholder="123" maxlength="4">
                            </div>
                        </div>
                    </div>e

                    <button class="checkout-btn" type="submit">
                        Confirm & Pay
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="checkout-summary-col">
                <h3>Order Summary</h3>

                <div class="event-card">
                    <div class="event-name">{{ $event->event_name }}</div>
                    <div class="event-meta">
                        @if ($event->event_date)
                            {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
                        @endif
                        @if ($event->event_venue)
                            <br> {{ $event->event_venue }}
                        @endif
                    </div>
                </div>

                <div class="summary-line">
                    <span class="label">Ticket Type</span>
                    <span class="value">{{ $ticketType ?? '—' }}</span>
                </div>
                <div class="summary-line">
                    <span class="label">Quantity</span>
                    <span class="value">{{ $quantity ?? '—' }}</span>
                </div>
                <div class="summary-line">
                    <span class="label">Unit Price</span>
                    <span class="value">₱{{ $unitPrice ?? '—' }}</span>
                </div>

                <div class="total-row">
                    <div class="total-label">Total Due</div>
                    <div class="total-val">₱{{ $total ?? 0 }}</div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleCardFields() {
            var paymentMethod = document.getElementById('paymentMethod').value;
            var cardFields = document.getElementById('cardFields');

            // Get inputs to toggle required attribute
            var cardNumber = document.getElementById('cardNumber');
            var expMonth = document.getElementById('expMonth');
            var expYear = document.getElementById('expYear');
            var cardCvc = document.getElementById('cardCvc');

            if (paymentMethod === 'card') {
                cardFields.style.display = 'block';
                cardNumber.required = true;
                expMonth.required = true;
                expYear.required = true;
                cardCvc.required = true;
            } else {
                cardFields.style.display = 'none';
                cardNumber.required = false;
                expMonth.required = false;
                expYear.required = false;
                cardCvc.required = false;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleCardFields(); // Check state on page load in case of old() input
        });
    </script>
@endsection

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
        isolation: isolate;
    }

    /* Form Column */
    .checkout-form-col {
        background: var(--card, #141226);
        border: 1px solid var(--rim, rgba(255, 255, 255, 0.07));
        border-radius: 24px;
        padding: 32px;
        position: relative;
        z-index: 20;
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

    .payment-select {
        position: relative;
        z-index: 5000;
        isolation: isolate;
    }

    .payment-select.open {
        z-index: 7000;
    }

    .payment-select-button {
        width: 100%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--rim2, rgba(255, 255, 255, 0.12));
        border-radius: 12px;
        padding: 14px 16px;
        color: #fff;
        font-family: 'Outfit', sans-serif;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .payment-select-button:focus {
        outline: none;
        border-color: var(--accent, #38bdf8);
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
    }

    .payment-select-value {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .payment-select-trigger-main {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .payment-option-icon,
    .payment-select-trigger-icon {
        width: 24px;
        height: 24px;
        border-radius: 0;
        object-fit: contain;
        background: transparent;
        border: none;
        flex-shrink: 0;
    }

    .payment-select-trigger-icon[hidden] {
        display: none;
    }

    .payment-select-caret {
        color: var(--muted, #9590b0);
        transition: transform 0.2s;
        flex-shrink: 0;
    }

    .payment-select.open .payment-select-caret {
        transform: rotate(180deg);
    }

    .payment-select-options {
        position: absolute;
        left: 0;
        right: 0;
        top: calc(100% + 8px);
        background: #18162c;
        border: 1px solid var(--rim2, rgba(255, 255, 255, 0.12));
        border-radius: 12px;
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.35);
        max-height: 260px;
        overflow-y: auto;
        padding: 8px;
        z-index: 8000;
        display: none;
    }

    #cardFields {
        position: relative;
        z-index: 1;
    }

    #cardFields.dropdown-obscured {
        visibility: hidden;
    }

    .checkout-back-btn {
        position: fixed;
        top: 14px;
        left: 14px;
        z-index: 1300;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        text-decoration: none;
        color: #fff;
        background: rgba(20, 18, 38, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        font-size: 0.86rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        transition: transform 0.2s, background 0.2s, border-color 0.2s;
    }

    .checkout-back-btn:hover {
        background: rgba(34, 31, 57, 0.95);
        border-color: rgba(56, 189, 248, 0.5);
        transform: translateY(-1px);
    }

    .cancel-modal {
        position: fixed;
        inset: 0;
        z-index: 1500;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px;
        background: rgba(3, 6, 20, 0.68);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.22s ease, visibility 0s linear 0.22s;
    }

    .cancel-modal.show {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transition: opacity 0.22s ease;
    }

    .cancel-modal-card {
        width: 100%;
        max-width: 420px;
        background: linear-gradient(160deg, #17142b, #111d3d);
        border: 1px solid rgba(56, 189, 248, 0.25);
        border-radius: 18px;
        box-shadow: 0 20px 48px rgba(0, 0, 0, 0.4);
        padding: 20px;
        color: #f0eeff;
        opacity: 0;
        transform: translateY(14px) scale(0.98);
        transition: opacity 0.22s ease, transform 0.22s ease;
    }

    .cancel-modal.show .cancel-modal-card {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .cancel-modal-title {
        margin: 0 0 8px;
        font-size: 1.15rem;
        font-weight: 700;
    }

    .cancel-modal-text {
        margin: 0;
        color: #b7b3cf;
        font-size: 0.94rem;
        line-height: 1.5;
    }

    .cancel-modal-actions {
        margin-top: 16px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .cancel-modal-btn {
        border: 1px solid transparent;
        border-radius: 10px;
        padding: 9px 12px;
        font-family: 'Outfit', sans-serif;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .cancel-modal-btn-secondary {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.14);
        color: #fff;
    }

    .cancel-modal-btn-primary {
        background: #e11d48;
        color: #fff;
    }

    @media (prefers-reduced-motion: reduce) {

        .cancel-modal,
        .cancel-modal-card {
            transition: none;
        }
    }

    .payment-select.open .payment-select-options {
        display: block;
    }

    .payment-select-option {
        width: 100%;
        border: 0;
        background: transparent;
        color: #fff;
        border-radius: 10px;
        padding: 10px 12px;
        text-align: left;
        font-size: 0.94rem;
        font-family: 'Outfit', sans-serif;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .payment-option-main {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .payment-option-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .payment-select-option:hover,
    .payment-select-option:focus {
        background: rgba(56, 189, 248, 0.18);
        outline: none;
    }

    .payment-select-option.active {
        background: rgba(56, 189, 248, 0.24);
    }

    .payment-select-option-check {
        color: var(--accent, #38bdf8);
        font-size: 0.85rem;
        visibility: hidden;
    }

    .payment-select-option.active .payment-select-option-check {
        visibility: visible;
    }

    /* Summary Column */
    .checkout-summary-col {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.05), rgba(124, 58, 237, 0.05));
        border: 1px solid rgba(56, 189, 248, 0.15);
        border-radius: 24px;
        padding: 32px;
        position: sticky;
        top: 24px;
        z-index: 5;
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
        .checkout-wrap {
            margin: 36px auto 72px;
            padding: 0 14px;
        }

        .checkout-header h1 {
            font-size: 2.3rem;
        }

        .checkout-header p {
            font-size: 0.94rem;
        }

        .checkout-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .checkout-form-col,
        .checkout-summary-col {
            padding: 22px;
            order: -1;
            /* Puts the summary on top for mobile */
            position: relative;
            top: 0;
        }

        .checkout-form-col {
            z-index: 40;
        }

        .checkout-summary-col {
            z-index: 10;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .payment-select-button {
            padding: 12px 14px;
        }

        .payment-select-options {
            max-height: 220px;
        }

        #cardFields {
            padding: 16px !important;
        }

        .total-val {
            font-size: 2.1rem;
        }

        .checkout-btn {
            padding: 16px;
            font-size: 1.2rem;
        }

        .checkout-back-btn {
            top: 10px;
            left: 10px;
            padding: 9px 12px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 520px) {
        .checkout-wrap {
            margin: 24px auto 56px;
            padding: 0 10px;
        }

        .checkout-header {
            margin-bottom: 18px;
        }

        .checkout-header h1 {
            font-size: 1.95rem;
            line-height: 1;
        }

        .checkout-form-col,
        .checkout-summary-col {
            border-radius: 16px;
            padding: 16px;
        }

        .event-card {
            padding: 14px;
            margin-bottom: 16px;
        }

        .summary-line {
            font-size: 0.9rem;
            padding: 10px 0;
        }

        .total-row {
            margin-top: 18px;
            padding-top: 18px;
        }

        .total-val {
            font-size: 1.8rem;
        }

        .payment-option-icon,
        .payment-select-trigger-icon {
            width: 20px;
            height: 20px;
        }

        .payment-select-option {
            padding: 9px 10px;
            font-size: 0.9rem;
        }

        .payment-select-option-check {
            font-size: 0.75rem;
        }

        .checkout-btn {
            margin-top: 22px;
            border-radius: 12px;
        }

        .checkout-back-btn {
            top: 8px;
            left: 8px;
            padding: 8px 11px;
            gap: 6px;
        }

        .cancel-modal-card {
            border-radius: 14px;
            padding: 16px;
        }

        .cancel-modal-actions {
            flex-direction: column-reverse;
        }

        .cancel-modal-btn {
            width: 100%;
        }
    }
</style>

<div id="salesModal" class="modal">
    <div
        class="modal-content w-full max-w-2xl mx-4 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-white">Create Sale</h3>
            <button onclick="closeSalesModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <form action="{{ route('merchant.sales.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Ticket Selection and Quantity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Select Ticket</label>
                    <select name="event" id="selected_event"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        onchange="updateTickets(this)" required>
                        <option value="" selected hidden disabled>Select Event</option>
                        {{-- <option value="150" class="text-black" data-event="Salindayaw Music Festival">Electronic
                            Paradise</option>
                        <option value="250" class="text-black" data-event="Salindayaw Music Festival">Rock the Night
                        </option>
                        <option value="100" class="text-black" data-event="Salindayaw Music Festival">Smooth Jazz Night
                        </option> --}}
                        @forelse($events as $event)
                            <option value="{{ $event->id }}" class="text-black"
                                data-event='@json($event)'>
                                {{ $event->event_name }}
                            </option>
                        @empty
                            <option value="" hidden disabled>No Event Yet</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Quantity</label>
                    <div class="relative">
                        <input type="number" onchange="updateTotalPrice(this)" oninput="updateTotalPrice(this)"
                            name="quantity" id="quantityInput" min="1" value="1"
                            class="w-full pr-24 px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                            required>
                        <span id="ticketAvailability"
                            class="absolute inset-y-0 right-3 flex items-center text-xs text-gray-400 pointer-events-none">-
                            left</span>
                    </div>
                </div>
            </div>

            <!-- Purchase Type and Payment Method -->
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Type</label>
                    <select onchange="updateTicketPrice(this)" name="ticket" id="ticket_selection"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                        <option value="" class="text-black" selected disabled>Select Ticket Type</option>
                        {{-- <option value="student" class="text-black">VVIP</option>
                        <option value="alumni" class="text-black">VIP</option>
                        <option value="employee" class="text-black">PLATINUM</option>
                        <option value="general" class="text-black">SILVER</option>
                        <option value="general" class="text-black">BRONZE</option> --}}
                    </select>
                </div>

            </div>

            <!-- Customer Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Customer Name</label>
                    <input type="text" name="customer_name"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Customer Email</label>
                    <input type="email" name="customer_email"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Customer Phone</label>
                    <input type="tel" name="customer_phone"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">City</label>
                    <input type="text" name="city"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Address</label>
                <textarea name="address" rows="2"
                    class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <!-- Price Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Price</label>
                    <div class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white">
                        ₱<span id="ticketPrice">0.00</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Total Price</label>
                    <div
                        class="w-full px-4 py-2 bg-gradient-to-r from-blue-600/20 to-purple-600/20 border border-blue-500/30 rounded-lg">
                        <span class="text-2xl font-bold text-white">₱<span id="totalPrice">0.00</span></span>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Payment Method</label>
                <div class="form-group">
                    <input type="hidden" name="payment_method" id="paymentMethod" value="{{ old('payment_method') }}"
                        required>

                    <div class="payment-select" id="paymentMethodSelect">
                        <button class="payment-select-button" type="button" id="paymentMethodButton"
                            aria-haspopup="listbox" aria-expanded="false">
                            <span class="payment-select-trigger-main">
                                <img class="payment-select-trigger-icon" id="paymentMethodIcon" src=""
                                    alt="" hidden>
                                <span class="payment-select-value" id="paymentMethodValue">Select Payment
                                    Method...</span>
                            </span>
                            <svg class="payment-select-caret" width="18" height="18" viewBox="0 0 16 16"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" />
                            </svg>
                        </button>

                        <div class="payment-select-options" id="paymentMethodOptions" role="listbox">
                            <button type="button" class="payment-select-option" data-value="gcash"
                                data-label="GCash" data-icon="{{ asset('images/payments/gcash.png') }}">
                                <span class="payment-option-main">
                                    <img class="payment-option-icon" src="{{ asset('images/payments/gcash.png') }}"
                                        alt="GCash logo">
                                    <span class="payment-option-label">GCash</span>
                                </span>
                                <span class="payment-select-option-check">Selected</span>
                            </button>
                            <button type="button" class="payment-select-option" data-value="paymaya"
                                data-label="PayMaya" data-icon="{{ asset('images/payments/maya.png') }}">
                                <span class="payment-option-main">
                                    <img class="payment-option-icon" src="{{ asset('images/payments/maya.png') }}"
                                        alt="PayMaya logo">
                                    <span class="payment-option-label">PayMaya</span>
                                </span>
                                <span class="payment-select-option-check">Selected</span>
                            </button>
                            <button type="button" class="payment-select-option" data-value="card"
                                data-label="Credit / Debit Card" data-icon="{{ asset('images/payments/card.png') }}">
                                <span class="payment-option-main">
                                    <img class="payment-option-icon" src="{{ asset('images/payments/card.png') }}"
                                        alt="Card logo">
                                    <span class="payment-option-label">Credit / Debit Card</span>
                                </span>
                                <span class="payment-select-option-check">Selected</span>
                            </button>
                            <button type="button" class="payment-select-option" data-value="dob_bdo"
                                data-label="BDO Online Banking" data-icon="{{ asset('images/payments/bdo.png') }}">
                                <span class="payment-option-main">
                                    <img class="payment-option-icon" src="{{ asset('images/payments/bdo.png') }}"
                                        alt="BDO logo">
                                    <span class="payment-option-label">BDO Online Banking</span>
                                </span>
                                <span class="payment-select-option-check">Selected</span>
                            </button>
                            <button type="button" class="payment-select-option" data-value="dob_landbank"
                                data-label="Landbank Online Banking"
                                data-icon="{{ asset('images/payments/landbank.png') }}">
                                <span class="payment-option-main">
                                    <img class="payment-option-icon"
                                        src="{{ asset('images/payments/landbank.png') }}" alt="Landbank logo">
                                    <span class="payment-option-label">Landbank Online Banking</span>
                                </span>
                                <span class="payment-select-option-check">Selected</span>
                            </button>
                            <button type="button" class="payment-select-option" data-value="dob_metrobank"
                                data-label="Metrobank Online Banking"
                                data-icon="{{ asset('images/payments/metrobank.png') }}">
                                <span class="payment-option-main">
                                    <img class="payment-option-icon"
                                        src="{{ asset('images/payments/metrobank.png') }}" alt="Metrobank logo">
                                    <span class="payment-option-label">Metrobank Online Banking</span>
                                </span>
                                <span class="payment-select-option-check">Selected</span>
                            </button>
                            <button type="button" class="payment-select-option" data-value="cash" data-label="Cash"
                                data-icon="">
                                <span class="payment-option-main">
                                    <svg class="payment-option-icon w-6 h-6 text-green-500" fill="currentColor"
                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                                        <path
                                            d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z">
                                        </path>
                                    </svg>
                                    <span class="payment-option-label">Cash</span>
                                </span>
                                <span class="payment-select-option-check">Selected</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="cardFields"
                    style="display: none; background: rgba(0,0,0,0.25); padding: 20px; border-radius: 16px; margin-bottom: 14px; border: 1px solid var(--rim2, rgba(255,255,255,0.12));">
                    <div class="form-group" style="position: relative;">
                        <label style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Card Number</span>
                            <span id="cardTypeIndicator"
                                style="color: var(--accent, #38bdf8); font-size: 0.75rem; font-weight: 600; text-transform: uppercase;"></span>
                        </label>
                        <input type="text" name="card_number" id="cardNumber" placeholder="4343 4343 4343 4345"
                            autocomplete="cc-number">
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
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Complete Sale
                </button>
                <button type="button" onclick="closeSalesModal()"
                    class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function resetTicketSelection(message = 'Select Ticket Type') {
        const ticketSelection = document.getElementById('ticket_selection');
        const quantityInput = document.getElementById('quantityInput');
        const ticketAvailability = document.getElementById('ticketAvailability');

        ticketSelection.innerHTML = `<option value="" class="text-black" selected disabled>${message}</option>`;
        document.getElementById('ticketPrice').textContent = '0.00';
        document.getElementById('totalPrice').textContent = '0.00';
        quantityInput.value = 1;
        quantityInput.removeAttribute('max');
        quantityInput.disabled = true;
        ticketAvailability.textContent = '- left';
    }

    function setQuantityLimit(availableQty) {
        const quantityInput = document.getElementById('quantityInput');
        const ticketAvailability = document.getElementById('ticketAvailability');
        const available = Math.max(parseInt(availableQty, 10) || 0, 0);

        ticketAvailability.textContent = `${available} left`;

        if (available === 0) {
            quantityInput.value = 0;
            quantityInput.min = 0;
            quantityInput.max = 0;
            quantityInput.disabled = true;
            return;
        }

        quantityInput.disabled = false;
        quantityInput.min = 1;
        quantityInput.max = available;

        if ((parseInt(quantityInput.value, 10) || 1) > available) {
            quantityInput.value = available;
        } else if ((parseInt(quantityInput.value, 10) || 0) < 1) {
            quantityInput.value = 1;
        }
    }

    function updateTickets(selectEl) {
        resetTicketSelection();

        const selectedOption = selectEl.options[selectEl.selectedIndex];
        if (!selectedOption || !selectedOption.dataset.event) {
            return;
        }

        let eventData;
        try {
            eventData = JSON.parse(selectedOption.dataset.event);
        } catch (error) {
            resetTicketSelection('Unable to load ticket types');
            return;
        }

        const tickets = Array.isArray(eventData.tickets) ? eventData.tickets : [];

        if (!tickets.length) {
            resetTicketSelection('No ticket type available');
            return;
        }

        const ticketSelection = document.getElementById('ticket_selection');
        tickets.forEach((ticket) => {
            const option = document.createElement('option');
            option.value = ticket.id;
            option.className = 'text-black';
            option.dataset.ticket = JSON.stringify(ticket);
            option.textContent = ticket.name;
            ticketSelection.appendChild(option);
        });

        ticketSelection.selectedIndex = 1;
        updateTicketPrice(ticketSelection);
    }

    function updateTicketPrice(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        if (!selectedOption || !selectedOption.dataset.ticket) {
            document.getElementById('ticketPrice').textContent = '0.00';
            document.getElementById('totalPrice').textContent = '0.00';
            setQuantityLimit(0);
            return;
        }

        const ticket = JSON.parse(selectedOption.dataset.ticket);
        const ticketPrice = Number(ticket.price || 0).toFixed(2);
        document.getElementById('ticketPrice').textContent = ticketPrice;
        setQuantityLimit(ticket.quantity);
        updateTotalPrice(document.getElementById('quantityInput'));
    }

    function updateTotalPrice(sel) {
        const maxQuantity = parseInt(sel.max, 10) || Number.MAX_SAFE_INTEGER;
        let quantity = parseInt(sel.value, 10) || 0;

        if (quantity > maxQuantity) {
            quantity = maxQuantity;
            sel.value = maxQuantity;
        }

        if (quantity < 0) {
            quantity = 0;
            sel.value = 0;
        }

        const ticketPrice = parseFloat(document.getElementById('ticketPrice').textContent) || 0;

        const total = ticketPrice * quantity;
        document.getElementById('totalPrice').textContent = total.toFixed(2);



        function toggleCardFields() {
            var paymentMethod = document.getElementById('paymentMethod').value;
            var cardFields = document.getElementById('cardFields');
            var cardNumber = document.getElementById('cardNumber');
            var expMonth = document.getElementById('expMonth');
            var expYear = document.getElementById('expYear');
            var cardCvc = document.getElementById('cardCvc');

            if (paymentMethod === 'card') {
                cardFields.style.display = 'block';
                if (cardNumber) cardNumber.required = true;
                if (expMonth) expMonth.required = true;
                if (expYear) expYear.required = true;
                if (cardCvc) cardCvc.required = true;
            } else {
                cardFields.style.display = 'none';
                if (cardNumber) cardNumber.required = false;
                if (expMonth) expMonth.required = false;
                if (expYear) expYear.required = false;
                if (cardCvc) cardCvc.required = false;
            }
        }

        function initPaymentMethodSelect() {
            var selectRoot = document.getElementById('paymentMethodSelect');
            var hiddenInput = document.getElementById('paymentMethod');
            var button = document.getElementById('paymentMethodButton');
            var iconEl = document.getElementById('paymentMethodIcon');
            var valueEl = document.getElementById('paymentMethodValue');
            var optionButtons = document.querySelectorAll('.payment-select-option');
            var cardFields = document.getElementById('cardFields');

            if (!selectRoot || !hiddenInput || !button || !valueEl || !optionButtons.length) {
                return;
            }

            function closeDropdown() {
                selectRoot.classList.remove('open');
                button.setAttribute('aria-expanded', 'false');

                if (cardFields) {
                    cardFields.classList.remove('dropdown-obscured');
                }
            }

            function openDropdown() {
                selectRoot.classList.add('open');
                button.setAttribute('aria-expanded', 'true');

                if (cardFields) {
                    cardFields.classList.add('dropdown-obscured');
                }
            }

            function setValue(value) {
                var selectedOption = null;

                optionButtons.forEach(function(option) {
                    var isActive = option.getAttribute('data-value') === value;
                    option.classList.toggle('active', isActive);
                    if (isActive) {
                        selectedOption = option;
                    }
                });

                hiddenInput.value = value;

                if (selectedOption) {
                    valueEl.textContent = selectedOption.getAttribute('data-label') || 'Select Payment Method...';

                    if (iconEl) {
                        var selectedIcon = selectedOption.getAttribute('data-icon');
                        if (selectedIcon) {
                            iconEl.src = selectedIcon;
                            iconEl.alt = (selectedOption.getAttribute('data-label') || 'Payment method') + ' logo';
                            iconEl.hidden = false;
                        } else {
                            iconEl.src = '';
                            iconEl.alt = '';
                            iconEl.hidden = true;
                        }
                    }
                } else {
                    valueEl.textContent = 'Select Payment Method...';

                    if (iconEl) {
                        iconEl.src = '';
                        iconEl.alt = '';
                        iconEl.hidden = true;
                    }
                }
            }

            setValue(hiddenInput.value || '');
            toggleCardFields();

            button.addEventListener('click', function() {
                if (selectRoot.classList.contains('open')) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            });

            optionButtons.forEach(function(option) {
                option.addEventListener('click', function() {
                    closeDropdown();
                    setValue(option.getAttribute('data-value'));
                    toggleCardFields();
                    button.focus();
                });
            });

            document.addEventListener('click', function(event) {
                if (!selectRoot.contains(event.target)) {
                    closeDropdown();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeDropdown();
                }
            });
        }

        function initBackButtonConfirm() {
            var backBtn = document.getElementById('checkoutBackBtn');
            var modal = document.getElementById('cancelPaymentModal');
            var stayBtn = document.getElementById('cancelStayBtn');
            var confirmBtn = document.getElementById('cancelConfirmBtn');
            var modalCloseTimer;

            if (!backBtn || !modal || !stayBtn || !confirmBtn) {
                return;
            }

            function openModal() {
                if (modalCloseTimer) {
                    clearTimeout(modalCloseTimer);
                }

                modal.classList.add('show');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                stayBtn.focus();
            }

            function closeModal() {
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                modalCloseTimer = setTimeout(function() {
                    backBtn.focus();
                }, 180);
            }

            function proceedBack() {
                document.body.style.overflow = '';
                window.location.href = backBtn.getAttribute('href');
            }

            backBtn.addEventListener('click', function(event) {
                event.preventDefault();
                openModal();
            });

            stayBtn.addEventListener('click', function() {
                closeModal();
            });

            confirmBtn.addEventListener('click', function() {
                proceedBack();
            });

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.classList.contains('show')) {
                    closeModal();
                }
            });
        }

        function initCardTypeDetection() {
            var cardNumberInput = document.getElementById('cardNumber');
            var cardTypeIndicator = document.getElementById('cardTypeIndicator');

            if (!cardNumberInput || !cardTypeIndicator) return;

            cardNumberInput.addEventListener('input', function(e) {
                // Remove non-digits
                var val = this.value.replace(/\D/g, '');

                // Format with spaces
                var formatted = val.match(/.{1,4}/g);
                this.value = formatted ? formatted.join(' ') : val;

                // Detect card type
                var cardType = '';
                if (/^4/.test(val)) {
                    cardType = 'Visa';
                } else if (/^5[1-5]/.test(val) || /^2(2[2-9][1-9]|2[3-9][0-9]|[3-6][0-9]{2}|7[0-1][0-9]|720)/
                    .test(val)) {
                    cardType = 'Mastercard';
                } else if (/^3[47]/.test(val)) {
                    cardType = 'American Express';
                } else if (/^6(011|5|4[4-9]|22)/.test(val)) {
                    cardType = 'Discover';
                } else if (/^35/.test(val)) {
                    cardType = 'JCB';
                } else if (/^3(?:0[0-5]|[68])/.test(val)) {
                    cardType = 'Diners Club';
                } else if (val.length > 0) {
                    cardType = 'Unknown Card';
                }

                cardTypeIndicator.textContent = cardType;
            });
        }

        initPaymentMethodSelect();
        initBackButtonConfirm();
        initCardTypeDetection();
        toggleCardFields(); // Check state on page load in case of old() input
    }
</script>

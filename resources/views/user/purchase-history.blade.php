@extends('layouts')

@section('content')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* ── Reset scope ── */
        .orders-root *, .orders-root *::before, .orders-root *::after { box-sizing: border-box; }

        /* ── Page wrapper ── */
        .orders-root {
            font-family: 'Outfit', sans-serif;
            color: #f0eeff;
            background: #08070f;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Sticky filter bar ── */
        .orders-filter-bar {
            position: sticky;
            top: 86px;
            z-index: 40;
            background: rgba(8, 7, 15, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 12px 28px;
        }
        .orders-filter-inner {
            max-width: 980px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding-left: 0;
        }
        .orders-filter-icon {
            width: 40px; height: 40px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            margin-left: 150px;
            background: rgba(124,58,237,0.15);
            border: 1px solid rgba(124,58,237,0.3);
            border-radius: 10px;
            cursor: pointer;
            color: #a78bfa;
        }
        .orders-search-wrap {
            flex: 0 1 550px;
            width: min(550px, 100%);
            min-width: 0;
            margin-left: 1px;
        }
        .orders-search-input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            color: #f0eeff;
            font-family: 'Outfit', sans-serif;
            font-size: .92rem;
            outline: none;
            transition: border-color .18s, background .18s;
        }
        .orders-search-input:focus {
            border-color: rgba(124,58,237,0.55);
            background: rgba(124,58,237,0.08);
        }
        .orders-search-input::placeholder { color: #6b6585; }
        .orders-filter-label {
            font-family: 'Space Mono', monospace;
            font-size: .65rem; font-weight: 700;
            letter-spacing: .16em; text-transform: uppercase;
            color: #6b6585; white-space: nowrap; flex-shrink: 0;
        }
        .orders-select-wrap {
            position: relative;
            flex: 0 0 220px;
            width: 220px;
            min-width: 220px;
        }
        .orders-select-wrap::after {
            content: '';
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid #6b6585;
            pointer-events: none;
        }
        .orders-select {
            width: 100%;
            appearance: none; -webkit-appearance: none;
            padding: 10px 38px 10px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            color: #f0eeff;
            font-family: 'Outfit', sans-serif; font-size: .92rem;
            cursor: pointer; outline: none;
            transition: border-color .18s, background .18s;
        }
        .orders-select:focus {
            border-color: rgba(124,58,237,0.55);
            background: rgba(124,58,237,0.08);
        }
        .orders-select option { background: #141226; color: #f0eeff; }

        /* ── Content area ── */
        .orders-content {
            padding: 52px 28px 120px;
            max-width: 980px;
            margin: 0 auto;
        }

        /* ── Section header ── */
        .orders-section-head {
            display: flex; align-items: center; gap: 16px; margin-bottom: 28px;
        }
        .orders-section-label {
            font-family: 'Space Mono', monospace; font-size: .68rem; font-weight: 700;
            letter-spacing: .2em; text-transform: uppercase; color: #9590b0; white-space: nowrap;
        }
        .orders-section-rule { flex: 1; height: 1px; background: rgba(255,255,255,0.07); }
        .orders-page-info {
            font-family: 'Space Mono', monospace; font-size: .68rem; font-weight: 700;
            letter-spacing: .12em; text-transform: uppercase; color: #9590b0; white-space: nowrap;
        }

        /* ══════════════════════════════
           TICKET CARD
        ══════════════════════════════ */
        .tkt {
            display: flex;
            border-radius: 20px;
            overflow: visible; /* allow notch pseudo-els to show */
            margin-bottom: 24px;
            margin-left: 140px;
            width: calc(100% - 140px);
            max-width: 100%;
            position: relative;
            filter: drop-shadow(0 4px 24px rgba(0,0,0,0.45));
            cursor: pointer;
        }

        /* LEFT STUB */
        .tkt-stub {
            width: 96px; min-width: 96px; height: auto;
            position: relative;
            border-radius: 20px 0 0 20px;
            overflow: hidden;
            /* top+bottom notches via box-shadow trick on ::before/::after of body */
        }
        /* Notch circles — sit on the body side so they punch through */
        .tkt-body::before,
        .tkt-body::after {
            content: '';
            position: absolute;
            left: -13px;
            width: 26px; height: 26px;
            background: #08070f;
            border-radius: 50%;
            z-index: 3;
        }
        .tkt-body::before { top: -13px; }
        .tkt-body::after  { bottom: -13px; }

        .tkt-stub-img {
            display: block; width: 100%; height: 100%;
            object-fit: cover; object-position: center;
        }
        .tkt-stub-fallback {
            width: 100%; height: 100%; min-height: 130px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(160deg, #1e1540 0%, #150f2e 100%);
            font-family: 'Space Mono', monospace; font-size: .52rem; font-weight: 700;
            letter-spacing: .14em; text-transform: uppercase;
            color: rgba(255,255,255,0.35); text-align: center; padding: 12px;
        }

        /* Perforated tear line */
        .tkt-stub::after {
            content: '';
            position: absolute; top: 0; bottom: 0; right: 0; width: 1px;
            background: repeating-linear-gradient(
                to bottom,
                transparent 0px, transparent 5px,
                rgba(255,255,255,0.18) 5px, rgba(255,255,255,0.18) 10px
            );
            z-index: 2;
        }

        /* RIGHT BODY */
        .tkt-body {
            flex: 1; min-width: 0;
            position: relative;
            background: linear-gradient(135deg, #141226 0%, #0e0c1e 100%);
            border: 1px solid rgba(255,255,255,0.08);
            border-left: none;
            border-radius: 0 20px 20px 0;
            padding: 22px 24px 20px;
            overflow: hidden;
        }
        /* Top shimmer */
        .tkt-body > .tkt-shimmer {
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(124,58,237,0.5) 25%,
                rgba(56,189,248,0.5) 75%,
                transparent 100%
            );
        }
        /* Left accent bar */
        .tkt-body > .tkt-accent {
            position: absolute; left: 0; top: 18%; bottom: 18%;
            width: 3px;
            background: linear-gradient(to bottom, #7c3aed, #38bdf8);
            border-radius: 0 3px 3px 0;
            opacity: .55;
        }

        .tkt-top {
            display: flex; align-items: flex-start; justify-content: flex-start;
            gap: 12px; margin-bottom: 14px; padding-left: 10px;
        }
        .tkt-event-text { min-width: 0; }
        .tkt-event-name {
            font-weight: 700; font-size: 1.08rem; color: #38bdf8;
            line-height: 1.3; min-width: 0; word-break: break-word;
        }
        .tkt-event-location {
            margin-top: 3px;
            font-family: 'Outfit', sans-serif;
            font-size: .82rem;
            color: #9590b0;
            line-height: 1.35;
            word-break: break-word;
        }
        .tkt-divider {
            border: none; border-top: 1px dashed rgba(255,255,255,0.09);
            margin: 0 0 14px 10px;
        }

        .tkt-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 16px;
            padding-left: 10px;
        }
        .tkt-meta-key {
            font-family: 'Space Mono', monospace; font-size: .52rem; font-weight: 700;
            letter-spacing: .16em; text-transform: uppercase; color: #6b6585; margin-bottom: 4px;
        }
        .tkt-meta-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 4px;
        }
        .tkt-meta-val {
            font-family: 'Space Mono', monospace; font-size: .78rem;
            color: #d0caee; font-weight: 500; word-break: break-all;
        }
        .tkt-meta-val-row {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .tkt-ref-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.14);
            background: rgba(255,255,255,0.04);
            color: #9590b0;
            cursor: pointer;
            padding: 0;
            transition: border-color .15s, color .15s, background .15s;
        }
        .tkt-ref-toggle:hover {
            border-color: rgba(56,189,248,0.45);
            color: #38bdf8;
            background: rgba(56,189,248,0.08);
        }
        .tkt-ref-icon-eye-off { display: none; }
        .tkt-ref-toggle[aria-pressed="true"] .tkt-ref-icon-eye { display: none; }
        .tkt-ref-toggle[aria-pressed="true"] .tkt-ref-icon-eye-off { display: block; }
        .tkt-meta-location {
            font-family: 'Outfit', sans-serif;
            font-size: .88rem;
            color: #9590b0;
            font-weight: 500;
            word-break: break-word;
        }
        .tkt-meta-amount {
            font-family: 'Bebas Neue', sans-serif; font-size: 1.65rem;
            letter-spacing: .04em; color: #38bdf8; line-height: 1;
        }
        .tkt-meta-date {
            font-family: 'Outfit', sans-serif; font-size: .88rem;
            color: #9590b0; font-weight: 500;
        }

        /* ── Pagination ── */
        .orders-pagination {
            display: flex; align-items: center; justify-content: center;
            gap: 8px; margin-top: 40px; flex-wrap: wrap;
        }
        .orders-page-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px; border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.03);
            color: #9590b0; text-decoration: none;
            font-family: 'Space Mono', monospace; font-size: .65rem;
            font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        }
        .orders-page-num {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px; border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.07);
            color: #9590b0; text-decoration: none;
            font-family: 'Space Mono', monospace; font-size: .72rem; font-weight: 700;
        }
        .orders-page-num.active {
            border-color: rgba(56,189,248,.4);
            background: rgba(56,189,248,.1);
            color: #38bdf8;
        }
        .orders-page-btn.disabled { opacity: .35; cursor: not-allowed; }
        .orders-page-count {
            text-align: center; margin-top: 14px;
            font-family: 'Space Mono', monospace; font-size: .55rem;
            color: #6b6585; letter-spacing: .1em;
        }

        /* ── Empty state ── */
        .orders-empty {
            background: #141226; border: 1px solid rgba(255,255,255,0.07);
            border-radius: 22px; padding: 80px 24px; text-align: center;
            position: relative; overflow: hidden;
        }
        .orders-empty-glow {
            position: absolute; width: 280px; height: 280px;
            background: rgba(124,58,237,0.18); border-radius: 50%;
            filter: blur(80px); top: 50%; left: 50%;
            transform: translate(-50%,-50%); pointer-events: none;
        }
        .orders-empty-icon {
            width: 68px; height: 68px;
            background: rgba(56,189,248,.08); border: 1px solid rgba(56,189,248,.18);
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 22px; position: relative;
        }
        .orders-empty-title {
            font-family: 'Bebas Neue', sans-serif; font-size: 2.4rem;
            letter-spacing: .06em; color: #fff; margin-bottom: 10px; position: relative;
        }
        .orders-empty-sub {
            font-size: .92rem; color: #6b6585; line-height: 1.7;
            max-width: 300px; margin: 0 auto; position: relative;
        }
        .orders-empty-btn {
            display: inline-flex; align-items: center; gap: 8px; margin-top: 26px;
            padding: 11px 24px; background: rgba(56,189,248,.08);
            border: 1px solid rgba(56,189,248,.28); border-radius: 999px;
            color: #38bdf8; font-family: 'Space Mono', monospace; font-size: .68rem;
            font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
            text-decoration: none; position: relative;
        }

        /* ── Responsive ── */
        @media (max-width: 1200px) {
            .orders-filter-inner { padding-left: 0; }
            .orders-filter-icon { margin-left: 92px; }
            .orders-search-wrap { flex-basis: 500px; width: min(500px, 100%); }
            .tkt { margin-left: 96px; width: calc(100% - 96px); }
        }

        @media (max-width: 900px) {
            .orders-filter-bar { padding: 10px 20px; }
            .orders-content { padding: 40px 20px 100px; }
            .orders-filter-inner { padding-left: 0; }
            .orders-filter-icon { margin-left: 48px; }
            .orders-search-wrap { flex-basis: 440px; width: min(440px, 100%); }
            .tkt { margin-left: 64px; width: calc(100% - 64px); }
        }

        @media (max-width: 640px) {
            .orders-filter-bar { padding: 10px 16px; }
            .orders-filter-label { display: none; }
            .orders-filter-inner { gap: 8px; justify-content: center; padding-left: 0; }
            .orders-filter-icon { width: 34px; height: 34px; margin-left: 0; }
            .orders-search-wrap { flex: 1; max-width: none; margin-left: 0; }
            .orders-search-input { padding: 9px 12px; font-size: .86rem; }
            .orders-content { padding: 34px 16px 100px; }
            .tkt { margin-left: 0; width: 100%; }
            .tkt-stub { width: 72px; min-width: 72px; }
            .tkt-body { padding: 18px 16px 16px; }
            .tkt-event-name { font-size: .95rem; }
            .tkt-divider { margin: 0 0 12px 6px; }
            .tkt-meta { grid-template-columns: 1fr 1fr; gap: 10px 10px; padding-left: 6px; }
            .tkt-meta-val { font-size: .7rem; }
        }

        @media (max-width: 480px) {
            .tkt-stub { width: 64px; min-width: 64px; }
            .tkt-body { padding: 16px 14px 14px; }
            .tkt-event-name { font-size: .9rem; }
            .tkt-event-location { font-size: .78rem; }
            .tkt-meta { grid-template-columns: 1fr; gap: 10px; }
        }
    </style>

    <div class="orders-root">

        {{-- ── Sticky filter bar ── --}}
        <div class="orders-filter-bar">
            <form method="GET" action="{{ url()->current() }}" class="orders-filter-inner" id="ordersSearchForm">
                <div class="orders-filter-icon" aria-hidden="true">
                    <svg width="17" height="17" fill="none" stroke="#a78bfa" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="6" stroke-width="2"/>
                        <path d="M21 21l-3.5-3.5" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="orders-search-wrap">
                    <input
                        type="text"
                        name="search"
                        id="ordersSearchInput"
                        class="orders-search-input"
                        placeholder="Search event or location"
                        value="{{ $searchTerm ?? '' }}"
                        autocomplete="off"
                    >
                </div>
            </form>
        </div>

        <div class="orders-content">
            <div id="ordersResultsRoot">

            @php $isPaginated = method_exists($customerTickets, 'total'); @endphp

            @if (($isPaginated && $customerTickets->total() > 0) || (!$isPaginated && $customerTickets->count() > 0))

                {{-- Section header --}}
                <div class="orders-section-head">
                    <span class="orders-section-label">Orders</span>
                    <div class="orders-section-rule"></div>
                    @if($isPaginated)
                        <span class="orders-page-info">
                            Page {{ $customerTickets->currentPage() }} of {{ $customerTickets->lastPage() }}
                        </span>
                    @endif
                </div>

                {{-- Ticket cards --}}
                @foreach ($isPaginated ? $customerTickets : $customerTickets as $customerTicket)
                    @php
                        $referenceValue = (string) ($customerTicket->sale->reference_number ?? $customerTicket->sale->reference_id ?? 'N/A');
                        $modalTransactionValue = (string) ($customerTicket->sale->transaction_id ?? $referenceValue);
                        $lastFourReferenceValue = strlen($referenceValue) > 4
                            ? substr($referenceValue, -4)
                            : $referenceValue;
                        $maskedReferenceValue = strlen($referenceValue) > 4
                            ? str_repeat('*', strlen($referenceValue) - 4) . $lastFourReferenceValue
                            : $referenceValue;
                        $ticketTextColor = !empty($customerTicket->sale->ticket->color)
                            ? $customerTicket->sale->ticket->color
                            : '#d0caee';
                        $paymentTotal = 'P' . number_format($customerTicket->sale->total_amount ?? $customerTicket->sale->ticket->price ?? 0, 2);
                        $purchaseDate = $customerTicket->sale->created_at
                            ? $customerTicket->sale->created_at->format('M d, Y h:i A')
                            : 'N/A';
                    @endphp
                    <div
                        class="tkt js-open-purchase-modal"
                        role="button"
                        tabindex="0"
                        data-modal-event="{{ $customerTicket->sale->event->event_name ?? 'Event Title' }}"
                        data-modal-date="{{ $purchaseDate }}"
                        data-modal-ticket="{{ $customerTicket->sale->ticket->name ?? 'N/A' }}"
                        data-modal-reference="{{ $referenceValue }}"
                        data-modal-transaction="{{ $modalTransactionValue }}"
                        data-modal-payment-type="{{ $customerTicket->sale->payment_method ?? 'N/A' }}"
                        data-modal-total="{{ $paymentTotal }}"
                    >

                        {{-- Stub / thumbnail --}}
                        <div class="tkt-stub">
                            @if(!empty($customerTicket->sale->event->event_image_url))
                                <img src="{{ $customerTicket->sale->event->event_image_url }}"
                                     alt="{{ $customerTicket->sale->event->event_name ?? 'Event' }}"
                                     class="tkt-stub-img">
                            @else
                                <div class="tkt-stub-fallback">No&nbsp;Photo</div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="tkt-body">
                            <div class="tkt-shimmer"></div>
                            <div class="tkt-accent"></div>

                            <div class="tkt-top">
                                <div class="tkt-event-text">
                                    <div class="tkt-event-name">
                                        {{ $customerTicket->sale->event->event_name ?? 'Event Title' }}
                                    </div>
                                    <div class="tkt-event-location">
                                        {{ $customerTicket->sale->event->event_venue ?? 'TBA' }}
                                    </div>
                                </div>
                            </div>

                            <hr class="tkt-divider">

                            <div class="tkt-meta">
                                <div>
                                    <div class="tkt-meta-key">Reference</div>
                                    <div class="tkt-meta-val-row">
                                        <div
                                            class="tkt-meta-val js-ref-value"
                                            data-full="{{ $referenceValue }}"
                                            data-masked="{{ $maskedReferenceValue }}"
                                        >
                                            {{ $maskedReferenceValue }}
                                        </div>
                                        <button
                                            type="button"
                                            class="tkt-ref-toggle js-ref-toggle"
                                            aria-pressed="false"
                                            aria-label="Show full reference number"
                                        >
                                            <svg class="tkt-ref-icon-eye" width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                                                <circle cx="12" cy="12" r="3" stroke-width="2"/>
                                            </svg>
                                            <svg class="tkt-ref-icon-eye-off" width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.94 17.94A10.94 10.94 0 0112 19C5 19 1 12 1 12a21.74 21.74 0 015.06-6.94M9.9 4.24A10.94 10.94 0 0112 5c7 0 11 7 11 7a21.86 21.86 0 01-2.16 3.19M1 1l22 22"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <div class="tkt-meta-key">Ticket Name</div>
                                    <div class="tkt-meta-location" style="color: {{ $ticketTextColor }};">
                                        {{ $customerTicket->sale->ticket->name ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

                {{-- Pagination --}}
                @if ($isPaginated && $customerTickets->hasPages())
                    <div class="orders-pagination">

                        @if ($customerTickets->onFirstPage())
                            <span class="orders-page-btn disabled">
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Prev
                            </span>
                        @else
                            <a href="{{ $customerTickets->previousPageUrl() }}" class="orders-page-btn">
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Prev
                            </a>
                        @endif

                        @foreach ($customerTickets->getUrlRange(1, $customerTickets->lastPage()) as $page => $url)
                            @if ($page == $customerTickets->currentPage())
                                <span class="orders-page-num active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="orders-page-num">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($customerTickets->hasMorePages())
                            <a href="{{ $customerTickets->nextPageUrl() }}" class="orders-page-btn">
                                Next
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        @else
                            <span class="orders-page-btn disabled">
                                Next
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        @endif

                    </div>

                    <p class="orders-page-count">
                        Showing {{ $customerTickets->firstItem() }}–{{ $customerTickets->lastItem() }} of {{ $customerTickets->total() }} orders
                    </p>
                @endif

            @else

                <div class="orders-section-head">
                    <span class="orders-section-label">Orders</span>
                    <div class="orders-section-rule"></div>
                </div>

                <div class="orders-empty">
                    <div class="orders-empty-glow"></div>
                    <div class="orders-empty-icon">
                        <svg width="30" height="30" fill="none" stroke="#38bdf8" viewBox="0 0 24 24" style="opacity:.7;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h2 class="orders-empty-title">No Orders Yet</h2>
                    <p class="orders-empty-sub">You haven't purchased any tickets yet. Explore upcoming events and grab your spot.</p>
                    <a href="{{ route('events.index') }}" class="orders-empty-btn">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Browse Events
                    </a>
                </div>

            @endif

            </div>
        </div>
    </div>

    @include('user.specific-purchase')

    <script>
        document.addEventListener('click', function (event) {
            const toggle = event.target.closest('.js-ref-toggle');
            if (!toggle) return;

            const cardBody = toggle.closest('.tkt-meta');
            if (!cardBody) return;

            const valueEl = cardBody.querySelector('.js-ref-value');
            if (!valueEl) return;

            const isVisible = toggle.getAttribute('aria-pressed') === 'true';

            if (isVisible) {
                valueEl.textContent = valueEl.dataset.masked || '********';
                toggle.setAttribute('aria-pressed', 'false');
                toggle.setAttribute('aria-label', 'Show full reference number');
            } else {
                valueEl.textContent = valueEl.dataset.full || 'N/A';
                toggle.setAttribute('aria-pressed', 'true');
                toggle.setAttribute('aria-label', 'Hide full reference number');
            }
        });

        (function () {
            const searchForm = document.getElementById('ordersSearchForm');
            const searchInput = document.getElementById('ordersSearchInput');
            const resultsRoot = document.getElementById('ordersResultsRoot');
            if (!searchForm || !searchInput || !resultsRoot) return;

            let debounceTimer = null;
            let activeRequestController = null;

            const buildUrl = (pageUrl = null) => {
                const url = new URL(pageUrl || searchForm.action || window.location.href, window.location.origin);
                const query = searchInput.value.trim();

                if (query) {
                    url.searchParams.set('search', query);
                } else {
                    url.searchParams.delete('search');
                }

                url.searchParams.delete('event');

                if (!pageUrl) {
                    url.searchParams.delete('page');
                }

                return url.toString();
            };

            const requestAndReplace = async (targetUrl) => {
                if (activeRequestController) {
                    activeRequestController.abort();
                }

                activeRequestController = new AbortController();
                resultsRoot.style.opacity = '0.55';

                try {
                    const response = await fetch(targetUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        signal: activeRequestController.signal,
                    });

                    if (!response.ok) {
                        throw new Error('Failed to load purchase history');
                    }

                    const html = await response.text();
                    const parser = new DOMParser();
                    const parsed = parser.parseFromString(html, 'text/html');
                    const nextRoot = parsed.getElementById('ordersResultsRoot');

                    if (!nextRoot) return;

                    resultsRoot.innerHTML = nextRoot.innerHTML;
                    window.history.replaceState({}, '', targetUrl);
                } catch (error) {
                    if (error && error.name !== 'AbortError') {
                        console.error(error);
                    }
                } finally {
                    resultsRoot.style.opacity = '1';
                }
            };

            const debouncedSearch = () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    requestAndReplace(buildUrl());
                }, 250);
            };

            searchInput.addEventListener('input', debouncedSearch);

            searchForm.addEventListener('submit', function (event) {
                event.preventDefault();
                requestAndReplace(buildUrl());
            });

            document.addEventListener('click', function (event) {
                const paginationLink = event.target.closest('.orders-pagination a');
                if (!paginationLink || !resultsRoot.contains(paginationLink)) return;

                event.preventDefault();
                requestAndReplace(buildUrl(paginationLink.href));
            });
        })();
    </script>

@endsection
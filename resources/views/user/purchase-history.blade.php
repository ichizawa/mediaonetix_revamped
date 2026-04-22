@extends('layouts')

@section('content')

    <style>
        /* ── Tokens ──────────────────────────────────────────── */
        :root {
            --tp-cyan:        #22d3ee;
            --tp-cyan-glow:   rgba(34,211,238,.15);
            --tp-cyan-border: rgba(34,211,238,.25);
            --tp-page:        #020817;
            --tp-card-bg:     rgba(255,255,255,.04);
            --tp-card-border: rgba(255,255,255,.08);
            --tp-hi:          #f1f5f9;
            --tp-mid:         #94a3b8;
            --tp-lo:          #64748b;
        }

        /* ── Scoped reset ────────────────────────────────────── */
        .tp-root *, .tp-root *::before, .tp-root *::after { box-sizing: border-box; }

        /* ── Root layout ─────────────────────────────────────── */
        .tp-root {
            position: relative;
            min-height: 100vh;
            padding-top: 5rem;
            background: var(--tp-page);
            color: var(--tp-hi);
        }
        @media (min-width: 1024px) { .tp-root { margin-left: 16rem; } }

        .tp-wrap {
            position: relative;
            z-index: 1;
            max-width: 72rem;
            margin: 0 auto;
            padding: 2.5rem 1rem 4rem;
        }
        @media (min-width: 640px)  { .tp-wrap { padding: 3rem 1.5rem 4rem; } }
        @media (min-width: 1024px) { .tp-wrap { padding: 3.5rem 2.5rem 5rem; } }

        /* ── Ambient ─────────────────────────────────────────── */
        .tp-ambient {
            pointer-events: none;
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }
        .tp-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(110px);
            opacity: .15;
        }
        .tp-orb--1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #06b6d4, transparent 70%);
            top: -140px; right: -60px;
            animation: tp-drift 16s ease-in-out infinite alternate;
        }
        .tp-orb--2 {
            width: 360px; height: 360px;
            background: radial-gradient(circle, #3b82f6, transparent 70%);
            bottom: 5%; left: 5%;
            animation: tp-drift 20s ease-in-out infinite alternate-reverse;
        }
        .tp-grain {
            position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.05'/%3E%3C/svg%3E");
            opacity: .35;
        }
        @keyframes tp-drift {
            from { transform: translate(0,0) scale(1); }
            to   { transform: translate(22px,14px) scale(1.04); }
        }

        /* ── Header ──────────────────────────────────────────── */
        .tp-header { margin-bottom: 2.5rem; }
        .tp-header__row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .tp-header__left { display: flex; flex-direction: column; gap: .55rem; }

        .tp-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            border: 1px solid var(--tp-cyan-border);
            background: var(--tp-cyan-glow);
            border-radius: 99px;
            padding: .27rem .78rem;
            font-size: .6rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: #67e8f9;
        }
        .tp-badge__dot {
            width: 6px; height: 6px;
            background: var(--tp-cyan);
            border-radius: 50%;
            box-shadow: 0 0 6px var(--tp-cyan);
            animation: tp-pulse 2.4s ease-in-out infinite;
            flex-shrink: 0;
        }
        @keyframes tp-pulse {
            0%,100% { opacity:1; box-shadow:0 0 6px var(--tp-cyan); }
            50%      { opacity:.45; box-shadow:0 0 2px var(--tp-cyan); }
        }

        .tp-title {
            font-size: clamp(1.5rem, 5vw, 2.1rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            letter-spacing: -.02em;
            margin: 0;
        }
        .tp-sub {
            font-size: .82rem;
            color: var(--tp-mid);
            margin: 0;
        }

        /* ── Search Filter ──────────────────────────────────── */
        .tp-search-form {
            display: flex;
            align-items: center;
            gap: .8rem;
            flex-wrap: wrap;
        }
        .tp-search-wrap {
            position: relative;
            flex: 1;
        }
        .tp-search-input {
            width: 100%;
            padding: .6rem 1rem .6rem 2.4rem;
            border-radius: .8rem;
            border: 1px solid var(--tp-card-border);
            background: rgba(255,255,255,.02);
            color: var(--tp-hi);
            font-size: .85rem;
            outline: none;
            transition: border-color .18s, background .18s;
        }
        .tp-search-input:focus {
            border-color: var(--tp-cyan-border);
            background: rgba(34,211,238,.05);
        }
        .tp-search-input::placeholder { color: var(--tp-lo); }
        .tp-search-icon {
            position: absolute;
            left: .8rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--tp-lo);
            width: 16px; height: 16px;
            pointer-events: none;
        }

        /* ── Grid ────────────────────────────────────────────── */
        .tp-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: 1fr;
        }
        @media (min-width: 480px) { .tp-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 900px) { .tp-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 1200px){ .tp-grid { grid-template-columns: repeat(4, 1fr); } }

        /* ── Ticket card ─────────────────────────────────────── */
        .tp-card {
            border-radius: 1.1rem;
            background: var(--tp-card-bg);
            border: 1px solid var(--tp-card-border);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(0,0,0,.28);
            animation: tp-in .4s ease both;
            animation-delay: calc(var(--i,0) * 50ms);
            transition: transform .2s, box-shadow .2s, border-color .2s;
            cursor: pointer;
        }
        .tp-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 32px rgba(0,0,0,.4);
            border-color: rgba(34,211,238,.22);
        }
        @keyframes tp-in {
            from { opacity:0; transform:translateY(12px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* Hero */
        .tp-card__hero {
            position: relative;
            height: 8rem;
            overflow: hidden;
            flex-shrink: 0;
        }
        .tp-card__img {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
        }
        .tp-card__fallback {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, #0e7490, #1d4ed8 55%, #4338ca);
        }
        .tp-card__overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(2,8,23,.9) 0%, rgba(2,8,23,.15) 55%, transparent);
        }

        /* Date badge */
        .tp-card__date {
            position: absolute;
            top: .55rem; left: .6rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(2,8,23,.7);
            backdrop-filter: blur(8px);
            border: 1px solid var(--tp-cyan-border);
            border-radius: .5rem;
            padding: .2rem .48rem;
            line-height: 1;
        }
        .tp-card__date-month {
            font-size: .48rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--tp-cyan);
        }
        .tp-card__date-day {
            font-size: .9rem;
            font-weight: 800;
            color: #fff;
            margin-top: .04rem;
        }

        .tp-card__type {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            background: #0C1222;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 2;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        /* Perforation */
        .tp-perf {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }
        .tp-perf__notch {
            display: block;
            width: 13px; height: 13px;
            background: var(--tp-page);
            border-radius: 50%;
            border: 1px solid var(--tp-card-border);
            flex-shrink: 0;
            z-index: 1;
        }
        .tp-perf__notch--l { margin-left: -6.5px; }
        .tp-perf__notch--r { margin-right: -6.5px; }
        .tp-perf__dash {
            flex: 1;
            height: 1px;
            background: repeating-linear-gradient(
                90deg,
                rgba(255,255,255,.1) 0, rgba(255,255,255,.1) 4px,
                transparent 4px, transparent 8px
            );
        }

        /* Body */
        .tp-card__body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: .55rem;
            padding: .7rem .8rem .8rem;
        }
        .tp-card__name {
            font-size: .87rem;
            font-weight: 700;
            color: var(--tp-hi);
            line-height: 1.3;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Info rows */
        .tp-card__info { display: flex; flex-direction: column; gap: .28rem; }
        .tp-info-row {
            display: flex;
            align-items: center;
            gap: .38rem;
            font-size: .74rem;
            color: var(--tp-mid);
        }
        .tp-info-icon {
            width: 12px; height: 12px;
            color: var(--tp-cyan);
            flex-shrink: 0;
        }
        .tp-info-row__trunc {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .tp-card__divider {
            border: none;
            border-top: 1px dashed rgba(255,255,255,.1);
            margin: .2rem 0;
        }

        /* CTA */
        .tp-card__cta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .4rem;
            background: rgba(34,211,238,.07);
            border: 1px solid rgba(34,211,238,.18);
            border-radius: .6rem;
            padding: .48rem .68rem;
            font-size: .73rem;
            font-weight: 600;
            color: #a5f3fc;
            text-decoration: none;
            margin-top: auto;
            transition: background .18s, border-color .18s;
            cursor: pointer;
        }
        .tp-card__cta:hover {
            background: rgba(34,211,238,.13);
            border-color: rgba(34,211,238,.35);
        }

        .tp-ref-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: .7rem;
            background: rgba(34,211,238,.04);
            border-radius: .4rem;
            padding: .3rem .5rem;
            margin-top: auto;
        }
        .tp-ref-label {
            color: var(--tp-mid);
            font-weight: 600;
        }
        .tp-ref-value-wrap {
            display: flex;
            align-items: center;
            gap: .4rem;
        }
        .tp-ref-val {
            color: var(--tp-cyan);
            font-family: monospace;
            font-weight: 700;
            letter-spacing: .05em;
        }
        .tp-ref-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,.05);
            color: var(--tp-mid);
            cursor: pointer;
            padding: 0;
            transition: color .15s, background .15s;
        }
        .tp-ref-toggle:hover {
            color: var(--tp-hi);
            background: rgba(255,255,255,.1);
        }
        .tp-ref-icon-eye-off { display: none; }
        .tp-ref-toggle[aria-pressed="true"] .tp-ref-icon-eye { display: none; }
        .tp-ref-toggle[aria-pressed="true"] .tp-ref-icon-eye-off { display: block; }

        /* ── Empty state ─────────────────────────────────────── */
        .tp-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: .9rem;
            border: 1px dashed rgba(255,255,255,.09);
            border-radius: 1.4rem;
            background: rgba(255,255,255,.02);
            padding: 4rem 2rem;
            animation: tp-in .45s ease both;
        }
        .tp-empty__icon {
            width: 64px; height: 64px;
            color: #1e293b;
        }
        .tp-empty__title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--tp-hi);
            letter-spacing: -.01em;
            margin: 0;
        }
        .tp-empty__text {
            font-size: .84rem;
            color: var(--tp-lo);
            max-width: 24rem;
            line-height: 1.6;
            margin: 0;
        }
        .tp-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: var(--tp-cyan);
            border-radius: .7rem;
            padding: .58rem 1.25rem;
            font-size: .8rem;
            font-weight: 700;
            color: #020817;
            text-decoration: none;
            transition: background .18s, transform .18s, box-shadow .18s;
        }
        .tp-btn-primary:hover {
            background: #67e8f9;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(34,211,238,.2);
        }

        /* Pagination */
        .tp-pagination {
            display: flex; align-items: center; justify-content: center;
            gap: 8px; margin-top: 40px; flex-wrap: wrap;
        }
        .tp-page-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: .5rem 1rem; border-radius: .7rem;
            border: 1px solid var(--tp-card-border);
            background: var(--tp-card-bg);
            color: var(--tp-mid); text-decoration: none;
            font-size: .75rem; font-weight: 600;
            transition: background .18s, color .18s;
        }
        .tp-page-btn:hover:not(.disabled) {
            background: rgba(34,211,238,.08);
            border-color: rgba(34,211,238,.2);
            color: var(--tp-cyan);
        }
        .tp-page-num {
            display: inline-flex; align-items: center; justify-content: center;
            width: 32px; height: 32px; border-radius: .5rem;
            border: 1px solid transparent;
            color: var(--tp-mid); text-decoration: none;
            font-size: .8rem; font-weight: 600;
            transition: background .18s, color .18s;
        }
        .tp-page-num:hover {
            background: rgba(255,255,255,.05);
        }
        .tp-page-num.active {
            border-color: rgba(34,211,238,.3);
            background: rgba(34,211,238,.1);
            color: var(--tp-cyan);
        }
        .tp-page-btn.disabled { opacity: .4; cursor: not-allowed; }
        .tp-page-count {
            text-align: center; margin-top: 14px;
            font-size: .75rem; color: var(--tp-lo);
        }

        @media (prefers-reduced-motion: reduce) {
            .tp-card, .tp-empty       { animation: none; }
            .tp-orb--1, .tp-orb--2   { animation: none; }
            .tp-badge__dot            { animation: none; }
            .tp-card:hover            { transform: none; }
            .tp-btn-primary:hover     { transform: none; }
        }
    </style>

    <div class="tp-root">

        {{-- Ambient --}}
        <div class="tp-ambient" aria-hidden="true">
            <div class="tp-orb tp-orb--1"></div>
            <div class="tp-orb tp-orb--2"></div>
            <div class="tp-grain"></div>
        </div>

        <div class="tp-wrap">

            <header class="tp-header">
                <div class="tp-header__row">
                    <div class="tp-header__left">
                        <span style="font-size: .8rem; font-weight: 600; color: var(--tp-mid); text-transform: uppercase; letter-spacing: .1em;">
                            Orders
                        </span>
                        <h1 class="tp-title">Purchase History</h1>
                        <p class="tp-sub">View all your past ticket purchases.</p>
                    </div>

                    <form method="GET" action="{{ url()->current() }}" class="tp-search-form" id="ordersSearchForm">
                        <div class="tp-search-wrap" style="flex: 0 0 auto; width: auto;">
                            <select name="filter" class="tp-search-input" style="padding-left: 1.25rem; cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2322d3ee%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem top 50%; background-size: 0.65rem auto; padding-right: 2.5rem;" onchange="document.getElementById('ordersSearchForm').submit();">
                                <option value="all" {{ ($filter ?? 'all') === 'all' ? 'selected' : '' }} style="background: #0C1222; color: #fff;">All</option>
                                <option value="ongoing" {{ ($filter ?? 'all') === 'ongoing' ? 'selected' : '' }} style="background: #0C1222; color: #fff;">Ongoing</option>
                                <option value="completed" {{ ($filter ?? 'all') === 'completed' ? 'selected' : '' }} style="background: #0C1222; color: #fff;">Completed</option>
                            </select>
                        </div>
                        <div class="tp-search-wrap" style="flex: 0 0 auto; width: auto;">
                            <select name="sort" class="tp-search-input" style="padding-left: 1.25rem; cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2322d3ee%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem top 50%; background-size: 0.65rem auto; padding-right: 2.5rem;" onchange="document.getElementById('ordersSearchForm').submit();">
                                <option value="asc" {{ ($sort ?? '') === 'asc' ? 'selected' : '' }} style="background: #0C1222; color: #fff;">Earliest First</option>
                                <option value="desc" {{ ($sort ?? '') === 'desc' ? 'selected' : '' }} style="background: #0C1222; color: #fff;">Latest First</option>
                            </select>
                        </div>
                    </form>
                </div>
            </header>

            <div id="ordersResultsRoot">

                @php $isPaginated = method_exists($customerTickets, 'total'); @endphp

                @if (($isPaginated && $customerTickets->total() > 0) || (!$isPaginated && $customerTickets->count() > 0))

                    <div class="tp-grid">
                        @foreach ($isPaginated ? $customerTickets : $customerTickets as $i => $customerTicket)
                            @php
                                $event = $customerTicket->event;
                                $ticket = $customerTicket->ticket;
                                $referenceValue = (string) ($customerTicket->reference_number ?? $customerTicket->reference_id ?? 'N/A');
                                $modalTransactionValue = (string) ($customerTicket->transaction_id ?? $referenceValue);
                                $lastFourReferenceValue = strlen($referenceValue) > 4
                                    ? substr($referenceValue, -4)
                                    : $referenceValue;
                                $maskedReferenceValue = strlen($referenceValue) > 4
                                    ? str_repeat('*', strlen($referenceValue) - 4) . $lastFourReferenceValue
                                    : $referenceValue;
                                $paymentTotal = 'P' . number_format($customerTicket->total_amount ?? ($ticket ? $ticket->price : 0), 2);
                                $purchaseDate = $customerTicket->created_at
                                    ? $customerTicket->created_at->format('M d, Y h:i A')
                                    : 'N/A';
                                
                                $dateStr = $event && $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('D, M j Y') : '—';
                                $timeStr = $event && $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('h:i A') : '—';
                                $monthStr = $event && $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('M') : '';
                                $dayStr = $event && $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d') : '';

                                $cropStyle = '';
                                if ($event) {
                                    $hasCrop = !is_null($event->crop_x) && !is_null($event->crop_y) &&
                                               !is_null($event->crop_width) && !is_null($event->crop_height) &&
                                               !empty($event->crop_natural_width) && !empty($event->crop_natural_height) &&
                                               $event->crop_width > 0 && $event->crop_height > 0;

                                    if ($hasCrop) {
                                        $wPct = ($event->crop_natural_width  / $event->crop_width)  * 100;
                                        $hPct = ($event->crop_natural_height / $event->crop_height) * 100;
                                        $lPct = -($event->crop_x / $event->crop_width)  * 100;
                                        $tPct = -($event->crop_y / $event->crop_height) * 100;
                                        $cropStyle = sprintf(
                                            'position:absolute;width:%.4f%%;height:%.4f%%;max-width:none;max-height:none;left:%.4f%%;top:%.4f%%;',
                                            $wPct, $hPct, $lPct, $tPct
                                        );
                                    }
                                }
                            @endphp

                            <article 
                                class="tp-card js-open-purchase-modal" 
                                style="--i:{{ $i }}"
                                role="button"
                                tabindex="0"
                                data-modal-event="{{ $event->event_name ?? 'Event Title' }}"
                                data-modal-date="{{ $purchaseDate }}"
                                data-modal-ticket="{{ $ticket->name ?? 'N/A' }}"
                                data-modal-reference="{{ $referenceValue }}"
                                data-modal-transaction="{{ $modalTransactionValue }}"
                                data-modal-payment-type="{{ $customerTicket->payment_method ?? 'N/A' }}"
                                data-modal-total="{{ $paymentTotal }}"
                            >
                                {{-- Hero --}}
                                <div class="tp-card__hero">
                                    @if ($event && $event->event_image_url)
                                        <img
                                            src="{{ $event->event_image_url }}"
                                            alt="{{ $event->event_name ?? 'Event' }}"
                                            class="tp-card__img"
                                            style="{{ $cropStyle }}"
                                            loading="lazy"
                                        >
                                    @elseif ($event && $event->event_image)
                                        <img
                                            src="{{ asset('images/events/' . $event->event_image) }}"
                                            alt="{{ $event->event_name ?? 'Event' }}"
                                            class="tp-card__img"
                                            style="{{ $cropStyle }}"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="tp-card__fallback" aria-hidden="true"></div>
                                    @endif
                                    <div class="tp-card__overlay" aria-hidden="true"></div>



                                    <span class="tp-card__type">{{ $ticket->name ?? 'Ticket' }}</span>
                                </div>

                                {{-- Perforation --}}
                                <div class="tp-perf" aria-hidden="true">
                                    <span class="tp-perf__notch tp-perf__notch--l"></span>
                                    <span class="tp-perf__dash"></span>
                                    <span class="tp-perf__notch tp-perf__notch--r"></span>
                                </div>

                                {{-- Body --}}
                                <div class="tp-card__body">
                                    <h2 class="tp-card__name" title="{{ $event->event_name ?? 'N/A' }}">
                                        {{ $event->event_name ?? 'N/A' }}
                                    </h2>

                                    <div class="tp-card__info">
                                        <div class="tp-info-row">
                                            <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                            <span>{{ $dateStr }}</span>
                                        </div>
                                        <div class="tp-info-row">
                                            <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                            <span>{{ $timeStr }}</span>
                                        </div>
                                        @if ($event && !empty($event->event_location))
                                            <div class="tp-info-row">
                                                <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                                <span class="tp-info-row__trunc">{{ $event->event_location }}</span>
                                            </div>
                                        @elseif ($event && !empty($event->event_venue))
                                            <div class="tp-info-row">
                                                <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                                <span class="tp-info-row__trunc">{{ $event->event_venue }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <hr class="tp-card__divider">

                                    <div class="tp-card__cta">
                                        View Details
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>

                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if ($isPaginated && $customerTickets->hasPages())
                        <div class="tp-pagination">

                            @if ($customerTickets->onFirstPage())
                                <span class="tp-page-btn disabled">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                    Prev
                                </span>
                            @else
                                <a href="{{ $customerTickets->previousPageUrl() }}" class="tp-page-btn">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                    Prev
                                </a>
                            @endif

                            @foreach ($customerTickets->getUrlRange(1, $customerTickets->lastPage()) as $page => $url)
                                @if ($page == $customerTickets->currentPage())
                                    <span class="tp-page-num active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="tp-page-num">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($customerTickets->hasMorePages())
                                <a href="{{ $customerTickets->nextPageUrl() }}" class="tp-page-btn">
                                    Next
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @else
                                <span class="tp-page-btn disabled">
                                    Next
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            @endif

                        </div>

                        <p class="tp-page-count">
                            Showing {{ $customerTickets->firstItem() }}–{{ $customerTickets->lastItem() }} of {{ $customerTickets->total() }} orders
                        </p>
                    @endif

                @else

                    <div class="tp-empty">
                        <div class="tp-empty__icon" aria-hidden="true">
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="20" width="48" height="28" rx="4" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M8 34h8M48 34h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <circle cx="16" cy="34" r="4" stroke="currentColor" stroke-width="1.5"/>
                                <circle cx="48" cy="34" r="4" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M20 34h24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="3 3"/>
                                <path d="M26 26v-4M32 24v-6M38 26v-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" opacity=".4"/>
                            </svg>
                        </div>
                        <h2 class="tp-empty__title">No Orders Yet</h2>
                        <p class="tp-empty__text">You haven't purchased any tickets yet. Explore upcoming events and grab your spot.</p>
                        <div class="tp-empty__actions">
                            <a href="{{ route('events.index') }}" class="tp-btn-primary">
                                Browse Events
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.22 4.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L11.94 10 7.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
                            </a>
                        </div>
                    </div>

                @endif

            </div>

        </div>
    </div>

    @include('user.specific-purchase')

    <script>
        (function () {
            const searchForm = document.getElementById('ordersSearchForm');
            const resultsRoot = document.getElementById('ordersResultsRoot');
            if (!searchForm || !resultsRoot) return;

            let activeRequestController = null;

            const buildUrl = (pageUrl = null) => {
                const url = new URL(pageUrl || searchForm.action || window.location.href, window.location.origin);

                if (!pageUrl) {
                    const formData = new FormData(searchForm);
                    for (const [key, value] of formData.entries()) {
                        if (value && value.trim() !== '') {
                            url.searchParams.set(key, value.trim());
                        } else {
                            url.searchParams.delete(key);
                        }
                    }
                    url.searchParams.delete('page');
                }

                url.searchParams.delete('event');

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

            searchForm.addEventListener('submit', function (event) {
                event.preventDefault();
                requestAndReplace(buildUrl());
            });

            document.addEventListener('click', function (event) {
                const paginationLink = event.target.closest('.tp-pagination a');
                if (!paginationLink || !resultsRoot.contains(paginationLink)) return;

                event.preventDefault();
                requestAndReplace(buildUrl(paginationLink.href));
            });
        })();
    </script>

@endsection
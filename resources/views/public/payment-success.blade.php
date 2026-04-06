@extends('layouts')
@section('content')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg: #08070f;
            --surface: #100e1c;
            --card: #141226;
            --card2: #100f20;
            --rim: rgba(255, 255, 255, 0.07);
            --rim2: rgba(255, 255, 255, 0.12);
            --accent: #38bdf8;
            --accent2: #7c3aed;
            --accent3: #f43f5e;
            --text: #f0eeff;
            --muted: #6b6585;
            --muted2: #9590b0;
            --green: #4ade80;
            --glow-lime: rgba(56, 189, 248, 0.18);
            --glow-purple: rgba(124, 58, 237, 0.25);
            --glow-green: rgba(74, 222, 128, 0.20);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* NOISE GRAIN */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 999;
            opacity: .6;
        }

        /* ─── BACKGROUND ORBS ─── */
        .page-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            animation: orbFloat 9s ease-in-out infinite;
        }

        .orb--1 {
            width: 500px;
            height: 500px;
            background: var(--glow-purple);
            top: -120px;
            left: -140px;
            animation-delay: 0s;
        }

        .orb--2 {
            width: 380px;
            height: 380px;
            background: var(--glow-green);
            bottom: -80px;
            right: -100px;
            animation-delay: 3s;
            animation-direction: alternate-reverse;
        }

        .orb--3 {
            width: 240px;
            height: 240px;
            background: var(--glow-lime);
            top: 50%;
            left: 55%;
            animation-delay: 5s;
        }

        @keyframes orbFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50%       { transform: translateY(-28px) scale(1.07); }
        }

        /* ─── PAGE LAYOUT ─── */
        .page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 100px 20px 60px;
        }

        /* ─── SUCCESS ICON ─── */
        .success-icon-wrap {
            position: relative;
            width: 96px;
            height: 96px;
            margin: 0 auto 28px;
        }

        .success-icon-wrap::before {
            content: '';
            position: absolute;
            inset: -14px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(74, 222, 128, .22) 0%, transparent 70%);
            animation: glowPulse 2.4s ease-in-out infinite;
        }

        @keyframes glowPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: .55; transform: scale(1.12); }
        }

        .success-icon-ring {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: rgba(74, 222, 128, .1);
            border: 1.5px solid rgba(74, 222, 128, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .success-icon-ring svg {
            color: var(--green);
            width: 48px;
            height: 48px;
        }

        /* ─── HEADING ─── */
        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.8rem, 9vw, 5.5rem);
            line-height: .95;
            letter-spacing: .04em;
            color: #fff;
            text-align: center;
            margin-bottom: 12px;
            text-shadow: 0 0 80px rgba(74, 222, 128, .12);
        }

        .page-sub {
            font-size: clamp(.88rem, 2vw, 1rem);
            color: var(--muted2);
            text-align: center;
            max-width: 400px;
            margin: 0 auto 6px;
            line-height: 1.65;
        }

        .page-email-note {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-family: 'Space Mono', monospace;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--accent);
            background: rgba(56, 189, 248, .08);
            border: 1px solid rgba(56, 189, 248, .22);
            border-radius: 999px;
            padding: 6px 16px;
            margin: 18px auto 0;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 7px var(--accent);
            animation: blink 1.4s ease-in-out infinite;
            flex-shrink: 0;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: .25; }
        }

        /* ─── CARD ─── */
        .card {
            background: var(--card);
            border: 1px solid var(--rim2);
            border-radius: 24px;
            overflow: hidden;
            width: 100%;
            max-width: 540px;
            margin: 36px auto 0;
        }

        /* ─── SECTION HEADER inside card ─── */
        .sec-head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 24px 0;
            margin-bottom: 16px;
        }

        .sec-label {
            font-family: 'Space Mono', monospace;
            font-size: .58rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted2);
            white-space: nowrap;
        }

        .sec-line {
            flex: 1;
            height: 1px;
            background: var(--rim);
        }

        /* ─── ORDER ROWS ─── */
        .order-rows {
            padding: 0 24px 22px;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .order-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px solid var(--rim);
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .order-row__key {
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .03em;
            color: var(--muted2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-row__key svg {
            width: 14px;
            height: 14px;
            opacity: .65;
            flex-shrink: 0;
        }

        .order-row__val {
            font-size: .88rem;
            font-weight: 600;
            color: var(--text);
            text-align: right;
            max-width: 60%;
        }

        /* ─── TOTAL ROW ─── */
        .total-band {
            margin: 0 16px 20px;
            border-radius: 14px;
            background: rgba(74, 222, 128, .07);
            border: 1px solid rgba(74, 222, 128, .18);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .total-band__label {
            font-family: 'Space Mono', monospace;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--green);
        }

        .total-band__amount {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: .06em;
            color: var(--green);
            line-height: 1;
        }

        /* ─── CTA ─── */
        .cta-wrap {
            padding: 0 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--accent2) 0%, var(--accent) 100%);
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: .92rem;
            letter-spacing: .03em;
            border-radius: 14px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 8px 28px rgba(56, 189, 248, .18);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(56, 189, 248, .3);
        }

        .btn-ghost {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px 24px;
            background: transparent;
            color: var(--muted2);
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: .88rem;
            letter-spacing: .02em;
            border-radius: 14px;
            text-decoration: none;
            border: 1px solid var(--rim2);
            transition: border-color .2s, color .2s;
        }

        .btn-ghost:hover {
            border-color: rgba(56, 189, 248, .35);
            color: var(--accent);
        }

        /* ─── TICKET PERFORATED DIVIDER ─── */
        .perforation {
            position: relative;
            height: 1px;
            margin: 2px 0;
            display: flex;
            align-items: center;
        }

        .perforation::before,
        .perforation::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--bg);
            border: 1px solid var(--rim2);
        }

        .perforation::before { left: -10px; }
        .perforation::after  { right: -10px; }

        .perforation-line {
            flex: 1;
            border-top: 1.5px dashed rgba(255, 255, 255, .08);
        }

        /* ─── FADE-IN ANIMATION ─── */
        .fade-up {
            animation: fadeUp .55s cubic-bezier(.22,.68,0,1.2) both;
        }

        .fade-up--d1 { animation-delay: .08s; }
        .fade-up--d2 { animation-delay: .18s; }
        .fade-up--d3 { animation-delay: .28s; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 480px) {
            .page { padding: 90px 14px 48px; }
            .card { border-radius: 18px; }
            .order-rows { padding: 0 16px 18px; }
            .sec-head { padding: 16px 16px 0; }
            .total-band { margin: 0 10px 16px; padding: 12px 16px; }
            .cta-wrap { padding: 0 14px 18px; }
        }
    </style>

    <!-- BACKGROUND -->
    <div class="page-bg">
        <div class="orb orb--1"></div>
        <div class="orb orb--2"></div>
        <div class="orb orb--3"></div>
    </div>

    <div class="page">

        <!-- ICON -->
        <div class="success-icon-wrap fade-up">
            <div class="success-icon-ring">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
        </div>

        <!-- HEADING -->
        <h1 class="page-title fade-up fade-up--d1">Payment<br>Successful</h1>
        <p class="page-sub fade-up fade-up--d1">
            Your purchase is confirmed and your tickets are being processed.
        </p>
        <span class="page-email-note fade-up fade-up--d1">
            <span class="badge-dot"></span>
            Tickets sent to your email
        </span>

        @if(isset($orderSummary) && $orderSummary)
        <!-- ORDER SUMMARY CARD -->
        <div class="card fade-up fade-up--d2">

            <!-- Event + Ticket info -->
            <div class="sec-head">
                <span class="sec-label">Order Summary</span>
                <span class="sec-line"></span>
            </div>

            <div class="order-rows">
                <div class="order-row">
                    <span class="order-row__key">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        Event
                    </span>
                    <span class="order-row__val">{{ $orderSummary['event_name'] }}</span>
                </div>

                <div class="order-row">
                    <span class="order-row__key">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        Event Date
                    </span>
                    <span class="order-row__val">{{ $orderSummary['event_date'] }}</span>
                </div>

                <div class="order-row">
                    <span class="order-row__key">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
                        </svg>
                        Ticket Type
                    </span>
                    <span class="order-row__val">{{ $orderSummary['ticket_type'] }}</span>
                </div>

                <div class="order-row">
                    <span class="order-row__key">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        Quantity
                    </span>
                    <span class="order-row__val">{{ $orderSummary['quantity'] }} {{ Str::plural('ticket', $orderSummary['quantity']) }}</span>
                </div>

                <div class="order-row">
                    <span class="order-row__key">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        Customer
                    </span>
                    <span class="order-row__val">{{ $orderSummary['customer_name'] }}</span>
                </div>

                <div class="order-row">
                    <span class="order-row__key">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                        Email
                    </span>
                    <span class="order-row__val" style="font-size:.8rem; color:var(--accent);">{{ $orderSummary['customer_email'] }}</span>
                </div>
            </div>

            <!-- Perforated divider -->
            <div class="perforation" style="margin:0 16px;">
                <span class="perforation-line"></span>
            </div>

            <!-- Total -->
            <div class="total-band" style="margin-top:16px;">
                <span class="total-band__label">Total Paid</span>
                <span class="total-band__amount">₱{{ number_format($orderSummary['total'], 2) }}</span>
            </div>

            <!-- CTAs -->
            <div class="cta-wrap">
                <a href="/" class="btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Back to Home
                </a>
                <a href="/events" class="btn-ghost">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Browse More Events
                </a>
            </div>

        </div>
        @else
        <!-- NO ORDER SUMMARY — SIMPLE CTA -->
        <div class="cta-wrap fade-up fade-up--d3" style="width:100%;max-width:340px;margin-top:32px;">
            <a href="/" class="btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Back to Home
            </a>
            <a href="/events" class="btn-ghost">Browse More Events</a>
        </div>
        @endif

    </div>

@endsection
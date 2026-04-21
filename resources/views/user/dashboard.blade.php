@extends('layouts')

@section('content')
    @php
        $sales = $currentTicketSales ?? collect();
    @endphp

    <main class="lg:ml-64 pt-20 min-h-screen bg-slate-950 tickets-page">

        {{-- Ambient background --}}
        <div class="pointer-events-none fixed inset-0 lg:left-64 overflow-hidden" aria-hidden="true">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="grain"></div>
        </div>

        <section class="relative px-4 sm:px-6 lg:px-10 py-10 sm:py-16">
            <div class="mx-auto w-full max-w-6xl">

                {{-- Header --}}
                <header class="mb-10 sm:mb-14">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                        <div class="space-y-3">
                            <span class="badge">
                                <span class="badge-dot"></span>
                                My Tickets
                            </span>
                            <h1 class="page-title">Your Current<br class="hidden sm:block"> Tickets</h1>
                            <p class="page-sub">All your upcoming event tickets, at a glance.</p>
                        </div>

                        @if ($sales->isNotEmpty())
                            <a href="{{ route('user.purchase-history') }}" class="btn-ghost self-start sm:self-auto">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                                Purchase History
                            </a>
                        @endif
                    </div>

                    @if ($sales->isNotEmpty())
                        <div class="mt-6 divider"></div>
                        <p class="tickets-count">
                            {{ $sales->count() }} {{ Str::plural('ticket', $sales->count()) }} found
                        </p>
                    @endif
                </header>

                {{-- Ticket Grid --}}
                @if ($sales->isNotEmpty())
                    <div class="ticket-grid mt-6">
                        @foreach ($sales as $index => $sale)
                            @php
                                $event  = $sale?->event;
                                $ticket = $sale?->ticket;
                            @endphp

                            @if ($event && $ticket)
                                <article class="ticket-card" style="--delay: {{ $index * 60 }}ms">

                                    {{-- Image / Hero --}}
                                    <div class="ticket-hero">
                                        @if ($event->event_image)
                                            <img
                                                src="{{ asset('images/events/' . $event->event_image) }}"
                                                alt="{{ $event->event_name }}"
                                                class="ticket-hero__img"
                                                loading="lazy"
                                            >
                                        @else
                                            <div class="ticket-hero__fallback" aria-hidden="true"></div>
                                        @endif

                                        {{-- Gradient overlay --}}
                                        <div class="ticket-hero__overlay" aria-hidden="true"></div>

                                        {{-- Date badge --}}
                                        <div class="ticket-date-badge" aria-label="Event date">
                                            <span class="ticket-date-badge__month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                                            <span class="ticket-date-badge__day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                        </div>

                                        {{-- Event name --}}
                                        <div class="ticket-hero__label">
                                            <h2 class="ticket-hero__title" title="{{ $event->event_name }}">
                                                {{ $event->event_name }}
                                            </h2>
                                        </div>
                                    </div>

                                    {{-- Perforated divider --}}
                                    <div class="ticket-perforation" aria-hidden="true">
                                        <span class="ticket-perforation__circle ticket-perforation__circle--left"></span>
                                        <span class="ticket-perforation__line"></span>
                                        <span class="ticket-perforation__circle ticket-perforation__circle--right"></span>
                                    </div>

                                    {{-- Body --}}
                                    <div class="ticket-body">
                                        <div class="ticket-meta">
                                            <div class="ticket-meta__item">
                                                <span class="ticket-meta__label">Time</span>
                                                <span class="ticket-meta__value">
                                                    {{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('h:i A') : '-' }}
                                                </span>
                                            </div>
                                            <div class="ticket-meta__sep" aria-hidden="true"></div>
                                            <div class="ticket-meta__item ticket-meta__item--right">
                                                <span class="ticket-meta__label">Type</span>
                                                <span class="ticket-meta__value ticket-meta__value--accent">{{ $ticket->name }}</span>
                                            </div>
                                        </div>

                                        <a
                                            href="{{ route('user.purchase-history') }}"
                                            class="ticket-cta"
                                            aria-label="View ticket details for {{ $event->event_name }}"
                                        >
                                            <span>View Details</span>
                                            <svg class="ticket-cta__icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.22 4.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L11.94 10 7.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </article>
                            @endif
                        @endforeach

                        <a
                            href="{{ url('/') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="buy-ticket-card"
                            aria-label="Buy tickets on landing page"
                        >
                            <span class="buy-ticket-card__eyebrow">Need More?</span>
                            <h2 class="buy-ticket-card__title">Buy Tickets</h2>
                            <p class="buy-ticket-card__text">Open the landing page and get seats for upcoming events.</p>
                            <span class="buy-ticket-card__link">
                                Go to Landing Page
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.22 4.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L11.94 10 7.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </a>
                    </div>

                @else
                    {{-- Empty state --}}
                    <div class="empty-state">
                        <div class="empty-state__icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 18a6 6 0 0112 0v12a6 6 0 01-12 0V18z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M30 18a6 6 0 0112 0v12a6 6 0 01-12 0V18z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M18 24h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="3 3"/>
                                <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 4"/>
                            </svg>
                        </div>
                        <h2 class="empty-state__title">No tickets yet</h2>
                        <p class="empty-state__text">Once you purchase a ticket, it'll show up right here.</p>
                        <a href="{{ route('user.purchase-history') }}" class="btn-primary">
                            Browse Purchase History
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.22 4.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L11.94 10 7.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                @endif

            </div>
        </section>
    </main>

    <style>
        /* ─── Tokens ─────────────────────────────────────────── */
        .tickets-page {
            --cyan:     #22d3ee;
            --cyan-dim: #0e7490;
            --card-bg:  rgba(255,255,255,0.04);
            --card-border: rgba(255,255,255,0.08);
            font-family: 'Syne', 'DM Sans', sans-serif;
        }

        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

        /* ─── Ambient Orbs ───────────────────────────────────── */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: .18;
            pointer-events: none;
        }
        .orb-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, #06b6d4, transparent 70%);
            top: -200px; right: -100px;
            animation: drift 14s ease-in-out infinite alternate;
        }
        .orb-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #3b82f6, transparent 70%);
            bottom: 0; left: 10%;
            animation: drift 18s ease-in-out infinite alternate-reverse;
        }
        .grain {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.06'/%3E%3C/svg%3E");
            opacity: .4;
        }
        @keyframes drift {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(30px, 20px) scale(1.05); }
        }

        /* ─── Header ─────────────────────────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            border: 1px solid rgba(34,211,238,.3);
            background: rgba(34,211,238,.08);
            border-radius: 99px;
            padding: .3rem .85rem;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: #67e8f9;
        }
        .badge-dot {
            display: block;
            width: 6px; height: 6px;
            background: var(--cyan);
            border-radius: 50%;
            box-shadow: 0 0 6px var(--cyan);
        }
        .page-title {
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            letter-spacing: -.02em;
        }
        .page-sub {
            font-size: .83rem;
            color: #94a3b8;
            font-family: 'DM Sans', sans-serif;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,.12) 0%, transparent 100%);
        }
        .tickets-count {
            display: inline-flex;
            align-items: center;
            margin-top: .75rem;
            padding: .4rem .7rem;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,.25);
            background: rgba(15,23,42,.65);
            color: #cbd5e1;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            font-variant-numeric: tabular-nums;
        }

        /* ─── Ghost button ───────────────────────────────────── */
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(255,255,255,.04);
            border-radius: .75rem;
            padding: .55rem 1.1rem;
            font-size: .78rem;
            font-weight: 600;
            color: #cbd5e1;
            text-decoration: none;
            transition: border-color .2s, background .2s, color .2s;
            white-space: nowrap;
        }
        .btn-ghost:hover {
            border-color: rgba(34,211,238,.4);
            background: rgba(34,211,238,.07);
            color: #e2f8ff;
        }

        /* ─── Ticket Grid ────────────────────────────────────── */
        .ticket-grid {
            display: grid;
            gap: 1.25rem;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
        @media (min-width: 640px)  { .ticket-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .ticket-grid { grid-template-columns: repeat(4, 1fr); } }

        /* ─── Ticket Card ────────────────────────────────────── */
        .ticket-card {
            position: relative;
            border-radius: 1.25rem;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 32px rgba(0,0,0,.35);
            animation: card-in .5s ease both;
            animation-delay: var(--delay, 0ms);
            cursor: default;
        }
        @keyframes card-in {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── Ticket Hero ────────────────────────────────────── */
        .ticket-hero {
            position: relative;
            height: 7.5rem;
            overflow: hidden;
        }
        .ticket-hero__img {
            width: 100%; height: 100%;
            object-fit: cover;
        }
        .ticket-hero__fallback {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, #0e7490 0%, #1d4ed8 50%, #4338ca 100%);
        }
        .ticket-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(2,8,23,.95) 0%, rgba(2,8,23,.3) 60%, transparent 100%);
        }
        .ticket-hero__label {
            position: absolute;
            left: .75rem; right: .75rem; bottom: .6rem;
        }
        .ticket-hero__title {
            font-size: .82rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.25;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Date badge */
        .ticket-date-badge {
            position: absolute;
            top: .6rem; right: .6rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(2,8,23,.75);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(34,211,238,.25);
            border-radius: .6rem;
            padding: .25rem .55rem;
            line-height: 1;
        }
        .ticket-date-badge__month {
            font-size: .55rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--cyan);
        }
        .ticket-date-badge__day {
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
            margin-top: .1rem;
        }

        /* ─── Perforation ────────────────────────────────────── */
        .ticket-perforation {
            display: flex;
            align-items: center;
            padding: 0 -.75rem;
            gap: 0;
        }
        .ticket-perforation__circle {
            display: block;
            width: 14px; height: 14px;
            background: #020817; /* matches page bg */
            border-radius: 50%;
            flex-shrink: 0;
            margin: 0 -7px;
            border: 1px solid var(--card-border);
            position: relative;
            z-index: 1;
        }
        .ticket-perforation__line {
            flex: 1;
            height: 1px;
            background: repeating-linear-gradient(
                90deg,
                rgba(255,255,255,.12) 0px,
                rgba(255,255,255,.12) 5px,
                transparent 5px,
                transparent 9px
            );
        }

        /* ─── Ticket Body ────────────────────────────────────── */
        .ticket-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: .6rem;
            padding: .65rem .75rem .75rem;
        }

        /* Meta row */
        .ticket-meta {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .ticket-meta__item {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: .15rem;
        }
        .ticket-meta__item--right {
            align-items: flex-end;
            text-align: right;
        }
        .ticket-meta__label {
            font-size: .58rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #64748b;
        }
        .ticket-meta__value {
            font-size: .78rem;
            font-weight: 700;
            color: #e2e8f0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }
        .ticket-meta__value--accent { color: var(--cyan); }
        .ticket-meta__sep {
            width: 1px; height: 1.8rem;
            background: rgba(255,255,255,.1);
            flex-shrink: 0;
        }

        /* CTA link */
        .ticket-cta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
            background: rgba(34,211,238,.08);
            border: 1px solid rgba(34,211,238,.2);
            border-radius: .65rem;
            padding: .5rem .75rem;
            font-size: .75rem;
            font-weight: 600;
            color: #a5f3fc;
            text-decoration: none;
        }
        .ticket-cta__icon {
            width: 14px; height: 14px;
            flex-shrink: 0;
        }

        .buy-ticket-card {
            border: 2px dashed rgba(34,211,238,.45);
            border-radius: 1.25rem;
            background: rgba(34,211,238,.06);
            min-height: 14.5rem;
            padding: 1rem;
            color: #e2f8ff;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: .5rem;
        }
        .buy-ticket-card__eyebrow {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #67e8f9;
        }
        .buy-ticket-card__title {
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1.1;
            color: #ecfeff;
        }
        .buy-ticket-card__text {
            font-size: .82rem;
            color: #bae6fd;
            max-width: 16rem;
        }
        .buy-ticket-card__link {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            margin-top: .2rem;
            font-size: .78rem;
            font-weight: 700;
            color: #a5f3fc;
        }

        /* ─── Empty State ────────────────────────────────────── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 1rem;
            border: 1px dashed rgba(255,255,255,.1);
            border-radius: 1.5rem;
            background: rgba(255,255,255,.02);
            padding: 4rem 2rem;
            animation: card-in .5s ease both;
        }
        .empty-state__icon {
            width: 72px; height: 72px;
            color: #334155;
            margin-bottom: .5rem;
        }
        .empty-state__title {
            font-size: 1.4rem;
            font-weight: 800;
            color: #f1f5f9;
            letter-spacing: -.01em;
        }
        .empty-state__text {
            font-size: .88rem;
            color: #64748b;
            max-width: 28rem;
            font-family: 'DM Sans', sans-serif;
        }

        /* Primary button */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--cyan);
            border-radius: .85rem;
            padding: .65rem 1.4rem;
            font-size: .85rem;
            font-weight: 700;
            color: #020817;
            text-decoration: none;
            margin-top: .5rem;
            transition: background .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 0 0 0 rgba(34,211,238,0);
        }
        .btn-primary:hover {
            background: #67e8f9;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(34,211,238,.25);
        }

        /* ─── Reduced motion ─────────────────────────────────── */
        @media (prefers-reduced-motion: reduce) {
            .ticket-card, .empty-state { animation: none; }
            .orb-1, .orb-2, .badge-dot { animation: none; }
        }
    </style>
@endsection
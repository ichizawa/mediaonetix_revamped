e@extends('layouts')

@section('content')
@php
    $sales = $currentTicketSales ?? collect();
    $count = $sales->count();
@endphp

<main class="tp-root">

    {{-- Ambient --}}
    <div class="tp-ambient" aria-hidden="true">
        <div class="tp-orb tp-orb--1"></div>
        <div class="tp-orb tp-orb--2"></div>
        <div class="tp-grain"></div>
    </div>

    <div class="tp-wrap">

        {{-- ── PAGE HEADER ─────────────────────────────── --}}
        <header class="tp-header">
            <div class="tp-header__row">
                <div class="tp-header__left">
                    <span style="font-size: .8rem; font-weight: 600; color: var(--tp-mid); text-transform: uppercase; letter-spacing: .1em;">
                        My Tickets
                    </span>
                    <h1 class="tp-title">Your&nbsp;Tickets</h1>
                    <p class="tp-sub">All your upcoming event tickets, at a glance.</p>
                </div>

                @if ($count > 0)
                    <div style="display: flex; gap: 0.75rem; align-items: center;">
                        <form method="GET" action="{{ url()->current() }}" id="ordersSearchForm">
                            <select name="sort" class="tp-search-input" style="padding-left: 1.25rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border-radius: 9999px; background: rgba(255, 255, 255, 0.05); color: var(--tp-text); border: 1px solid rgba(255, 255, 255, 0.1); cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2322d3ee%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem top 50%; background-size: 0.65rem auto; padding-right: 2.5rem;" onchange="this.form.submit();">
                                <option value="asc" {{ ($sort ?? 'asc') === 'asc' ? 'selected' : '' }} style="background: #0C1222; color: #fff;">Earliest First</option>
                                <option value="desc" {{ ($sort ?? 'asc') === 'desc' ? 'selected' : '' }} style="background: #0C1222; color: #fff;">Latest First</option>
                            </select>
                        </form>
                        <a href="{{ route('user.purchase-history') }}" class="tp-btn-ghost" aria-label="View purchase history">
                            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                            History
                        </a>
                    </div>
                @endif
            </div>

            @if ($count > 0)
                <div class="tp-header__meta">
                    <div class="tp-divider"></div>
                    <span class="tp-count">
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a1 1 0 01-1 1 1 1 0 110 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a1 1 0 110-2V6z"/>
                        </svg>
                        {{ $count }} {{ Str::plural('ticket', $count) }}
                    </span>
                </div>
            @endif
        </header>

        {{-- ── TICKETS ──────────────────────────────────── --}}
        @if ($count > 0)

            <div class="tp-grid">
                @foreach ($sales as $i => $sale)
                    @php
                        $event  = $sale?->event;
                        $ticket = $sale?->ticket;
                    @endphp

                    @if ($event && $ticket)
                        @php
                            $date    = \Carbon\Carbon::parse($event->event_date);
                            $timeStr = $event->event_time
                                ? \Carbon\Carbon::parse($event->event_time)->format('h:i A')
                                : '—';

                            $cropStyle = '';
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
                        @endphp

                        <article class="tp-card" style="--i:{{ $i }}">

                            {{-- Hero --}}
                            <div class="tp-card__hero">
                                @if ($event->event_image)
                                    <img
                                        src="{{ asset('images/events/' . $event->event_image) }}"
                                        alt="{{ $event->event_name }}"
                                        class="tp-card__img"
                                        style="{{ $cropStyle }}"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="tp-card__fallback" aria-hidden="true"></div>
                                @endif
                                <div class="tp-card__overlay" aria-hidden="true"></div>



                                {{-- Ticket type --}}
                                <span class="tp-card__type">{{ $ticket->name }}</span>
                            </div>

                            {{-- Perforation --}}
                            <div class="tp-perf" aria-hidden="true">
                                <span class="tp-perf__notch tp-perf__notch--l"></span>
                                <span class="tp-perf__dash"></span>
                                <span class="tp-perf__notch tp-perf__notch--r"></span>
                            </div>

                            {{-- Body --}}
                            <div class="tp-card__body">
                                <h2 class="tp-card__name" title="{{ $event->event_name }}">
                                    {{ $event->event_name }}
                                </h2>

                                <div class="tp-card__info">
                                    <div class="tp-info-row">
                                        <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                        <span>{{ $date->format('D, M j Y') }}</span>
                                    </div>
                                    <div class="tp-info-row">
                                        <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                        <span>{{ $timeStr }}</span>
                                    </div>
                                    @if (!empty($event->event_location))
                                        <div class="tp-info-row">
                                            <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                            <span class="tp-info-row__trunc">{{ $event->event_location }}</span>
                                        </div>
                                    @elseif (!empty($event->event_venue))
                                        <div class="tp-info-row">
                                            <svg class="tp-info-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                            <span class="tp-info-row__trunc">{{ $event->event_venue }}</span>
                                        </div>
                                    @endif
                                </div>

                                <a
                                    href="{{ route('user.purchase-history') }}"
                                    class="tp-card__cta"
                                    aria-label="View details for {{ $event->event_name }}"
                                >
                                    View Details
                                    <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.22 4.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L11.94 10 7.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
                                </a>
                            </div>

                        </article>
                    @endif
                @endforeach

                {{-- Buy-more card --}}
                <a
                    href="{{ url('/') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="tp-buy-card"
                    aria-label="Buy more tickets"
                >
                    <span class="tp-buy-card__plus" aria-hidden="true">+</span>
                    <span class="tp-buy-card__eyebrow">Need More?</span>
                    <strong class="tp-buy-card__title">Buy Tickets</strong>
                    <p class="tp-buy-card__text">Get seats for upcoming events from the landing page.</p>
                    <span class="tp-buy-card__link">
                        Go to Landing Page
                        <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.22 4.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L11.94 10 7.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
                    </span>
                </a>
            </div>

        @else

            {{-- ── EMPTY STATE ─────────────────────────────── --}}
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
                <h2 class="tp-empty__title">No tickets yet</h2>
                <p class="tp-empty__text">Once you purchase a ticket, it'll appear right here.</p>
                <div class="tp-empty__actions">
                    <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" class="tp-btn-primary">
                        Browse Events
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.22 4.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L11.94 10 7.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
                    </a>
                    <a href="{{ route('user.purchase-history') }}" class="tp-btn-ghost">
                        Purchase History
                    </a>
                </div>
            </div>

        @endif

    </div>{{-- /.tp-wrap --}}
</main>

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

.tp-btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    flex-shrink: 0;
    border: 1px solid var(--tp-card-border);
    background: var(--tp-card-bg);
    border-radius: .7rem;
    padding: .48rem .95rem;
    font-size: .76rem;
    font-weight: 600;
    color: var(--tp-mid);
    text-decoration: none;
    white-space: nowrap;
    transition: border-color .18s, color .18s, background .18s;
}
.tp-btn-ghost:hover {
    border-color: var(--tp-cyan-border);
    background: var(--tp-cyan-glow);
    color: #e0f9ff;
}

.tp-header__meta { margin-top: 1.2rem; }
.tp-divider {
    height: 1px;
    background: linear-gradient(90deg, rgba(255,255,255,.1), transparent);
    margin-bottom: .65rem;
}
.tp-count {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    border: 1px solid rgba(148,163,184,.18);
    background: rgba(15,23,42,.55);
    border-radius: 99px;
    padding: .28rem .65rem;
    font-size: .66rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--tp-mid);
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

/* Ticket type badge */
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
}
.tp-card__cta:hover {
    background: rgba(34,211,238,.13);
    border-color: rgba(34,211,238,.35);
}

/* ── Buy-more card ───────────────────────────────────── */
.tp-buy-card {
    border: 2px dashed rgba(34,211,238,.3);
    border-radius: 1.1rem;
    background: rgba(34,211,238,.03);
    padding: 1.4rem 1rem;
    color: #e2f8ff;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: .42rem;
    min-height: 13rem;
    position: relative;
    overflow: hidden;
    transition: background .2s, border-color .2s;
}
.tp-buy-card:hover {
    background: rgba(34,211,238,.07);
    border-color: rgba(34,211,238,.5);
}
.tp-buy-card__plus {
    position: absolute;
    top: .5rem; right: .9rem;
    font-size: 2.4rem;
    font-weight: 800;
    color: rgba(34,211,238,.18);
    line-height: 1;
    pointer-events: none;
}
.tp-buy-card__eyebrow {
    font-size: .6rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: #67e8f9;
}
.tp-buy-card__title {
    font-size: 1.2rem;
    font-weight: 800;
    color: #ecfeff;
    line-height: 1.1;
    display: block;
}
.tp-buy-card__text {
    font-size: .76rem;
    color: #7dd3fc;
    line-height: 1.5;
    margin: 0;
}
.tp-buy-card__link {
    display: inline-flex;
    align-items: center;
    gap: .32rem;
    font-size: .74rem;
    font-weight: 700;
    color: #a5f3fc;
    margin-top: .2rem;
}

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
.tp-empty__actions {
    display: flex;
    flex-wrap: wrap;
    gap: .6rem;
    justify-content: center;
    margin-top: .4rem;
}

/* Primary button */
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

/* ── Reduced motion ──────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
    .tp-card, .tp-empty       { animation: none; }
    .tp-orb--1, .tp-orb--2   { animation: none; }
    .tp-badge__dot            { animation: none; }
    .tp-card:hover            { transform: none; }
    .tp-btn-primary:hover     { transform: none; }
}
</style>
@endsection
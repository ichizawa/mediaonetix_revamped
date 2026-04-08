@extends('layouts')

@section('content')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">


    <main style="background:#08070f; min-height:100vh; font-family:'Outfit',sans-serif; color:#f0eeff; overflow-x:hidden;">


        {{-- Page Header --}}
        <div style="position:relative; padding:100px 28px 56px; max-width:860px; margin:0 auto; overflow:hidden;">
   
        </div>

        {{-- Main content wrap --}}
        <div style="padding:0 28px 140px; max-width:860px; margin:0 auto;">

            {{-- Event Filter --}}
            @if(isset($events) && $events->count())
                <form method="GET" style="margin-bottom: 32px;">
                    <label for="event" style="font-family:'Space Mono',monospace; font-size:.85rem; color:#9590b0; font-weight:700; margin-right:10px;">Filter by Event:</label>
                    <select name="event" id="event" onchange="this.form.submit()" style="padding:8px 16px; border-radius:8px; border:1px solid #222; background:#141226; color:#fff; font-family:'Outfit',sans-serif; font-size:1rem;">
                        <option value="">All Events</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ (isset($selectedEvent) && $selectedEvent == $event->id) ? 'selected' : '' }}>{{ $event->event_name }}</option>
                        @endforeach
                    </select>
                </form>
            @endif

            @php
                $isPaginated = method_exists($customerTickets, 'total');
            @endphp
            @if (($isPaginated && $customerTickets->total() > 0) || (!$isPaginated && $customerTickets->count() > 0))

                {{-- Stats Row --}}
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:40px;">
                  
                </div>

                {{-- Section header --}}
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:22px; margin-top:48px;">
                    <span style="font-family:'Space Mono',monospace; font-size:.72rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#9590b0; white-space:nowrap;">Orders</span>
                    <div style="flex:1; height:1px; background:rgba(255,255,255,0.07);"></div>
                    @if($isPaginated)
                        <span style="font-family:'Space Mono',monospace; font-size:.72rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#9590b0; white-space:nowrap;">
                            Page {{ $customerTickets->currentPage() }} of {{ $customerTickets->lastPage() }}
                        </span>
                    @endif
                </div>

                {{-- Order Cards --}}
                <div style="display:flex; flex-direction:column; gap:16px;">
                    @foreach ($isPaginated ? $customerTickets : $customerTickets as $customerTicket)
                        <div style="background:#141226; border:1px solid rgba(255,255,255,0.07); border-radius:22px; padding:26px 28px; position:relative; overflow:hidden;">

                            {{-- Top shimmer line --}}
                            <div style="position:absolute; top:0; left:0; right:0; height:1px; background:linear-gradient(90deg,transparent,rgba(56,189,248,.2),transparent);"></div>
                            {{-- Left accent stripe --}}
                            <div style="position:absolute; top:20%; left:0; width:3px; height:60%; background:linear-gradient(to bottom,#7c3aed,#38bdf8); border-radius:0 3px 3px 0; opacity:.6;"></div>

                            {{-- Top row --}}
                            <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:20px; margin-bottom:20px;">
                                <div style="font-weight:700; font-size:1.15rem; color:#fff; line-height:1.2;">
                                    {{ $customerTicket->ticket->name ?? 'Standard Ticket' }}
                                </div>
                                <div style="display:inline-flex; align-items:center; gap:7px; font-family:'Space Mono',monospace; font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; padding:7px 16px; border-radius:999px; border:1px solid rgba(74,222,128,.3); color:#4ade80; background:rgba(74,222,128,.07); flex-shrink:0;">
                                    <span style="width:7px; height:7px; background:#4ade80; border-radius:50%; box-shadow:0 0 6px #4ade80; display:inline-block;"></span>
                                    Completed
                                </div>
                            </div>

                            {{-- Divider --}}
                            <div style="height:1px; background:rgba(255,255,255,0.07); margin-bottom:18px;"></div>

                            {{-- Meta grid --}}
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px 28px;">

                                <div>
                                    <p style="font-family:'Space Mono',monospace; font-size:.62rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#6b6585; margin-bottom:5px;">Order ID</p>
                                    <p style="font-family:'Space Mono',monospace; font-size:.88rem; color:#f0eeff; font-weight:500;">
                                        #{{ str_pad($customerTicket->sale->id, 6, '0', STR_PAD_LEFT) }}
                                    </p>
                                </div>

                                <div>
                                    <p style="font-family:'Space Mono',monospace; font-size:.62rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#6b6585; margin-bottom:5px;">Amount</p>
                                    <p style="font-family:'Bebas Neue',sans-serif; font-size:1.9rem; letter-spacing:.04em; color:#38bdf8; line-height:1;">
                                        ${{ number_format($customerTicket->sale->total_amount ?? $customerTicket->ticket->price ?? 0, 2) }}
                                    </p>
                                </div>

                                <div>
                                    <p style="font-family:'Space Mono',monospace; font-size:.62rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#6b6585; margin-bottom:5px;">Purchase Date</p>
                                    <p style="font-size:.95rem; color:#9590b0; font-weight:500;">
                                        {{ $customerTicket->sale->created_at->format('M d, Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p style="font-family:'Space Mono',monospace; font-size:.62rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#6b6585; margin-bottom:5px;">Time</p>
                                    <p style="font-size:.95rem; color:#9590b0; font-weight:500;">
                                        {{ $customerTicket->sale->created_at->format('h:i A') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($isPaginated && $customerTickets->hasPages())
                    <div style="display:flex; align-items:center; justify-content:center; gap:8px; margin-top:48px; flex-wrap:wrap;">

                        {{-- Prev --}}
                        @if ($customerTickets->onFirstPage())
                            <span style="display:inline-flex; align-items:center; gap:6px; padding:10px 20px; border-radius:999px; border:1px solid rgba(255,255,255,0.07); color:#6b6585; font-family:'Space Mono',monospace; font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; cursor:not-allowed;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Prev
                            </span>
                        @else
                            <a href="{{ $customerTickets->previousPageUrl() }}"
                               style="display:inline-flex; align-items:center; gap:6px; padding:10px 20px; border-radius:999px; border:1px solid rgba(255,255,255,0.12); background:rgba(255,255,255,0.04); color:#f0eeff; text-decoration:none; font-family:'Space Mono',monospace; font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Prev
                            </a>
                        @endif

                        {{-- Page numbers --}}
                        @foreach ($customerTickets->getUrlRange(1, $customerTickets->lastPage()) as $page => $url)
                            @if ($page == $customerTickets->currentPage())
                                <span style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; border-radius:999px; border:1px solid rgba(56,189,248,.4); background:rgba(56,189,248,.12); color:#38bdf8; font-family:'Space Mono',monospace; font-size:.75rem; font-weight:700;">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; border-radius:999px; border:1px solid rgba(255,255,255,0.07); background:transparent; color:#9590b0; text-decoration:none; font-family:'Space Mono',monospace; font-size:.75rem; font-weight:700;">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($customerTickets->hasMorePages())
                            <a href="{{ $customerTickets->nextPageUrl() }}"
                               style="display:inline-flex; align-items:center; gap:6px; padding:10px 20px; border-radius:999px; border:1px solid rgba(255,255,255,0.12); background:rgba(255,255,255,0.04); color:#f0eeff; text-decoration:none; font-family:'Space Mono',monospace; font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;">
                                Next
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:6px; padding:10px 20px; border-radius:999px; border:1px solid rgba(255,255,255,0.07); color:#6b6585; font-family:'Space Mono',monospace; font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; cursor:not-allowed;">
                                Next
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        @endif

                    </div>

                    {{-- Page info --}}
                    <p style="text-align:center; margin-top:16px; font-family:'Space Mono',monospace; font-size:.65rem; color:#6b6585; letter-spacing:.1em;">
                        Showing {{ $customerTickets->firstItem() }}–{{ $customerTickets->lastItem() }} of {{ $customerTickets->total() }} orders
                    </p>
                @endif

            @else

                {{-- Section header --}}
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:22px; margin-top:48px;">
                    <span style="font-family:'Space Mono',monospace; font-size:.72rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#9590b0; white-space:nowrap;">Orders</span>
                    <div style="flex:1; height:1px; background:rgba(255,255,255,0.07);"></div>
                </div>

                {{-- Empty state --}}
                <div style="background:#141226; border:1px solid rgba(255,255,255,0.07); border-radius:22px; padding:80px 32px; text-align:center; position:relative; overflow:hidden;">
                    <div style="position:absolute; width:320px; height:320px; background:rgba(124,58,237,0.25); border-radius:50%; filter:blur(90px); top:50%; left:50%; transform:translate(-50%,-50%); pointer-events:none;"></div>

                    <div style="width:72px; height:72px; background:rgba(56,189,248,.08); border:1px solid rgba(56,189,248,.18); border-radius:22px; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; position:relative;">
                        <svg width="32" height="32" fill="none" stroke="#38bdf8" viewBox="0 0 24 24" style="opacity:.7;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>

                    <h2 style="font-family:'Bebas Neue',sans-serif; font-size:2.6rem; letter-spacing:.06em; color:#fff; margin-bottom:10px; position:relative;">No Orders Yet</h2>
                    <p style="font-size:.95rem; color:#6b6585; line-height:1.7; max-width:320px; margin:0 auto; position:relative;">
                        You haven't purchased any tickets yet. Explore upcoming events and grab your spot.
                    </p>
                    <a href="{{ route('events.index') }}"
                       style="display:inline-flex; align-items:center; gap:8px; margin-top:28px; padding:12px 26px; background:rgba(56,189,248,.1); border:1px solid rgba(56,189,248,.3); border-radius:999px; color:#38bdf8; font-family:'Space Mono',monospace; font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; text-decoration:none; position:relative;">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Browse Events
                    </a>
                </div>

            @endif

        </div>
    </main>

@endsection
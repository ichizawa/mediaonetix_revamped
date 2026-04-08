@extends('layouts')

@section('content')

    {{-- Minimal sticky header --}}
    <header class="fixed top-0 inset-x-0 z-50 h-14 flex items-center justify-center bg-[#0d0d1a]/95 backdrop-blur-md border-b border-white/5">
        <a href="{{ route('public') }}">
            <span class="text-xl font-black tracking-tight" style="font-family:'Outfit',sans-serif;">
                <span class="text-white">MediaOne</span><span style="background:linear-gradient(90deg,#a855f7,#7c3aed);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">TIX</span>
            </span>
        </a>
    </header>

    {{-- Hero --}}
    <section class="pt-28 pb-8 sm:pt-32 sm:pb-10 bg-[#0c1222] text-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full text-blue-300 text-xs font-medium mb-4">
                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
                ALL EVENTS
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-3 leading-tight">
                Discover <span class="ve-gradient-text">Events</span>
            </h1>
            <p class="text-gray-400 text-sm sm:text-base max-w-md mx-auto">
                Filter, search, and grab your tickets instantly.
            </p>
        </div>
    </section>

    {{-- Filter & Search --}}
    <div class="sticky top-14 z-40 bg-[#0c1222]/95 backdrop-blur-md border-b border-white/5">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 py-3 space-y-3">

            {{-- Row 1: Search + Sort --}}
            <div class="flex gap-2">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                    </svg>
                    <input id="search-input" type="search" placeholder="Search events, venues..."
                        class="w-full pl-9 pr-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-gray-500 focus:outline-none focus:border-blue-500/50 transition-colors"
                        value="{{ request('search') }}">
                </div>
                <div class="relative flex-shrink-0">
                    <select id="sort-select"
                        class="appearance-none bg-white/5 border border-white/10 rounded-lg text-xs text-gray-300 pl-3 pr-8 py-2 focus:outline-none focus:border-blue-500/50 transition-colors cursor-pointer h-full">
                        <option value="date_asc">Earliest</option>
                        <option value="date_desc">Latest</option>
                        <option value="price_asc">Price ↑</option>
                        <option value="price_desc">Price ↓</option>
                    </select>
                    <svg class="absolute right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            {{-- Row 2: Category pills (horizontal scroll on mobile) --}}
            <div class="flex gap-2 overflow-x-auto pb-0.5 scrollbar-hide no-scrollbar">
                @php
                    $categories    = $events->pluck('category')->unique()->filter()->sort()->values();
                    $allCategories = collect(['All'])->merge($categories);
                    $activeCategory = request('category', 'All');
                @endphp
                @foreach ($allCategories as $cat)
                    <a href="{{ route('events.view', array_filter(['category' => $cat === 'All' ? null : $cat, 'search' => request('search')])) }}"
                        class="flex-shrink-0 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors whitespace-nowrap
                        {{ $activeCategory === $cat
                            ? 'bg-blue-600 border-blue-500 text-white'
                            : 'bg-white/5 border-white/10 text-gray-400 hover:text-white hover:bg-white/10' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            {{-- Row 3: Status filter pills --}}
            @php
                $statuses = \App\Models\Events::STATUS;
                $activeStatus = request('status', 'all');
            @endphp
            <div class="flex gap-2 overflow-x-auto no-scrollbar">
                <button type="button" data-status-filter="all"
                    class="status-pill flex-shrink-0 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors whitespace-nowrap
                    {{ $activeStatus === 'all' ? 'bg-blue-600 border-blue-500 text-white' : 'bg-white/5 border-white/10 text-gray-400 hover:text-white hover:bg-white/10' }}">
                    All Status
                </button>
                @foreach($statuses as $key => $s)
                    <button type="button" data-status-filter="{{ $key }}"
                        class="status-pill flex-shrink-0 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors whitespace-nowrap
                        {{ $activeStatus == $key ? 'bg-blue-600 border-blue-500 text-white' : 'bg-white/5 border-white/10 text-gray-400 hover:text-white hover:bg-white/10' }}">
                        {{ $s['label'] }}
                    </button>
                @endforeach
            </div>

            {{-- Results count --}}
            <div class="flex items-center justify-between">
                <p id="results-count" class="text-xs text-gray-500">
                    Showing <span class="text-blue-400 font-semibold">{{ $events->count() }}</span>
                    event{{ $events->count() !== 1 ? 's' : '' }}
                    @if(request('search'))for "<span class="text-white">{{ request('search') }}</span>"@endif
                </p>
                @if(request('search') || (request('category') && request('category') !== 'All') || (request('status') && request('status') !== 'all'))
                    <a href="{{ route('events.view') }}" class="text-xs text-blue-400 hover:text-blue-300 transition-colors">Clear filters</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Events Grid --}}
    <section class="py-8 sm:py-12 bg-[#111827] min-h-[50vh]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">

            @if ($events->count() > 0)
                <div id="events-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
                    @foreach ($events as $event)
                        @php
                            $hasCrop =
                                !is_null($event->crop_x) && !is_null($event->crop_y) &&
                                !is_null($event->crop_width) && !is_null($event->crop_height) &&
                                !empty($event->crop_natural_width) && !empty($event->crop_natural_height) &&
                                $event->crop_width > 0 && $event->crop_height > 0;

                            $cropImageStyle = 'width:100%;height:100%;object-fit:cover;';
                            if ($hasCrop) {
                                $wPct = ($event->crop_natural_width  / $event->crop_width)  * 100;
                                $hPct = ($event->crop_natural_height / $event->crop_height) * 100;
                                $lPct = -($event->crop_x / $event->crop_width)  * 100;
                                $tPct = -($event->crop_y / $event->crop_height) * 100;
                                $cropImageStyle = sprintf(
                                    'width:%.4f%%;height:%.4f%%;max-width:none;max-height:none;left:%.4f%%;top:%.4f%%;',
                                    $wPct, $hPct, $lPct, $tPct
                                );
                            }

                            $ticketsLeft  = $event->tickets_sum_quantity ?? 0;
                            $ticketsTotal = $event->tickets_sum_original_qty ?? 0;
                            if ($ticketsTotal <= 0) {
                                $badge = ['text' => 'Upcoming',     'cls' => 'bg-violet-500/80'];
                            } elseif ($ticketsLeft <= 0) {
                                $badge = ['text' => 'Sold Out',     'cls' => 'bg-red-500/80'];
                            } elseif ($ticketsTotal > 0 && ($ticketsLeft / $ticketsTotal) <= 0.30) {
                                $badge = ['text' => 'Selling Fast', 'cls' => 'bg-orange-500/80'];
                            } else {
                                $badge = ['text' => 'Available',    'cls' => 'bg-green-500/80'];
                            }

                            $statusColor = data_get($event, 'status_label.color', 'blue');
                            $hex = ['yellow'=>'#ca8a04','green'=>'#16a34a','blue'=>'#2563eb','grey'=>'#6b7280','red'=>'#dc2626'][$statusColor] ?? '#2563eb';
                        @endphp

                        <div class="event-card purchase-btn group relative bg-[#1a2235] border border-white/8 rounded-xl overflow-hidden transition-all duration-300 hover:border-blue-500/40 hover:shadow-lg hover:shadow-blue-500/10 hover:-translate-y-0.5 cursor-pointer"
                            data-event-id="{{ $event->id }}"
                            data-name="{{ strtolower($event->event_name) }}"
                            data-venue="{{ strtolower($event->event_venue) }}"
                            data-category="{{ $event->category }}"
                            data-status="{{ (string) ($event->status ?? 0) }}"
                            data-date="{{ $event->event_date }}"
                            data-price="{{ $event->tickets_min_price ?? 0 }}">

                            {{-- Image --}}
                            <div class="relative aspect-[4/3] sm:aspect-[16/10] overflow-hidden bg-[#111827]">
                                @if (!empty($event->event_image))
                                    <img src="{{ asset('images/events/' . $event->event_image) }}"
                                        alt="{{ $event->event_name }}"
                                        class="absolute group-hover:scale-105 transition-transform duration-500"
                                        style="{{ $cropImageStyle }}"
                                        loading="lazy">
                                    <div class="absolute inset-0 bg-black/20"></div>
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center" style="background:linear-gradient(135deg,{{ $hex }}22,{{ $hex }}44);">
                                        <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2 px-2 py-0.5 {{ $badge['cls'] }} rounded text-white text-[10px] font-semibold">{{ $badge['text'] }}</div>
                                <div class="absolute bottom-2 left-2 px-2 py-0.5 bg-black/50 rounded text-white text-[10px] font-medium">{{ $event->category }}</div>
                            </div>

                            {{-- Content --}}
                            <div class="p-3 sm:p-4 space-y-2">
                                <div class="flex items-center gap-1 text-[10px] sm:text-xs font-semibold" style="color:{{ $hex }};">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ date('M d, Y', strtotime($event->event_date)) }}
                                </div>

                                <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-blue-400 transition-colors line-clamp-1">
                                    {{ $event->event_name }}
                                </h3>

                                <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($event->description ?? ''))), 90) }}
                                </p>

                                <div class="flex items-center gap-1 text-[10px] sm:text-xs text-gray-500">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="line-clamp-1">{{ $event->event_venue }}</span>
                                </div>

                                <div class="flex items-center justify-between gap-2 pt-2 border-t border-white/5">
                                    <div class="min-w-0">
                                        <div class="text-[9px] text-gray-600 uppercase tracking-wide">From</div>
                                        <div class="text-sm font-bold text-white whitespace-nowrap">₱{{ number_format($event->tickets_min_price, 2) }}</div>
                                    </div>
                                    <button class="purchase-btn flex-shrink-0 px-4 py-2 rounded-lg text-xs font-semibold text-white transition-opacity hover:opacity-80 whitespace-nowrap"
                                        style="background-color:{{ $hex }};"
                                        data-event-id="{{ $event->id }}">
                                        Buy Tickets
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="no-results" class="hidden text-center py-16">
                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-lg font-bold text-white mb-1">No events found</h3>
                    <p class="text-sm text-gray-500">Try a different search or clear the filters.</p>
                </div>

            @else
                <div class="text-center py-20">
                    <svg class="w-14 h-14 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">No upcoming events</h3>
                    <p class="text-sm text-gray-400 mb-6">Check back soon — new events are added regularly!</p>
                    <a href="{{ route('public') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-lg transition-colors text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Home
                    </a>
                </div>
            @endif
        </div>
    </section>

    <x-footer />

    <style>
        .ve-gradient-text {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .event-card { animation: veCardIn .35s ease both; }
        .event-card:nth-child(2) { animation-delay: .06s; }
        .event-card:nth-child(3) { animation-delay: .12s; }
        .event-card:nth-child(4) { animation-delay: .18s; }
        .event-card:nth-child(n+5) { animation-delay: .22s; }
        @keyframes veCardIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .event-card.hidden-card { display: none; }
        select option { background: #111827; color: #d1d5db; }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const search      = document.getElementById('search-input');
        const sort        = document.getElementById('sort-select');
        const grid        = document.getElementById('events-grid');
        const noRes       = document.getElementById('no-results');
        const countEl     = document.getElementById('results-count');
        const cards       = grid ? [...grid.querySelectorAll('.event-card')] : [];
        const statusPills = document.querySelectorAll('.status-pill');

        let activeStatus = @json((string) request('status', 'all')); // tracks current status filter

        // Status pill clicks
        statusPills.forEach(pill => {
            pill.addEventListener('click', () => {
                activeStatus = pill.dataset.statusFilter;
                statusPills.forEach(p => {
                    const isActive = p.dataset.statusFilter === activeStatus;
                    p.classList.toggle('bg-blue-600',    isActive);
                    p.classList.toggle('border-blue-500', isActive);
                    p.classList.toggle('text-white',      isActive);
                    p.classList.toggle('bg-white/5',      !isActive);
                    p.classList.toggle('border-white/10', !isActive);
                    p.classList.toggle('text-gray-400',   !isActive);
                });
                run();
            });
        });

        function run() {
            const q = (search?.value || '').toLowerCase().trim();
            const s = sort?.value || 'date_asc';

            let visible = cards.filter(c => {
                const textHit   = !q || c.dataset.name.includes(q) || c.dataset.venue.includes(q) || c.dataset.category.toLowerCase().includes(q);
                const cardStatus = String(c.dataset.status ?? '').trim();
                const statusHit = activeStatus === 'all' || cardStatus === String(activeStatus);
                const hit = textHit && statusHit;
                c.classList.toggle('hidden-card', !hit);
                return hit;
            });

            visible.sort((a, b) => {
                if (s === 'price_asc')  return +a.dataset.price - +b.dataset.price;
                if (s === 'price_desc') return +b.dataset.price - +a.dataset.price;
                if (s === 'date_desc')  return b.dataset.date.localeCompare(a.dataset.date);
                return a.dataset.date.localeCompare(b.dataset.date);
            });

            visible.forEach(c => grid.appendChild(c));

            if (noRes)  noRes.classList.toggle('hidden', visible.length > 0);
            if (countEl) {
                const term = search?.value ? ` for "<span class="text-white">${search.value}</span>"` : '';
                countEl.innerHTML = `Showing <span class="text-blue-400 font-semibold">${visible.length}</span> event${visible.length !== 1 ? 's' : ''}${term}`;
            }
        }

        search?.addEventListener('input', run);
        sort?.addEventListener('change', run);
        run();
    });
    </script>

    <script src="{{ asset('js/tickets.js') }}"></script>
@endsection

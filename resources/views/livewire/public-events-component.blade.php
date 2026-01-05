<div>
    <section class="relative py-16 sm:py-20 md:py-24 lg:py-32 bg-[#111827]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-12 sm:mb-16">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-4">
                        <span class="text-blue-300 text-xs sm:text-sm font-medium">UPCOMING</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white">
                        Recent <span class="gradient-text">Events</span>
                    </h2>
                </div>
                <button
                    class="group px-6 py-3 border border-blue-500/30 rounded-xl font-semibold hover:bg-blue-500/10 transition-all inline-flex items-center gap-2 text-blue-400">
                    View All Events
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Events Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @forelse($events as $event)
                        <div
                        class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-{{ $event->statuslabel['color'] }}-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-{{ $event->statuslabel['color'] }}-500/10">
                        <!-- Image -->
                        <div class="relative aspect-[16/10] bg-gradient-to-br from-{{ $event->statuslabel['color'] }}-600 to-{{ $event->statuslabel['color'] }}-400 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="absolute top-3 left-3 px-2.5 py-1 bg-{{ $event->statuslabel['color'] }}-500 rounded-lg text-white text-xs font-bold">
                                {{ date('M d', strtotime($event->event_date)) }}
                            </div>
                            <div
                                class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
                                {{ $event->tickets_sum_quantity ?? 0 }} left
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 space-y-4">
                            <div>
                                <div class="text-xs text-{{ $event->statuslabel['color'] }}-400 font-semibold mb-2">{{ $event->category }}</div>
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-{{ $event->statuslabel['color'] }}-400 transition-colors">
                                    {{ $event->event_name }}
                                </h3>
                                <p class="text-sm text-gray-400 line-clamp-2">
                                    {{ $event->description }}
                                </p>
                            </div>

                            <div class="flex items-center gap-4 text-sm text-gray-400">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                    </svg>
                                    <span>{{ $event->event_venue }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                <div>
                                    <div class="text-xs text-gray-500">From</div>
                                    <div class="text-2xl font-bold text-white">₱{{ number_format($event->tickets_min_price, 2) }}</div>
                                </div>
                                <button
                                    class="px-5 py-2.5 bg-{{ $event->statuslabel['color'] }}-600 hover:bg-{{ $event->statuslabel['color'] }}-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                    Buy Tickets
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    
                @endforelse
                {{-- <!-- Event Card 1 -->
                <div
                    class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-blue-600 to-blue-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute top-3 left-3 px-2.5 py-1 bg-blue-500 rounded-lg text-white text-xs font-bold">
                            JAN 15
                        </div>
                        <div
                            class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
                            248 left
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 space-y-4">
                        <div>
                            <div class="text-xs text-blue-400 font-semibold mb-2">ELECTRONIC • TECHNO</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">
                                Underground Beats Festival
                            </h3>
                            <p class="text-sm text-gray-400 line-clamp-2">
                                Experience the underground electronic music scene with top DJs and producers.
                            </p>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                </svg>
                                <span>Warehouse 51</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$45</div>
                            </div>
                            <button
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div
                    class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-green-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-green-600 to-green-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute top-3 left-3 px-2.5 py-1 bg-green-500 rounded-lg text-white text-xs font-bold">
                            JAN 20
                        </div>
                        <div
                            class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
                            512 left
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 space-y-4">
                        <div>
                            <div class="text-xs text-green-400 font-semibold mb-2">INDIE • ALTERNATIVE</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-green-400 transition-colors">
                                Indie Vibes Live Session
                            </h3>
                            <p class="text-sm text-gray-400 line-clamp-2">
                                An intimate evening with emerging indie artists in a cozy atmosphere.
                            </p>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                </svg>
                                <span>The Music Hall</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$35</div>
                            </div>
                            <button
                                class="px-5 py-2.5 bg-green-600 hover:bg-green-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div
                    class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-orange-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-orange-500/10">
                    <!-- Image -->
                    <div
                        class="relative aspect-[16/10] bg-gradient-to-br from-orange-600 to-orange-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute top-3 left-3 px-2.5 py-1 bg-orange-500 rounded-lg text-white text-xs font-bold">
                            JAN 25
                        </div>
                        <div
                            class="absolute top-3 right-3 px-2.5 py-1 bg-red-500 rounded-lg text-white text-xs font-bold flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            SELLING FAST
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 space-y-4">
                        <div>
                            <div class="text-xs text-orange-400 font-semibold mb-2">HIP-HOP • RAP</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-orange-400 transition-colors">
                                Urban Legends Hip-Hop Night
                            </h3>
                            <p class="text-sm text-gray-400 line-clamp-2">
                                The hottest hip-hop artists bringing fire to the stage. Don't miss out!
                            </p>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                </svg>
                                <span>Metro Arena</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$55</div>
                            </div>
                            <button
                                class="px-5 py-2.5 bg-orange-600 hover:bg-orange-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 4 -->
                <div
                    class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-pink-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-pink-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-pink-600 to-pink-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute top-3 left-3 px-2.5 py-1 bg-pink-500 rounded-lg text-white text-xs font-bold">
                            FEB 01
                        </div>
                        <div
                            class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
                            890 left
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 space-y-4">
                        <div>
                            <div class="text-xs text-pink-400 font-semibold mb-2">POP • DANCE</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-pink-400 transition-colors">
                                Pop Paradise Concert
                            </h3>
                            <p class="text-sm text-gray-400 line-clamp-2">
                                Dance the night away with chart-topping pop hits and amazing performances.
                            </p>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                </svg>
                                <span>City Center</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$68</div>
                            </div>
                            <button
                                class="px-5 py-2.5 bg-pink-600 hover:bg-pink-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 5 -->
                <div
                    class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-cyan-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-cyan-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-cyan-600 to-cyan-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute top-3 left-3 px-2.5 py-1 bg-cyan-500 rounded-lg text-white text-xs font-bold">
                            FEB 08
                        </div>
                        <div
                            class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
                            325 left
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 space-y-4">
                        <div>
                            <div class="text-xs text-cyan-400 font-semibold mb-2">CLASSICAL • ORCHESTRA</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                                Symphony Under The Stars
                            </h3>
                            <p class="text-sm text-gray-400 line-clamp-2">
                                Experience timeless classical masterpieces performed by world-class musicians.
                            </p>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                </svg>
                                <span>Concert Hall</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$95</div>
                            </div>
                            <button
                                class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 6 -->
                <div
                    class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-yellow-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-yellow-500/10">
                    <!-- Image -->
                    <div
                        class="relative aspect-[16/10] bg-gradient-to-br from-yellow-600 to-yellow-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute top-3 left-3 px-2.5 py-1 bg-yellow-500 rounded-lg text-white text-xs font-bold">
                            FEB 14
                        </div>
                        <div
                            class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
                            1.2K left
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 space-y-4">
                        <div>
                            <div class="text-xs text-yellow-400 font-semibold mb-2">LATIN • SALSA</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors">
                                Fiesta Latina Night
                            </h3>
                            <p class="text-sm text-gray-400 line-clamp-2">
                                Feel the rhythm of Latin America with live bands and dance performances.
                            </p>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                </svg>
                                <span>Tropical Club</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$42</div>
                            </div>
                            <button
                                class="px-5 py-2.5 bg-yellow-600 hover:bg-yellow-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
</div>
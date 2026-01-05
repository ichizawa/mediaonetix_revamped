<div>
    <section
        class="relative py-16 sm:py-20 md:py-24 lg:py-32 bg-gradient-to-b from-[#0c1222] to-[#111827] overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-500 rounded-full filter blur-[150px] opacity-10"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full filter blur-[150px] opacity-10"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-12 sm:mb-16 section-header">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-purple-500/10 border border-purple-500/20 rounded-full backdrop-blur-sm mb-4 sm:mb-6">
                    <svg class="w-4 h-4 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span class="text-purple-300 text-xs sm:text-sm font-medium">FEATURED EVENT</span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-4 sm:mb-6 text-white px-4">
                    Don't Miss <span class="gradient-text">This Week</span>
                </h2>
            </div>

            <!-- Featured Event Card -->
            <div class="max-w-6xl mx-auto">
                <div
                    class="group relative bg-gradient-to-br from-purple-600/10 to-blue-600/10 backdrop-blur-xl border border-purple-500/20 rounded-3xl overflow-hidden hover:border-purple-500/40 transition-all duration-500">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-500/0 to-blue-500/0 group-hover:from-purple-500/5 group-hover:to-blue-500/5 transition-all duration-500">
                    </div>

                    <div class="relative grid md:grid-cols-2 gap-6 md:gap-8 p-6 sm:p-8 md:p-10">
                        <!-- Image Side -->
                        <div
                            class="relative aspect-[4/3] md:aspect-auto rounded-2xl overflow-hidden bg-gradient-to-br from-purple-600 to-blue-600">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 opacity-50" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                        </path>
                                    </svg>
                                    <p class="text-sm opacity-75">Event Image</p>
                                </div>
                            </div>
                            <!-- Hot Badge -->
                            <div
                                class="absolute top-4 right-4 px-3 py-1.5 bg-red-500 rounded-full text-white text-xs font-bold flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                HOT
                            </div>
                        </div>

                        <!-- Content Side -->
                        <div class="flex flex-col justify-between">
                            <div class="space-y-4 sm:space-y-6">
                                <div>
                                    <div
                                        class="inline-flex items-center gap-2 px-3 py-1 bg-purple-500/20 border border-purple-500/30 rounded-full mb-3">
                                        <span class="text-purple-300 text-xs font-semibold">{{ $event->category }}</span>
                                    </div>
                                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-white mb-2">
                                        {{ $event->event_name }}
                                    </h3>
                                    <p class="text-gray-400 text-sm sm:text-base">
                                        {{ $event->description }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Date</div>
                                            <div class="text-white font-semibold">{{ date('M d, Y', strtotime($event->event_date)) }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Venue</div>
                                            <div class="text-white font-semibold">{{ $event->event_venue }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Duration</div>
                                            <div class="text-white font-semibold">3 Days</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Capacity</div>
                                            <div class="text-white font-semibold">50,000+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-6 border-t border-white/10">
                                <div class="flex-1">
                                    <div class="text-xs text-gray-500 mb-1">Starting from</div>
                                    <div class="text-3xl sm:text-4xl font-black text-purple-400">₱{{ number_format($event->tickets_min_price, 2) }}</div>
                                </div>
                                <button
                                    class="group w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl font-bold text-base sm:text-lg hover:shadow-lg hover:shadow-purple-500/50 transition-all duration-300 hover:scale-105 inline-flex items-center justify-center gap-2 text-white">
                                    Get Tickets Now
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
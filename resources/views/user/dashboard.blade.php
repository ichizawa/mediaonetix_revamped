@extends('layouts')

@section('content')
    <main class="lg:ml-64 pt-20 min-h-screen bg-[#0c1222] overflow-x-hidden">
        
        <section class="relative min-h-[calc(100vh-5rem)] flex items-center overflow-hidden pb-12">
            <div class="absolute inset-0 mesh-gradient"></div>
            <div
                class="absolute top-10 left-5 w-40 h-40 md:w-72 md:h-72 bg-blue-500 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow">
            </div>
            <div class="absolute bottom-10 right-5 w-48 h-48 md:w-96 md:h-96 bg-blue-400 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow"
                style="animation-delay: 2s;"></div>

            <div class="relative container mx-auto px-4 sm:px-6 lg:px-12 py-8 w-full">
                <div class="grid lg:grid-cols-2 gap-8 md:gap-12 lg:gap-16 items-center justify-items-center">

                    <div
                        class="hero-content space-y-4 sm:space-y-6 md:space-y-8 order-2 lg:order-1 w-full max-w-xl lg:max-w-none hidden lg:flex flex-col items-start">

                        <div
                            class="event-badge inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm">
                            <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                            <span class="text-blue-300 text-sm font-medium" id="event-category">Featured Event</span>
                        </div>

                        <div class="event-title">
                            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black leading-tight text-white mb-6">
                                <span class="title-line-1 block"></span>
                                <span class="title-line-2 gradient-text block"></span>
                            </h1>
                        </div>

                        <div class="event-details space-y-3 sm:space-y-4 mb-6 sm:mb-8 w-full">
                            <div class="flex items-center gap-3 sm:gap-4 text-gray-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-lg font-semibold" id="event-date"></span>
                            </div>

                            <div class="flex items-center gap-3 sm:gap-4 text-gray-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-lg font-semibold" id="event-venue"></span>
                            </div>

                            <div class="flex items-center gap-3 sm:gap-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span class="text-4xl font-bold text-blue-400" id="event-price"></span>
                            </div>
                        </div>

                        <button
                            class="cta-button purchase-btn group w-full lg:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-bold text-base sm:text-lg shadow-lg hover:shadow-blue-500/50 transition-all hover:scale-105 inline-flex items-center justify-center gap-2 sm:gap-3 text-white"
                            data-event-id="{{ $event->id ?? '' }}" id="main-purchase-btn">
                            Get Tickets Now
                            <input type="hidden" class="event-id-holder" value="{{ $event->id ?? '' }}">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>

                        <div class="slider-controls flex items-center gap-4 sm:gap-6 mt-6 sm:mt-8">
                            <button
                                class="slider-prev w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center hover:bg-blue-500/20 hover:border-blue-500/50 transition-all backdrop-blur-sm"
                                aria-label="Previous event">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                    </path>
                                </svg>
                            </button>

                            <div class="slider-dots flex gap-2 sm:gap-3">
                                <span
                                    class="dot w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-blue-400 transition-all cursor-pointer"
                                    data-index="0"></span>
                                <span
                                    class="dot w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white/30 transition-all cursor-pointer"
                                    data-index="1"></span>
                                <span
                                    class="dot w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white/30 transition-all cursor-pointer"
                                    data-index="2"></span>
                            </div>

                            <button
                                class="slider-next w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center hover:bg-blue-500/20 hover:border-blue-500/50 transition-all backdrop-blur-sm"
                                aria-label="Next event">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div
                        class="hero-visual relative order-1 lg:order-2 w-full max-w-md lg:max-w-none h-auto flex flex-col items-center gap-6">
                        <div class="poster-container relative w-full h-[60vh] sm:h-[65vh] lg:h-[70vh]">
                            <div class="relative h-full w-full group">
                                <div
                                    class="poster-main relative h-full overflow-hidden rounded-3xl border-4 border-blue-500/30 shadow-2xl shadow-blue-500/20 transition-all duration-500 group-hover:border-blue-500/50 group-hover:shadow-blue-500/30">
                                    <div id="poster-bg"
                                        class="h-full flex flex-col items-center justify-between relative overflow-hidden p-6 lg:p-10"
                                        style="background: linear-gradient(135deg, #1e40af, #3b82f6, #06b6d4); background-size: cover; background-position: center;">

                                        <div class="absolute inset-0 opacity-10">
                                            <div class="absolute top-0 left-0 w-full h-full"
                                                style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);">
                                            </div>
                                        </div>

                                        <div class="relative z-10 w-full text-center flex-shrink-0">
                                            <div
                                                class="inline-flex items-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-xl rounded-full border-2 border-white/30">
                                                <span class="text-white font-bold text-sm lg:text-base"
                                                    id="poster-category"></span>
                                            </div>
                                        </div>

                                        <div class="relative z-10 text-center flex-1 flex flex-col justify-center">
                                            <h2
                                                class="text-4xl lg:text-5xl xl:text-6xl font-black text-white mb-3 drop-shadow-lg poster-title-1">
                                            </h2>
                                            <h2
                                                class="text-5xl lg:text-6xl xl:text-7xl font-black text-white drop-shadow-lg poster-title-2">
                                            </h2>
                                        </div>

                                        <div class="relative z-10 w-full space-y-3 sm:space-y-4 flex-shrink-0">
                                            <div
                                                class="bg-white/10 backdrop-blur-xl rounded-xl sm:rounded-2xl p-4 sm:p-6 border-2 border-white/20 poster-details">
                                                <div
                                                    class="flex items-center justify-between mb-3 sm:mb-4 pb-3 sm:pb-4 border-b border-white/20">
                                                    <div class="flex items-center gap-2 sm:gap-3">
                                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-white flex-shrink-0"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        <span class="text-white font-bold text-base sm:text-lg" id="poster-date"></span>
                                                    </div>
                                                </div>

                                                <div
                                                    class="flex items-center justify-between mb-3 sm:mb-4 pb-3 sm:pb-4 border-b border-white/20">
                                                    <div class="flex items-center gap-2 sm:gap-3">
                                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-white flex-shrink-0"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                        <span class="text-white font-bold text-base sm:text-lg" id="poster-venue"></span>
                                                    </div>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <span class="text-white/80 font-medium text-base sm:text-lg">Starting from</span>
                                                    <span class="text-4xl sm:text-5xl font-black text-white poster-price"
                                                        id="poster-price"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="absolute -top-4 -right-4 sm:-top-6 sm:-right-6 w-24 h-24 sm:w-32 sm:h-32 bg-blue-500 rounded-full filter blur-[60px] sm:blur-[80px] opacity-40 poster-glow-1">
                                </div>
                                <div
                                    class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-6 w-28 h-28 sm:w-40 sm:h-40 bg-cyan-400 rounded-full filter blur-[60px] sm:blur-[80px] opacity-40 poster-glow-2">
                                </div>
                            </div>
                        </div>

                        <div class="w-full lg:hidden px-4">
                            <button
                                class="cta-button purchase-btn group w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-bold text-lg shadow-lg hover:shadow-blue-500/50 transition-all hover:scale-105 inline-flex items-center justify-center gap-3 text-white"
                                data-event-id="" id="mobile-purchase-btn">
                                Get Tickets Now
                                <input type="hidden" id="mobile-event-id-holder" value="{{ $event->id ?? '' }}">
                                <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="slider-controls flex items-center gap-6 lg:hidden">
                            <button
                                class="slider-prev w-12 h-12 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center hover:bg-blue-500/20 hover:border-blue-500/50 transition-all backdrop-blur-sm"
                                aria-label="Previous event">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7">
                                    </path>
                                </svg>
                            </button>

                            <div class="slider-dots flex gap-3">
                                <span class="dot w-3 h-3 rounded-full bg-blue-400 transition-all cursor-pointer"
                                    data-index="0"></span>
                                <span class="dot w-3 h-3 rounded-full bg-white/30 transition-all cursor-pointer"
                                    data-index="1"></span>
                                <span class="dot w-3 h-3 rounded-full bg-white/30 transition-all cursor-pointer"
                                    data-index="2"></span>
                            </div>

                            <button
                                class="slider-next w-12 h-12 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center hover:bg-blue-500/20 hover:border-blue-500/50 transition-all backdrop-blur-sm"
                                aria-label="Next event">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="relative z-10 pb-16">
            <livewire:public-event-this-week-component />
            <livewire:public-events-component />
        </div>

    </main>

    <script src="{{ asset('js/event-slider.js') }}"></script>
    <script src="{{ asset('js/landing-animations.js') }}"></script>
    <script src="{{ asset('js/tickets.js') }}"></script>
@endsection
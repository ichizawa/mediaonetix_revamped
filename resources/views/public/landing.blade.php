@extends('layouts')
@section('content')
    <section class="relative min-h-screen flex items-center overflow-hidden bg-[#0c1222] pt-20">
        <div class="absolute inset-0 mesh-gradient"></div>
        <div
            class="absolute top-10 left-5 w-40 h-40 md:w-72 md:h-72 bg-blue-500 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow">
        </div>
        <div class="absolute bottom-10 right-5 w-48 h-48 md:w-96 md:h-96 bg-blue-400 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow"
            style="animation-delay: 2s;"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-12 py-8 sm:py-12 md:py-16 lg:py-20 w-full">
            <div class="grid lg:grid-cols-2 gap-8 md:gap-12 lg:gap-16 items-center justify-items-center">

                <div
                    class="hero-content space-y-4 sm:space-y-6 md:space-y-8 order-2 lg:order-1 w-full max-w-xl lg:max-w-none hidden lg:flex flex-col items-start">

                    <div
                        class="event-badge inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm">
                        <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                        <span class="text-blue-300 text-sm font-medium" id="event-category"></span>
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
                    <div class="poster-container relative w-full h-[70vh] sm:h-[75vh] lg:h-[80vh]">
                        <div class="relative h-full w-full group">
                            <div
                                class="poster-main relative h-full overflow-hidden rounded-3xl border-4 border-blue-500/30 shadow-2xl shadow-blue-500/20 transition-all duration-500 group-hover:border-blue-500/50 group-hover:shadow-blue-500/30">
                                <div id="poster-bg"
                                    class="h-full flex flex-col items-center justify-between relative overflow-hidden p-8 lg:p-12"
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
                                            class="text-5xl lg:text-6xl xl:text-7xl font-black text-white mb-3 drop-shadow-lg poster-title-1">
                                        </h2>
                                        <h2
                                            class="text-6xl lg:text-7xl xl:text-8xl font-black text-white drop-shadow-lg poster-title-2">
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
                                                    <span class="text-white font-bold text-lg" id="poster-date"></span>
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
                                                    <span class="text-white font-bold text-lg" id="poster-venue"></span>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <span class="text-white/80 font-medium text-lg">Starting from</span>
                                                <span class="text-5xl font-black text-white poster-price"
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

    <livewire:public-event-this-week-component />

    <livewire:public-events-component />

    <section class="relative py-16 sm:py-20 md:py-24 lg:py-32 bg-gradient-to-b from-[#0c1222] to-[#111827]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-12 sm:mb-16 md:mb-20 section-header">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-4 sm:mb-6">
                    <span class="text-blue-300 text-xs sm:text-sm font-medium">FEATURES</span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-4 sm:mb-6 text-white px-4">
                    Built for <span class="gradient-text">Live Events</span>
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-gray-400 max-w-2xl mx-auto px-4">
                    Everything you need to create, manage, and scale your ticketing operation
                </p>
            </div>

            <div class="feature-grid grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <div
                    class="feature-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 sm:p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-blue-500/0 rounded-2xl transition-all duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-white">Instant Setup</h3>
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Create your event page and start
                            selling tickets in under 5 minutes. No coding required.</p>
                    </div>
                </div>

                <div
                    class="feature-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 sm:p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-blue-500/0 rounded-2xl transition-all duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-white">Secure Payments</h3>
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Bank-level encryption and fraud
                            protection keep every transaction safe and compliant.</p>
                    </div>
                </div>

                <div
                    class="feature-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 sm:p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-blue-500/0 rounded-2xl transition-all duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-white">Mobile First</h3>
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Perfect experience on any device.
                            Your
                            fans can buy tickets anywhere, anytime.</p>
                    </div>
                </div>

                <div
                    class="feature-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 sm:p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-blue-500/0 rounded-2xl transition-all duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-white">Real-Time Analytics</h3>
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Track sales, revenue, and attendee
                            data with live dashboards and insights.</p>
                    </div>
                </div>

                <div
                    class="feature-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 sm:p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-blue-500/0 rounded-2xl transition-all duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-white">Event Management</h3>
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Manage multiple events, check-ins,
                            and
                            attendee lists from one powerful dashboard.</p>
                    </div>
                </div>

                <div
                    class="feature-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 sm:p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-blue-500/0 rounded-2xl transition-all duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-white">No Hidden Fees</h3>
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Transparent pricing with no
                            surprises.
                            You keep more of what you earn.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-16 sm:py-20 md:py-24 lg:py-32 overflow-hidden bg-[#0c1222]">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-950/50 via-blue-900/30 to-[#0c1222]"></div>
        <div class="absolute inset-0">
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] sm:w-[600px] sm:h-[600px] bg-blue-500 rounded-full filter blur-[100px] sm:blur-[150px] opacity-20">
            </div>
        </div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-12 text-center cta-section">
            <div
                class="cta-badge inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-6 sm:mb-8">
                <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                <span class="text-blue-300 text-xs sm:text-sm font-medium">Start Selling in Minutes</span>
            </div>

            <h2
                class="cta-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black mb-4 sm:mb-6 max-w-4xl mx-auto leading-tight text-white px-4">
                Ready to Sell <span class="gradient-text">More Tickets?</span>
            </h2>

            <p class="cta-subtitle text-base sm:text-lg md:text-xl text-gray-400 mb-8 sm:mb-12 max-w-2xl mx-auto px-4">
                Join thousands of event creators who trust MediaoneTix to power their success
            </p>

            <div class="cta-button mb-6 sm:mb-8 px-4">
                <button
                    class="group w-full sm:w-auto px-8 sm:px-10 md:px-12 py-4 sm:py-5 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-bold text-lg sm:text-xl shadow-xl shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-300 hover:scale-105 inline-flex items-center justify-center gap-2 sm:gap-3 text-white">
                    <a href="/register" class="text-white hover:text-blue-300">
                        Get Started Free
                    </a>
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6">
                        </path>
                    </svg>
                </button>
            </div>

            <div
                class="cta-note flex flex-col sm:flex-row flex-wrap items-center justify-center gap-4 sm:gap-6 text-gray-400 text-sm sm:text-base px-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>No credit card required</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>30-day free trial</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Cancel anytime</span>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/event-slider.js') }}"></script>
    <script src="{{ asset('js/landing-animations.js') }}"></script>
    <script src="{{ asset('js/tickets.js') }}"></script>

    @if ($errors->any())
        <script type="module">
            swal.fire({
                icon: 'error',
                title: "{{ implode(' ', $errors->all()) }}"
            });
        </script>
    @endif

    @if (session('error'))
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&display=swap');

            .swal2-error-popup {
                background: linear-gradient(145deg, rgba(15, 13, 28, 0.98), rgba(22, 10, 18, 0.97)) !important;
                border-radius: 28px !important;
                border: 1px solid rgba(220, 40, 60, 0.18) !important;
                box-shadow:
                    0 0 0 1px rgba(220, 40, 60, 0.06),
                    0 32px 64px rgba(0, 0, 0, 0.6),
                    0 0 80px rgba(220, 40, 60, 0.08) !important;
                overflow: hidden !important;
                padding: 0 !important;
            }

            .swal2-error-popup::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(ellipse at 50% 0%, rgba(220, 40, 60, 0.07) 0%, transparent 65%);
                pointer-events: none;
            }

            .swal2-error-popup .swal2-html-container {
                margin: 0 !important;
                padding: 0 !important;
                overflow: visible !important;
            }

            .swal2-error-popup .swal2-actions {
                padding: 0 28px 28px !important;
                margin: 0 !important;
            }

            .swal2-error-confirm-btn {
                width: 100% !important;
                padding: 14px !important;
                background: rgba(220, 40, 60, 0.08) !important;
                border: 1px solid rgba(220, 40, 60, 0.22) !important;
                color: #f8f0f2 !important;
                font-family: 'Sora', sans-serif !important;
                font-size: 0.95rem !important;
                font-weight: 600 !important;
                border-radius: 14px !important;
                letter-spacing: 0.04em !important;
                transition: all 0.25s ease !important;
                box-shadow: none !important;
            }

            .swal2-error-confirm-btn:hover {
                background: rgba(220, 40, 60, 0.18) !important;
                border-color: rgba(220, 40, 60, 0.45) !important;
                box-shadow: 0 4px 20px rgba(220, 40, 60, 0.15) !important;
                transform: none !important;
            }

            @keyframes swal-pulse {
                0% {
                    opacity: 1;
                    transform: scale(0.85);
                }

                100% {
                    opacity: 0;
                    transform: scale(1.1);
                }
            }

            .swal-pulse-ring {
                position: absolute;
                border-radius: 50%;
                border: 1.5px solid rgba(220, 40, 60, 0.3);
                animation: swal-pulse 2.2s ease-out infinite;
                pointer-events: none;
            }
        </style>

        <script type="module">
            Swal.fire({
                html: `
            <div style="height:3px;background:linear-gradient(90deg,transparent,rgba(255,60,80,0.6) 40%,rgba(255,80,120,0.8) 50%,rgba(255,60,80,0.6) 60%,transparent);margin-bottom:0;"></div>
            <div style="padding:36px 28px 8px;font-family:'Sora',sans-serif;">

                <div style="display:flex;justify-content:center;margin-bottom:24px;position:relative;height:80px;align-items:center;">
                    <div class="swal-pulse-ring" style="width:80px;height:80px;animation-delay:0s;"></div>
                    <div class="swal-pulse-ring" style="width:100px;height:100px;border-color:rgba(220,40,60,0.15);animation-delay:0.4s;"></div>
                    <div class="swal-pulse-ring" style="width:120px;height:120px;border-color:rgba(220,40,60,0.07);animation-delay:0.8s;"></div>
                    <div style="width:72px;height:72px;border-radius:50%;background:rgba(220,40,60,0.1);border:1.5px solid rgba(220,40,60,0.35);display:flex;align-items:center;justify-content:center;position:relative;z-index:1;box-shadow:0 0 28px rgba(220,40,60,0.2);">
                        <svg width='32' height='32' fill='none' viewBox='0 0 24 24'>
                            <path d='M12 8v5' stroke='#f43f5e' stroke-width='2.4' stroke-linecap='round'/>
                            <circle cx='12' cy='16.5' r='1' fill='#f43f5e'/>
                            <path d='M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z' stroke='#f43f5e' stroke-width='1.8' stroke-linejoin='round'/>
                        </svg>
                    </div>
                </div>

                <div style="text-align:center;font-size:0.93rem;color:rgba(220,200,210,0.72);line-height:1.65;padding:0 4px;">{{ session('error') }}</div>

                <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(255,60,80,0.12),transparent);margin:24px 0 0;"></div>
            </div>
        `,
                background: 'transparent',
                showConfirmButton: true,
                confirmButtonText: 'Got it',
                customClass: {
                    popup: 'swal2-error-popup',
                    confirmButton: 'swal2-error-confirm-btn',
                },
                focusConfirm: true,
                allowOutsideClick: true,
                allowEscapeKey: true,
            });
        </script>
    @endif
@endsection

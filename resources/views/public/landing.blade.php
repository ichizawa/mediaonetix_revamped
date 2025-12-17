@extends('layouts')
@section('content')
    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden bg-[#0c1222]">
        <!-- Animated Background -->
        <div class="absolute inset-0 mesh-gradient"></div>

        <!-- Floating Orbs - Smaller on mobile -->
        <div
            class="absolute top-10 left-5 w-40 h-40 md:w-72 md:h-72 bg-blue-500 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow">
        </div>
        <div class="absolute bottom-10 right-5 w-48 h-48 md:w-96 md:h-96 bg-blue-400 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow"
            style="animation-delay: 2s;"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-16 md:py-20">
            <div class="grid lg:grid-cols-2 gap-8 md:gap-12 lg:gap-16 items-center">
                <!-- Left Content -->
                <div
                    class="hero-content space-y-4 sm:space-y-6 md:space-y-8 text-center md:text-left px-4 sm:px-6 max-w-4xl md:max-w-none md:mx-0 mx-auto">
                    <div
                        class="hero-badge inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm">
                        <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                        <span class="text-blue-300 text-xs sm:text-sm font-medium">Trusted by 10K+ Event Creators</span>
                    </div>

                    <h1
                        class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-black leading-tight sm:leading-none text-white">
                        Tickets Made
                        <span class="gradient-text block">Simple</span>
                    </h1>

                    <p
                        class="hero-subtitle text-base sm:text-lg md:text-xl text-gray-400 leading-relaxed max-w-xl mx-auto md:mx-0">
                        The modern way to sell tickets for concerts, festivals, and live events. Get started in minutes,
                        sell in seconds.
                    </p>

                    

                    <div
                        class="hero-stats flex flex-wrap items-center justify-center md:justify-start gap-4 sm:gap-6 md:gap-8 pt-4 sm:pt-6 md:pt-8">
                        <div class="flex-shrink-0">
                            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white">1M+</div>
                            <div class="text-xs sm:text-sm text-gray-500 whitespace-nowrap">Tickets Sold</div>
                        </div>
                        <div class="w-px h-10 sm:h-12 bg-gray-800 flex-shrink-0"></div>
                        <div class="flex-shrink-0">
                            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white">99.9%</div>
                            <div class="text-xs sm:text-sm text-gray-500 whitespace-nowrap">Uptime</div>
                        </div>
                        <div class="w-px h-10 sm:h-12 bg-gray-800 flex-shrink-0"></div>
                        <div class="flex-shrink-0">
                            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white">24/7</div>
                            <div class="text-xs sm:text-sm text-gray-500 whitespace-nowrap">Support</div>
                        </div>
                    </div>
                </div>


                <!-- Right Visual - Show on mobile too but smaller -->
                <div class="hero-visual relative mt-8 lg:mt-0">
                    <div class="event-slider-container relative max-w-md mx-auto lg:max-w-none">
                        <!-- Event Card -->
                        <div class="event-slide active floating">
                            <div
                                class="ticket-shape relative bg-gradient-to-br from-blue-600/20 to-blue-400/10 backdrop-blur-xl border border-blue-500/30 p-6 sm:p-8 glow-effect">
                                <div class="space-y-4 sm:space-y-6">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-xs sm:text-sm text-gray-400 mb-1">SUMMER FEST 2024</div>
                                            <div class="text-lg sm:text-xl md:text-2xl font-bold text-white truncate">
                                                Electronic Paradise</div>
                                        </div>
                                        <div
                                            class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="border-t border-dashed border-gray-700 pt-4 sm:pt-6 space-y-3 sm:space-y-4">
                                        <div class="flex justify-between text-xs sm:text-sm">
                                            <span class="text-gray-400">Date</span>
                                            <span class="font-semibold text-white">Aug 15, 2024</span>
                                        </div>
                                        <div class="flex justify-between text-xs sm:text-sm">
                                            <span class="text-gray-400">Location</span>
                                            <span class="font-semibold text-white">City Arena</span>
                                        </div>
                                        <div class="flex justify-between items-center text-xs sm:text-sm">
                                            <span class="text-gray-400">Price</span>
                                            <span class="text-xl sm:text-2xl font-bold text-blue-400">$89</span>
                                        </div>
                                    </div>

                                    <button
                                        class="w-full py-2.5 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-semibold text-sm sm:text-base hover:shadow-lg hover:shadow-blue-500/50 transition-all text-white">
                                        Get Tickets
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements - Smaller on mobile -->
                    <div
                        class="absolute -top-5 -right-5 md:-top-10 md:-right-10 w-20 h-20 md:w-32 md:h-32 bg-blue-500 rounded-full filter blur-[60px] md:blur-[80px] opacity-40">
                    </div>
                    <div
                        class="absolute -bottom-5 -left-5 md:-bottom-10 md:-left-10 w-24 h-24 md:w-40 md:h-40 bg-blue-400 rounded-full filter blur-[60px] md:blur-[80px] opacity-40">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
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
                <!-- Feature 1 -->
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

                <!-- Feature 2 -->
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

                <!-- Feature 3 -->
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
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-white">Mobile First</h3>
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Perfect experience on any device. Your
                            fans can buy tickets anywhere, anytime.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
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

                <!-- Feature 5 -->
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
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Manage multiple events, check-ins, and
                            attendee lists from one powerful dashboard.</p>
                    </div>
                </div>

                <!-- Feature 6 -->
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
                        <p class="text-sm sm:text-base text-gray-400 leading-relaxed">Transparent pricing with no surprises.
                            You keep more of what you earn.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
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
                    Get Started Free
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
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

    <!-- Load GSAP Animations -->
    <script src="{{ asset('js/event-slider.js') }}"></script>
    <script src="{{ asset('js/landing-animations.js') }}"></script>
@endsection

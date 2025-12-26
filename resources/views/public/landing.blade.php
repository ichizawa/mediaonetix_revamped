@extends('layouts')
@section('content')
    <!-- GSAP Library -->


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
                        MediaOne
                        <span class="gradient-text block">TIX</span>
                    </h1>

                    <p
                        class="hero-subtitle text-base sm:text-lg md:text-xl text-gray-400 leading-relaxed max-w-xl mx-auto md:mx-0">
                        <strong>Convenience and security</strong> are at the heart of MediaoneTix. Whether you’re a casual
                    event-goer or a regular attendee, our platform helps you find and secure tickets quickly without the
                    hassle of long queues or physical tickets.
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

                        <!-- Slide 1: Electronic Paradise (Blue) -->
                        <div class="event-slide active floating" data-theme-color="#3B82F6">
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

                        <!-- Slide 2: Rock The Night (Red) -->
                        <div class="event-slide floating" data-theme-color="#EF4444">
                            <div
                                class="ticket-shape relative bg-gradient-to-br from-red-600/20 to-red-400/10 backdrop-blur-xl border border-red-500/30 p-6 sm:p-8 glow-effect">
                                <div class="space-y-4 sm:space-y-6">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-xs sm:text-sm text-gray-400 mb-1">ROCK FESTIVAL</div>
                                            <div class="text-lg sm:text-xl md:text-2xl font-bold text-white truncate">
                                                Rock The Night</div>
                                        </div>
                                        <div
                                            class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl sm:rounded-2xl flex items-center justify-center flex-shrink-0">
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
                                            <span class="font-semibold text-white">Sep 20, 2024</span>
                                        </div>
                                        <div class="flex justify-between text-xs sm:text-sm">
                                            <span class="text-gray-400">Location</span>
                                            <span class="font-semibold text-white">Stadium Arena</span>
                                        </div>
                                        <div class="flex justify-between items-center text-xs sm:text-sm">
                                            <span class="text-gray-400">Price</span>
                                            <span class="text-xl sm:text-2xl font-bold text-red-400">$125</span>
                                        </div>
                                    </div>

                                    <button
                                        class="w-full py-2.5 sm:py-3 bg-gradient-to-r from-red-600 to-red-500 rounded-xl font-semibold text-sm sm:text-base hover:shadow-lg hover:shadow-red-500/50 transition-all text-white">
                                        Get Tickets
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3: Jazz Night (Purple) -->
                        <div class="event-slide floating" data-theme-color="#8B5CF6">
                            <div
                                class="ticket-shape relative bg-gradient-to-br from-purple-600/20 to-purple-400/10 backdrop-blur-xl border border-purple-500/30 p-6 sm:p-8 glow-effect">
                                <div class="space-y-4 sm:space-y-6">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-xs sm:text-sm text-gray-400 mb-1">JAZZ EVENING</div>
                                            <div class="text-lg sm:text-xl md:text-2xl font-bold text-white truncate">
                                                Smooth Jazz Night</div>
                                        </div>
                                        <div
                                            class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center flex-shrink-0">
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
                                            <span class="font-semibold text-white">Oct 5, 2024</span>
                                        </div>
                                        <div class="flex justify-between text-xs sm:text-sm">
                                            <span class="text-gray-400">Location</span>
                                            <span class="font-semibold text-white">Jazz Lounge</span>
                                        </div>
                                        <div class="flex justify-between items-center text-xs sm:text-sm">
                                            <span class="text-gray-400">Price</span>
                                            <span class="text-xl sm:text-2xl font-bold text-purple-400">$65</span>
                                        </div>
                                    </div>

                                    <button
                                        class="w-full py-2.5 sm:py-3 bg-gradient-to-r from-purple-600 to-purple-500 rounded-xl font-semibold text-sm sm:text-base hover:shadow-lg hover:shadow-purple-500/50 transition-all text-white">
                                        Get Tickets
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Slider Controls -->
                        <div class="slider-controls absolute bottom-[-60px] left-1/2 transform -translate-x-1/2 flex items-center gap-4 z-10">
                            <button class="slider-btn slider-prev w-12 h-12 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center cursor-pointer hover:bg-blue-500/20 hover:border-blue-500/50 transition-all backdrop-blur-sm" aria-label="Previous slide">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <div class="slider-dots flex gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-400 transition-all"></span>
                                <span class="w-2 h-2 rounded-full bg-white/30 transition-all"></span>
                                <span class="w-2 h-2 rounded-full bg-white/30 transition-all"></span>
                            </div>
                            <button class="slider-btn slider-next w-12 h-12 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center cursor-pointer hover:bg-blue-500/20 hover:border-blue-500/50 transition-all backdrop-blur-sm" aria-label="Next slide">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
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

    <!-- Featured Event Section -->
    <section class="relative py-16 sm:py-20 md:py-24 lg:py-32 bg-gradient-to-b from-[#0c1222] to-[#111827] overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-500 rounded-full filter blur-[150px] opacity-10"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full filter blur-[150px] opacity-10"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-12 sm:mb-16 section-header">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-purple-500/10 border border-purple-500/20 rounded-full backdrop-blur-sm mb-4 sm:mb-6">
                    <svg class="w-4 h-4 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="text-purple-300 text-xs sm:text-sm font-medium">FEATURED EVENT</span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-4 sm:mb-6 text-white px-4">
                    Don't Miss <span class="gradient-text">This Week</span>
                </h2>
            </div>

            <!-- Featured Event Card -->
            <div class="max-w-6xl mx-auto">
                <div class="group relative bg-gradient-to-br from-purple-600/10 to-blue-600/10 backdrop-blur-xl border border-purple-500/20 rounded-3xl overflow-hidden hover:border-purple-500/40 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/0 to-blue-500/0 group-hover:from-purple-500/5 group-hover:to-blue-500/5 transition-all duration-500"></div>

                    <div class="relative grid md:grid-cols-2 gap-6 md:gap-8 p-6 sm:p-8 md:p-10">
                        <!-- Image Side -->
                        <div class="relative aspect-[4/3] md:aspect-auto rounded-2xl overflow-hidden bg-gradient-to-br from-purple-600 to-blue-600">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                    </svg>
                                    <p class="text-sm opacity-75">Event Image</p>
                                </div>
                            </div>
                            <!-- Hot Badge -->
                            <div class="absolute top-4 right-4 px-3 py-1.5 bg-red-500 rounded-full text-white text-xs font-bold flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                </svg>
                                HOT
                            </div>
                        </div>

                        <!-- Content Side -->
                        <div class="flex flex-col justify-between">
                            <div class="space-y-4 sm:space-y-6">
                                <div>
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-purple-500/20 border border-purple-500/30 rounded-full mb-3">
                                        <span class="text-purple-300 text-xs font-semibold">MEGA CONCERT</span>
                                    </div>
                                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-white mb-2">
                                        Summer Music Festival 2024
                                    </h3>
                                    <p class="text-gray-400 text-sm sm:text-base">
                                        Experience the biggest music festival of the year featuring top international artists, multiple stages, and unforgettable performances.
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Date</div>
                                            <div class="text-white font-semibold">Dec 28-30, 2024</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Venue</div>
                                            <div class="text-white font-semibold">Grand Stadium</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Duration</div>
                                            <div class="text-white font-semibold">3 Days</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 mb-0.5">Capacity</div>
                                            <div class="text-white font-semibold">50,000+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-6 border-t border-white/10">
                                <div class="flex-1">
                                    <div class="text-xs text-gray-500 mb-1">Starting from</div>
                                    <div class="text-3xl sm:text-4xl font-black text-purple-400">$149</div>
                                </div>
                                <button class="group w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl font-bold text-base sm:text-lg hover:shadow-lg hover:shadow-purple-500/50 transition-all duration-300 hover:scale-105 inline-flex items-center justify-center gap-2 text-white">
                                    Get Tickets Now
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Events Section -->
    <section class="relative py-16 sm:py-20 md:py-24 lg:py-32 bg-[#111827]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-12 sm:mb-16">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-4">
                        <span class="text-blue-300 text-xs sm:text-sm font-medium">UPCOMING</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white">
                        Recent <span class="gradient-text">Events</span>
                    </h2>
                </div>
                <button class="group px-6 py-3 border border-blue-500/30 rounded-xl font-semibold hover:bg-blue-500/10 transition-all inline-flex items-center gap-2 text-blue-400">
                    View All Events
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Events Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Event Card 1 -->
                <div class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-blue-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-blue-600 to-blue-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                        <div class="absolute top-3 left-3 px-2.5 py-1 bg-blue-500 rounded-lg text-white text-xs font-bold">
                            JAN 15
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>Warehouse 51</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$45</div>
                            </div>
                            <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-green-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-green-600 to-green-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                        <div class="absolute top-3 left-3 px-2.5 py-1 bg-green-500 rounded-lg text-white text-xs font-bold">
                            JAN 20
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>The Music Hall</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$35</div>
                            </div>
                            <button class="px-5 py-2.5 bg-green-600 hover:bg-green-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-orange-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-orange-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-orange-600 to-orange-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                        <div class="absolute top-3 left-3 px-2.5 py-1 bg-orange-500 rounded-lg text-white text-xs font-bold">
                            JAN 25
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-1 bg-red-500 rounded-lg text-white text-xs font-bold flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>Metro Arena</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$55</div>
                            </div>
                            <button class="px-5 py-2.5 bg-orange-600 hover:bg-orange-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 4 -->
                <div class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-pink-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-pink-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-pink-600 to-pink-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                        <div class="absolute top-3 left-3 px-2.5 py-1 bg-pink-500 rounded-lg text-white text-xs font-bold">
                            FEB 01
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>City Center</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$68</div>
                            </div>
                            <button class="px-5 py-2.5 bg-pink-600 hover:bg-pink-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 5 -->
                <div class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-cyan-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-cyan-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-cyan-600 to-cyan-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                        <div class="absolute top-3 left-3 px-2.5 py-1 bg-cyan-500 rounded-lg text-white text-xs font-bold">
                            FEB 08
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>Concert Hall</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$95</div>
                            </div>
                            <button class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Card 6 -->
                <div class="group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-yellow-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-yellow-500/10">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] bg-gradient-to-br from-yellow-600 to-yellow-400 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                        <div class="absolute top-3 left-3 px-2.5 py-1 bg-yellow-500 rounded-lg text-white text-xs font-bold">
                            FEB 14
                        </div>
                        <div class="absolute top-3 right-3 px-2.5 py-1 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>Tropical Club</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div>
                                <div class="text-xs text-gray-500">From</div>
                                <div class="text-2xl font-bold text-white">$42</div>
                            </div>
                            <button class="px-5 py-2.5 bg-yellow-600 hover:bg-yellow-500 rounded-lg font-semibold text-sm transition-colors text-white">
                                Buy Tickets
                            </button>
                        </div>
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

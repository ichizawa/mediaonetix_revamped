@extends('layouts')
@section('content')
    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Register Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0c1222] py-12">
        <!-- Animated Background -->
        <div class="absolute inset-0 mesh-gradient"></div>

        <!-- Floating Orbs -->
        <div class="absolute top-10 left-5 w-40 h-40 md:w-72 md:h-72 bg-blue-500 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow"></div>
        <div class="absolute bottom-10 right-5 w-48 h-48 md:w-96 md:h-96 bg-blue-400 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow" style="animation-delay: 2s;"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-12 py-12">
            <div class="max-w-2xl mx-auto">
                <!-- Logo/Brand -->
                <div class="text-center mb-8 register-header">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-6">
                        <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                        <span class="text-blue-300 text-sm font-medium">MediaoneTix</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-black mb-3 text-white">
                        Create Your <span class="gradient-text">Account</span>
                    </h1>
                    <p class="text-gray-400">Start selling tickets in minutes</p>
                </div>

                <!-- Register Card -->
                <div class="register-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-xl border border-white/10 rounded-2xl p-6 sm:p-8 glow-effect">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-500/0 rounded-2xl"></div>

                    <form class="relative space-y-6">
                        <!-- Name Fields Row -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <!-- First Name -->
                            <div class="form-group">
                                <label for="first-name" class="block text-sm font-semibold text-gray-300 mb-2">First Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="first-name" name="first_name"
                                        class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                        placeholder="John" required>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group">
                                <label for="last-name" class="block text-sm font-semibold text-gray-300 mb-2">Last Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="last-name" name="last_name"
                                        class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                        placeholder="Doe" required>
                                </div>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="block text-sm font-semibold text-gray-300 mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email"
                                    class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                    placeholder="you@example.com" required>
                            </div>
                        </div>

                        <!-- Phone Field -->
                        <div class="form-group">
                            <label for="phone" class="block text-sm font-semibold text-gray-300 mb-2">Phone Number <span class="text-gray-500 font-normal">(Optional)</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                    placeholder="+1 (555) 000-0000">
                            </div>
                        </div>

                        <!-- Password Fields Row -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" class="block text-sm font-semibold text-gray-300 mb-2">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password" name="password"
                                        class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                        placeholder="Min. 8 characters" required>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="confirm-password" class="block text-sm font-semibold text-gray-300 mb-2">Confirm Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="password" id="confirm-password" name="confirm_password"
                                        class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                        placeholder="Repeat password" required>
                                </div>
                            </div>
                        </div>

                        <!-- Account Type -->
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-300 mb-3">Account Type</label>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="account_type" value="organizer" class="peer sr-only" checked>
                                    <div class="p-4 bg-white/5 border-2 border-white/10 rounded-xl peer-checked:border-blue-500 peer-checked:bg-blue-500/10 transition-all hover:bg-white/10">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-white">Event Organizer</div>
                                                <div class="text-xs text-gray-400">Sell tickets for events</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer">
                                    <input type="radio" name="account_type" value="attendee" class="peer sr-only">
                                    <div class="p-4 bg-white/5 border-2 border-white/10 rounded-xl peer-checked:border-blue-500 peer-checked:bg-blue-500/10 transition-all hover:bg-white/10">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-white">Attendee</div>
                                                <div class="text-xs text-gray-400">Buy tickets for events</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="form-group">
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <input type="checkbox" class="mt-1 w-4 h-4 rounded border-gray-600 bg-white/5 text-blue-500 focus:ring-blue-500/20 focus:ring-offset-0" required>
                                <span class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors">
                                    I agree to the <a href="#" class="text-blue-400 hover:text-blue-300 font-medium">Terms of Service</a> and <a href="#" class="text-blue-400 hover:text-blue-300 font-medium">Privacy Policy</a>
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-semibold text-base shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-300 hover:scale-[1.02] text-white">
                            Create Account
                        </button>



                        <!-- Sign In Link -->
                        <div class="text-center text-sm text-gray-400">
                            Already have an account?
                            <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors font-semibold">Sign in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- GSAP Animations -->
    <script>
        // Initialize GSAP animations
        gsap.registerPlugin();

        // Animate register form elements on load
        gsap.from('.register-header', {
            opacity: 0,
            y: -30,
            duration: 0.8,
            ease: 'power3.out'
        });

        gsap.from('.register-card', {
            opacity: 0,
            y: 30,
            duration: 0.8,
            delay: 0.2,
            ease: 'power3.out'
        });

        gsap.from('.form-group', {
            opacity: 0,
            x: -20,
            duration: 0.6,
            stagger: 0.08,
            delay: 0.4,
            ease: 'power2.out'
        });

        gsap.from('.benefit-item', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            stagger: 0.1,
            delay: 0.8,
            ease: 'power2.out'
        });
    </script>


@endsection

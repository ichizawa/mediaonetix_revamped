@extends('layouts')
@section('content')
    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Login Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0c1222]">
        <!-- Animated Background -->
        <div class="absolute inset-0 mesh-gradient"></div>

        <!-- Floating Orbs -->
        <div
            class="absolute top-10 left-5 w-40 h-40 md:w-72 md:h-72 bg-blue-500 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow">
        </div>
        <div class="absolute bottom-10 right-5 w-48 h-48 md:w-96 md:h-96 bg-blue-400 rounded-full filter blur-[80px] md:blur-[120px] opacity-20 pulse-slow"
            style="animation-delay: 2s;"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-12 py-12">
            <div class="max-w-md mx-auto">
                <!-- Logo/Brand -->
                <div class="text-center mb-8 login-header">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-6">
                        <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                        <span class="text-blue-300 text-sm font-medium">MediaoneTix</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-black mb-3 text-white">
                        Welcome <span class="gradient-text">Back</span>
                    </h1>
                    <p class="text-gray-400">Sign in to continue to your dashboard</p>
                </div>

                <!-- Login Card -->
                <div
                    class="login-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-xl border border-white/10 rounded-2xl p-8 glow-effect">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-500/0 rounded-2xl"></div>

                    <form method="POST" action="{{ route('login.post') }}" class="relative space-y-6">
                        @csrf
                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="block text-sm font-semibold text-gray-300 mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email"
                                    class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                    placeholder="you@example.com" required>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="block text-sm font-semibold text-gray-300 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                    placeholder="Enter your password" required>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox"
                                    class="w-4 h-4 rounded border-gray-600 bg-white/5 text-blue-500 focus:ring-blue-500/20 focus:ring-offset-0">
                                <span class="text-gray-400 group-hover:text-gray-300 transition-colors">Remember me</span>
                            </label>
                            <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors font-medium">Forgot
                                password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-semibold text-base shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-300 hover:scale-[1.02] text-white">
                            Sign In
                        </button>

                         <div class="text-center text-sm text-gray-400">
                            No account yet?
                            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 transition-colors font-semibold">Sign up here.</a>
                        </div>
                    </form>
                </div>

                <!-- Footer Note -->
                <div class="text-center mt-8 text-sm text-gray-500">
                    <p>By signing in, you agree to our <a href="#"
                            class="text-gray-400 hover:text-gray-300 transition-colors">Terms of Service</a> and <a href="#"
                            class="text-gray-400 hover:text-gray-300 transition-colors">Privacy Policy</a></p>
                </div>
            </div>
        </div>
    </section>
    @if($errors->any())
        <script type="module">
            Toast.fire({
                icon: 'error',
                title: "{{ implode(' ', $errors->all()) }}"
            });
        </script>
    @endif

    @if(session('error'))
        <script type="module">
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        </script>
    @endif
@endsection

@extends('layouts')
@section('content')
    <main class="min-h-screen bg-[#0c1222] overflow-x-hidden">
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden py-12 px-4">

            <div class="relative w-full max-w-3xl">
                <!-- Card Container -->
                <div
                    class="backdrop-blur-xl bg-gradient-to-br from-blue-950/30 to-cyan-900/20 border-2 border-blue-500/20 rounded-3xl overflow-hidden shadow-2xl shadow-blue-500/10 transition-all duration-500 hover:border-blue-500/40 hover:shadow-blue-500/20">

                    <div class="relative p-8 lg:p-12">
                        <!-- Header Section -->
                        <div class="mb-8 pb-8 border-b border-blue-500/20">
                            <h1 class="text-4xl lg:text-5xl font-black text-white mb-2 drop-shadow-lg">My Profile</h1>
                            <p class="text-blue-300 text-lg">Manage your account information and preferences</p>
                        </div>


                        <!-- Form Section -->
                        <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf


                            <!-- Name Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label for="first-name"
                                        class="block text-sm font-bold text-blue-300 mb-2 uppercase tracking-wide">
                                        First Name
                                    </label>
                                    <input type="text"
                                        class="w-full px-4 py-3 bg-blue-950/30 border-2 border-blue-500/30 rounded-xl text-white placeholder-blue-400/50 focus:border-blue-400 focus:outline-none transition-all duration-300 backdrop-blur-sm"
                                        id="first-name" name="first_name" placeholder="Enter first name"
                                        value="{{ Auth::user()->first_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="last-name"
                                        class="block text-sm font-bold text-blue-300 mb-2 uppercase tracking-wide">
                                        Last Name
                                    </label>
                                    <input type="text"
                                        class="w-full px-4 py-3 bg-blue-950/30 border-2 border-blue-500/30 rounded-xl text-white placeholder-blue-400/50 focus:border-blue-400 focus:outline-none transition-all duration-300 backdrop-blur-sm"
                                        id="last-name" name="last_name" placeholder="Enter last name"
                                        value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>

                            <!-- Username Field -->
                            <div class="form-group">
                                <label for="username"
                                    class="block text-sm font-bold text-blue-300 mb-2 uppercase tracking-wide">
                                    Username
                                </label>
                                <input type="text"
                                    class="w-full px-4 py-3 bg-blue-950/30 border-2 border-blue-500/30 rounded-xl text-white placeholder-blue-400/50 focus:border-blue-400 focus:outline-none transition-all duration-300 backdrop-blur-sm"
                                    id="username" name="username" placeholder="Enter username"
                                    value="{{ Auth::user()->username }}">
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email"
                                    class="block text-sm font-bold text-blue-300 mb-2 uppercase tracking-wide">
                                    Email Address
                                </label>
                                <input type="email"
                                    class="w-full px-4 py-3 bg-blue-950/30 border-2 border-blue-500/30 rounded-xl text-white placeholder-blue-400/50 focus:border-blue-400 focus:outline-none transition-all duration-300 backdrop-blur-sm"
                                    id="email" name="email" placeholder="Enter email"
                                    value="{{ Auth::user()->email }}">
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group">
                                <label for="phone_number"
                                    class="block text-sm font-bold text-blue-300 mb-2 uppercase tracking-wide">
                                    Contact Number
                                </label>
                                <input type="tel"
                                    class="w-full px-4 py-3 bg-blue-950/30 border-2 border-blue-500/30 rounded-xl text-white placeholder-blue-400/50 focus:border-blue-400 focus:outline-none transition-all duration-300 backdrop-blur-sm"
                                    id="phone_number" name="phone_number" placeholder="Enter contact number"
                                    value="{{ Auth::user()->phone_number }}">
                            </div>

                            <!-- Password Section -->
                            <div class="pt-4 border-t border-blue-500/20">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="md:col-span-2 form-group">
                                        <label for="password"
                                            class="block text-sm font-bold text-blue-300 mb-2 uppercase tracking-wide">
                                            Password
                                        </label>
                                        <div class="relative">
                                            <input type="password"
                                                class="w-full px-4 py-3 bg-blue-950/30 border-2 border-blue-500/30 rounded-xl text-white placeholder-blue-400/50 focus:border-blue-400 focus:outline-none transition-all duration-300 backdrop-blur-sm pr-12"
                                                id="password" name="password"
                                                placeholder="Enter new password (leave blank to keep current)">
                                            <button type="button" id="password-toggle-btn"
                                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-blue-400 hover:text-blue-300 transition-colors"
                                                onclick="togglePasswordVisibility()"
                                                aria-label="Toggle password visibility">
                                                <i class="bi bi-eye-fill" id="password-toggle-icon"
                                                    style="font-size: 1.2rem;"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex gap-4 pt-6">
                                <button type="submit"
                                    class="flex-1 group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-105 inline-flex items-center justify-center gap-3">
                                    <i class="bi bi-check-circle"></i> Save Changes
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                                <button type="button" onclick="window.history.back()"
                                    class="px-8 py-4 bg-blue-950/30 hover:bg-blue-900/50 border-2 border-blue-500/30 hover:border-blue-500/50 text-blue-300 font-bold rounded-xl transition-all duration-300 backdrop-blur-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'fa fa-bell',
                    title: 'Success!',
                    message: @json(session('success'))
                }, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    delay: 3000,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });
            });
        </script>
    @endif

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('password-toggle-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }

        function previewProfileImage(event) {
            const input = event.target;
            const preview = document.getElementById('profile-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add smooth focus transition for inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    </script>

    {{-- <style>
        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.2;
            }

            50% {
                opacity: 0.4;
            }
        }

        .pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style> --}}
@endsection

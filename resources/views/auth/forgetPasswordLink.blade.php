@extends('layouts')
@section('content')

<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0c1222]">
  <!-- Mesh gradient background -->
  <div class="absolute inset-0" style="background:
      radial-gradient(at 20% 30%, rgba(59,130,246,0.10) 0px, transparent 50%),
      radial-gradient(at 80% 70%, rgba(6,182,212,0.10) 0px, transparent 50%),
      radial-gradient(at 50% 50%, rgba(37,99,235,0.05) 0px, transparent 50%);">
  </div>

  <!-- Floating orbs -->
  <div class="absolute top-10 left-5 w-40 h-40 md:w-72 md:h-72 bg-blue-500 rounded-full filter blur-[120px] opacity-20 animate-pulse"></div>
  <div class="absolute bottom-10 right-5 w-48 h-48 md:w-96 md:h-96 bg-blue-400 rounded-full filter blur-[120px] opacity-15 animate-pulse" style="animation-delay:2s;"></div>
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-600 rounded-full filter blur-[180px] opacity-5 pointer-events-none"></div>

  <!-- Card -->
  <div class="relative z-10 w-full max-w-md mx-auto px-4 sm:px-6">
    <div class="relative bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl shadow-blue-500/10 overflow-hidden">
      <!-- Top gradient bar -->
      <div class="absolute top-0 left-0 right-0 h-[2px] rounded-t-3xl"
        style="background: linear-gradient(90deg, #3b82f6 0%, #06b6d4 100%);"></div>
      <!-- Inner glow -->
      <div class="absolute inset-0 rounded-3xl pointer-events-none"
        style="background: radial-gradient(ellipse 60% 40% at 50% 0%, rgba(59,130,246,0.08) 0%, transparent 70%);"></div>

      <!-- Content -->
      <div class="relative text-center">
        <!-- Icon -->
        <div class="flex justify-center mb-6">
          <div class="relative">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center shadow-lg shadow-blue-500/30">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <!-- Ping badge -->
            <span class="absolute -top-1 -right-1 flex h-4 w-4">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-60"></span>
              <span class="relative inline-flex rounded-full h-4 w-4 bg-blue-500 border-2 border-[#0c1222]"></span>
            </span>
          </div>
        </div>

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-5">
          <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
          <span class="text-blue-300 text-xs font-semibold tracking-widest uppercase">Reset Password</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-4xl font-black text-white mb-3 leading-tight">
          Set a new<br />
          <span style="background:linear-gradient(135deg,#3b82f6,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
            password
          </span>
        </h1>

        <p class="text-gray-400 text-sm sm:text-base leading-relaxed mb-6 max-w-xs mx-auto">
          Enter your email and new password below to reset your account password.
        </p>

        @if (Session::has('message'))
          <div class="flex items-center gap-3 px-4 py-3 bg-green-500/10 border border-green-500/20 rounded-xl mb-6 text-left">
            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-green-300 text-sm font-medium">{{ Session::get('message') }}</p>
          </div>
        @endif

        <form method="POST" action="{{ route('reset.password.post') }}" class="space-y-6 text-left">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="form-group">
            <label for="email" class="block text-sm font-semibold text-gray-300 mb-2">Email Address</label>
            <div class="relative">
              <input type="email" id="email" name="email"
                class="w-full pl-4 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all @error('email') border-red-500 @enderror"
                placeholder="you@example.com" required>
            </div>
            @if ($errors->has('email'))
              <span class="text-red-400 text-xs font-medium">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="password" class="block text-sm font-semibold text-gray-300 mb-2">New Password</label>
            <div class="relative">
              <input type="password" id="password" name="password"
                class="w-full pl-4 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all @error('password') border-red-500 @enderror"
                placeholder="Enter new password" required>
            </div>
            @if ($errors->has('password'))
              <span class="text-red-400 text-xs font-medium">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-300 mb-2">Confirm Password</label>
            <div class="relative">
              <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full pl-4 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all @error('password_confirmation') border-red-500 @enderror"
                placeholder="Confirm new password" required>
            </div>
            @if ($errors->has('password_confirmation'))
              <span class="text-red-400 text-xs font-medium">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>
          <button type="submit"
            class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-semibold text-base shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-300 hover:scale-[1.02] text-white">
            Reset Password
          </button>
        </form>

        <a href="{{ route('login') }}"
          class="inline-flex items-center gap-1.5 mt-6 text-sm text-gray-500 hover:text-blue-400 transition-colors duration-200">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Login
        </a>
      </div>
    </div>

    <p class="text-center mt-6 text-gray-600 text-xs">
      © {{ date('Y') }} <span class="text-gray-500">Media<span class="text-blue-500">one</span>tix</span> · All rights reserved
    </p>
  </div>
</section>

@endsection
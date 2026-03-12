@extends('layouts')
@section('content')

    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0c1222]">

        {{-- Mesh gradient --}}
        <div class="absolute inset-0" style="background:
            radial-gradient(at 20% 30%, rgba(59,130,246,0.08) 0px, transparent 50%),
            radial-gradient(at 80% 70%, rgba(6,182,212,0.08) 0px, transparent 50%),
            radial-gradient(at 50% 50%, rgba(239,68,68,0.04) 0px, transparent 50%);">
        </div>

        {{-- Floating orbs --}}
        <div
            class="absolute top-10 left-5 w-40 h-40 md:w-72 md:h-72 bg-red-500 rounded-full filter blur-[120px] opacity-10 animate-pulse">
        </div>
        <div class="absolute bottom-10 right-5 w-48 h-48 md:w-80 md:h-80 bg-blue-500 rounded-full filter blur-[120px] opacity-10 animate-pulse"
            style="animation-delay:2s;"></div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-red-600 rounded-full filter blur-[200px] opacity-[0.04] pointer-events-none">
        </div>

        {{-- Card --}}
        <div class="relative z-10 w-full max-w-md mx-auto px-4 sm:px-6">
            <div
                class="relative bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl shadow-black/40">

                {{-- Top gradient bar --}}
                <div class="absolute top-0 left-0 right-0 h-[2px]"
                    style="background: linear-gradient(90deg, #ef4444 0%, #f97316 50%, #eab308 100%);"></div>

                {{-- Inner glow --}}
                <div class="absolute inset-0 rounded-3xl pointer-events-none"
                    style="background: radial-gradient(ellipse 65% 40% at 50% 0%, rgba(239,68,68,0.07) 0%, transparent 70%);">
                </div>

                <div class="relative px-8 sm:px-10 pt-12 pb-10 text-center">

                    {{-- Icon --}}
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            {{-- Outer ring --}}
                            <div class="w-24 h-24 rounded-full flex items-center justify-center"
                                style="background: radial-gradient(circle at 35% 35%, rgba(239,68,68,0.15), rgba(239,68,68,0.03));border:1.5px solid rgba(239,68,68,0.25);box-shadow:0 0 48px rgba(239,68,68,0.12);">
                                {{-- Inner square icon --}}
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                                    style="background:linear-gradient(135deg,#dc2626,#ef4444);box-shadow:0 8px 24px rgba(239,68,68,0.35);">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            {{-- Warning badge --}}
                            <div class="absolute -bottom-1 -right-1 w-7 h-7 rounded-full flex items-center justify-center border-2 border-[#0c1222]"
                                style="background:linear-gradient(135deg,#f97316,#eab308);">
                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2L1 21h22L12 2zm0 3.5L20.5 19H3.5L12 5.5zM11 10v4h2v-4h-2zm0 6v2h2v-2h-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-5"
                        style="background:rgba(239,68,68,0.10);border:1px solid rgba(239,68,68,0.22);">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse"></span>
                        <span class="text-red-300 text-xs font-semibold tracking-widest uppercase">Link Expired</span>
                    </div>

                    {{-- Headline --}}
                    <h1 class="text-3xl sm:text-4xl font-black text-white mb-3 leading-tight">
                        Your activation<br />
                        <span
                            style="background:linear-gradient(135deg,#ef4444,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                            link expired
                        </span>
                    </h1>

                    <p class="text-gray-400 text-sm sm:text-base leading-relaxed mb-8 max-w-xs mx-auto">
                        This activation link is no longer valid. Links expire after <span
                            class="text-gray-300 font-medium">24 hours</span> for security. Please register again to get a
                        fresh one.
                    </p>

                    {{-- Register CTA --}}
                    <a href="{{ route('register') }}"
                        class="group w-full flex items-center justify-center gap-2 px-6 py-4 rounded-xl font-bold text-white text-base transition-all duration-300 hover:scale-[1.02] mb-4"
                        style="background:linear-gradient(135deg,#dc2626,#ef4444,#f97316);box-shadow:0 8px 28px rgba(239,68,68,0.30);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Register Again
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3 my-5">
                        <div class="flex-1 h-px bg-white/5"></div>
                        <span class="text-white/20 text-xs">already have an account?</span>
                        <div class="flex-1 h-px bg-white/5"></div>
                    </div>

                    {{-- Login link --}}
                    <a href="{{ route('login') }}"
                        class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-semibold text-sm text-gray-300 border border-white/10 hover:border-blue-500/40 hover:text-blue-400 bg-white/[0.03] hover:bg-blue-500/5 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Back to Login
                    </a>

                    {{-- Info note --}}
                    <div class="flex items-start gap-2 mt-6 px-3 py-3 rounded-xl text-left"
                        style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.05);">
                        <svg class="w-4 h-4 text-yellow-500/60 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 text-xs leading-relaxed">
                            After registering, check your <span class="text-gray-400">inbox and spam folder</span> right
                            away and activate within 24 hours.
                        </p>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <p class="text-center mt-6 text-gray-600 text-xs">
                © {{ date('Y') }} <span class="text-gray-500">media<span class="text-blue-500">one</span>tix</span> · All
                rights reserved
            </p>
        </div>

    </section>

@endsection
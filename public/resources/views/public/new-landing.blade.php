@extends('components.navbar-guest')

@section('content')
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    {{-- Custom Font --}}
    <style>
        @font-face {
            font-family: 'Zuume Rough Bold';
            src: url('{{ asset('assets/fonts/zuume-rough/zuumerough-bold.otf') }}') format('opentype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        .roboto-font {
            font-family: 'Roboto', sans-serif;
        }

        .roboto-black {
            font-family: 'Roboto', sans-serif;
            font-weight: 900;
        }

        .zuume-rough-bold {
            font-family: 'Zuume Rough Bold', sans-serif;
            font-weight: bold;
        }

        /* Moving Ticket Banner Styles */
        .ticket-banner {
            position: absolute;
            width: 200%;
            height: 80px;
            background-color: #212121;
            transform: rotate(-3deg);
            z-index: 10;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .ticket-banner-content {
            display: flex;
            align-items: center;
            height: 100%;
            white-space: nowrap;
            animation: scroll-left 35s linear infinite;
        }

        .ticket-text {
            font-family: 'Roboto', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            color: white;
            margin: 0 5px;
            text-transform: uppercase;
        }

        /* Ticket Banner Responsive Styles */
        @media (max-width: 768px) {
            .ticket-banner {
                height: 60px;
                margin-top: 80px !important;
            }

            .ticket-text {
                font-size: 1.2rem;
                margin: 0 3px;
            }
        }

        @media (max-width: 576px) {
            .ticket-banner {
                height: 50px;
                margin-top: 60px !important;
            }

            .ticket-text {
                font-size: 1rem;
                margin: 0 2px;
            }
        }

        @media (max-width: 480px) {
            .ticket-banner {
                height: 40px;
                margin-top: 40px !important;
            }

            .ticket-text {
                font-size: 0.9rem;
                margin: 0 1px;
            }
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Position the banner */
        .banner-top {
            top: 20%;
            left: -50%;
        }

        .banner-bottom {
            bottom: 20%;
            left: -50%;
            transform: rotate(3deg);
            animation-delay: -10s;
        }

        /* Responsive Text Styles */
        .show-title {
            font-size: 9.5rem;
            color: #212121 !important;
            font-weight: bold;
            line-height: 1;
            margin: 0;
        }

        .hero-venue {
            font-size: 3rem;
            margin: 0;
            color: #212121;
            font-weight: bold;
            line-height: 1;
        }

        .hero-artists {
            font-size: 2.5rem;
            margin: 0;
            color: #212121;
            font-weight: bold;
            line-height: 1.1;
        }

        .countdown-title {
            font-size: 2rem;
            color: #212121;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .countdown-number {
            font-size: 2.5rem;
            color: #212121;
            font-weight: 900;
            line-height: 1;
        }

        /* Tablet styles (768px and below) */
        @media (max-width: 768px) {
            .show-title {
                font-size: 6rem;
            }

            .hero-venue {
                font-size: 2rem;
            }

            .hero-artists {
                font-size: 1.8rem;
            }

            .countdown-title {
                font-size: 1.5rem;
            }

            .countdown-number {
                font-size: 2rem;
            }
        }

        /* Mobile styles (576px and below) */
        @media (max-width: 576px) {
            .show-title {
                font-size: 4rem;
            }

            .hero-venue {
                font-size: 1.5rem;
            }

            .hero-artists {
                font-size: 1.3rem;
                line-height: 1.2;
            }

            .countdown-title {
                font-size: 1.2rem;
            }

            .countdown-number {
                font-size: 1.8rem;
            }

            .countdown-timer {
                gap: 2rem !important;
            }
        }

        /* Small mobile styles (480px and below) */
        @media (max-width: 480px) {
            .show-title {
                font-size: 3rem;
            }

            .hero-venue {
                font-size: 1.2rem;
            }

            .hero-artists {
                font-size: 1.1rem;
            }

            .countdown-title {
                font-size: 1rem;
            }

            .countdown-number {
                font-size: 1.5rem;
            }

            .countdown-timer {
                gap: 1rem !important;
            }
        }

        /* Featured Artists Title Responsive */
        .featured-title {
            font-size: 7rem;
            color: #212121;
            font-weight: bold;
            margin-bottom: 50px;
        }

        /* Tablet styles (768px and below) */
        @media (max-width: 768px) {
            .featured-title {
                font-size: 4rem !important;
                margin-bottom: 30px !important;
            }
        }

        /* Mobile styles (576px and below) */
        @media (max-width: 576px) {
            .featured-title {
                font-size: 3rem !important;
                margin-bottom: 20px !important;
            }
        }

        /* Small mobile styles (480px and below) */
        @media (max-width: 480px) {
            .featured-title {
                font-size: 2.5rem !important;
                margin-bottom: 15px !important;
            }
        }
    </style>

    <section>
        <div class="hero-bg" style="
                    background-image: url('{{ asset('assets/img/ddc-landing-bg-comp.webp') }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100vw;
                    height: 100vh;
                    z-index: -1;
                ">
        </div>

        <div class="hero-content container-fluid" style="
                    position: relative;
                    z-index: 1;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 10px 0;
                ">
            <div class="row w-100 justify-content-center">
                <div class="col-12 text-center">
                    {{-- ddc logo
                    presented by ddc --}}
                    <div class="ddc-logo-section mt-4">
                        <picture>
                            <source srcset="{{ asset('assets/img/ddc-logo.png') }}" type="image/webp" >
                            <img src="{{ asset('assets/img/ddc-logo.png') }}" alt="DDC Logo" loading="lazy" style="height: 45px; width: auto;">
                        </picture>

                        <p class="roboto-black" style="font-size: 1rem; margin: 0; color: #212121; font-weight: 900;">
                            PRESENTED BY DAVAO DOCTORS COLLEGE
                        </p>
                    </div>

                    {{-- SALINDAYAW MUSIC FESTIVAL ZUUM ROUGH BOLD FONT --}}
                    <div class="">
                        <h1 class="zuume-rough-bold show-title">
                            SALINDAYAW<br>MUSIC FESTIVAL
                        </h1>
                    </div>

                    {{-- DATE AND TIME ROBOTO FONT --}}
                    <div class="">
                        <p class="roboto-black" style="font-size: 1.2rem; margin: 0; color: #212121; font-weight: 900;">
                            AUGUST 30, 2025 • 4:00 PM
                        </p>
                    </div>

                    {{-- VENUE ZUUM ROUGH BOLD FONT --}}
                    <div class="mt-4">
                        <h2 class="zuume-rough-bold hero-venue">
                            CROCODILE PARK FESTIVAL GROUNDS
                        </h2>
                    </div>

                    {{-- FEATURING ARTISTS ZUUM ROUGH BOLD FONT --}}
                    <div class="artists">
                        <h3 class="zuume-rough-bold hero-artists">
                            PAROKYA NI EDGAR • OH CARAGA • MOONSTAR88 <br>
                            EARL AGUSTIN • JR OCLARIT <br>
                            CUP OF JOE

                        </h3>
                    </div>

                    {{-- EVENT COUNTDOWN ROBOTO FONT --}}
                    <div class=" mt-4">
                        <div class="roboto-black countdown-title">
                            EVENT STARTS IN
                        </div>
                        <div class="countdown-timer d-flex justify-content-center align-items-center gap-4">
                            <div class="countdown-item text-center">
                                <div class="roboto-black countdown-number">
                                    <span id="countdown-days">00</span>
                                </div>
                                <div class="roboto-black" style="font-size: 1rem; color: #212121; font-weight: 900;">
                                    DAYS
                                </div>
                            </div>
                            <div class="countdown-item text-center">
                                <div class="roboto-black countdown-number">
                                    <span id="countdown-hours">00</span>
                                </div>
                                <div class="roboto-black" style="font-size: 1rem; color: #212121; font-weight: 900;">
                                    HOURS
                                </div>
                            </div>
                            <div class="countdown-item text-center">
                                <div class="roboto-black countdown-number">
                                    <span id="countdown-minutes">00</span>
                                </div>
                                <div class="roboto-black" style="font-size: 1rem; color: #212121; font-weight: 900;">
                                    MINUTES
                                </div>
                            </div>
                            <div class="countdown-item text-center">
                                <div class="roboto-black countdown-number">
                                    <span id="countdown-seconds">00</span>
                                </div>
                                <div class="roboto-black" style="font-size: 1rem; color: #212121; font-weight: 900;">
                                    SECONDS
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TICKET BUTTON ROBOTO FONT --}}
                    <div class="" style="margin-top: 20px;">
                        <a href="{{ route('buy.ticket', 'salindayaw-music-festival-1') }}" class="btn roboto-black"
                            style="font-size: 1.2rem; padding: 15px 40px; border-radius: 15px; background-color: #212121; border: none; color: white; font-weight: 900; text-decoration: none; display: inline-block;">
                            GET YOUR TICKETS NOW
                        </a>
                    </div>

                    {{-- moving ticket banner --}}
                    <div class="ticket-banner responsive-banner"
                        style="position: relative; width: 200vw; margin-top: 100px; left: -50vw; transform: rotate(-2deg); overflow: hidden;">
                        <div class="ticket-banner-content">
                            @for ($i = 1; $i <= 20; $i++)
                                <span class="ticket-text">GET YOUR TICKETS NOW</span>
                                <span class="ticket-text">•</span>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- FEATURED ARTISTS SECTION --}}
    <section class="" style="padding: 50px 40px;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center ">
                    <h1 class="zuume-rough-bold featured-title">
                        FEATURED ARTISTS
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="featured-artists-image" style="text-align: center;">
                        <img src="{{ asset('assets/img/featured-artists.png') }}" alt="Featured Artists"
                            style="width: 100%; max-width: 1200px; height: auto; border-radius: 20px; ">
                    </div>
                </div>
            </div>
        </div>
    </section>

    </section>
    <footer class="text-center py-3 " style="color: #fff;">
        <div class="container">
            <small>Copyright © 2025. Powered by <a style="color: #4dccc4;" href="https://mediaoneph.com/"
                    target="_blank">MediaOne Software Solutions</a></small>
        </div>
    </footer>

    {{-- Countdown JavaScript --}}
    <script>
        const eventDate = new Date('August 30, 2025 16:00:00').getTime();

        // Update countdown every second
        const countdownInterval = setInterval(function () {
            const now = new Date().getTime();
            const distance = eventDate - now;

            // Calculate time units
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result
            document.getElementById('countdown-days').textContent = days.toString().padStart(2, '0');
            document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');

            // If the countdown is over, display a message
            if (distance < 0) {
                clearInterval(countdownInterval);
                document.getElementById('countdown-days').textContent = '00';
                document.getElementById('countdown-hours').textContent = '00';
                document.getElementById('countdown-minutes').textContent = '00';
                document.getElementById('countdown-seconds').textContent = '00';
            }
        }, 1000);
    </script>
@endsection

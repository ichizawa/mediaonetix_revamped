<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MediaoneTix</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/mediaone_tix_1.png') }}">
    <script src="{{ asset('assets/js/plugin/jquery/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/kaiadmin.horizontal.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/landing-ddc.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/css/kaiadmin.min.css') }}" rel="stylesheet"> -->
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/main.css') }}" />
</head>

<script>
    $(document).ready(function () {
        $(window).on("load pageshow", function (event) {
            if (event.type === "pageshow" && event.originalEvent.persisted) {
                $('.loadings-container').fadeOut('slow');
            } else if (event.type === "load") {
                $('.loadings-container').fadeOut('slow');
            }
        });
    });

    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 70
        }, 500);
    });
</script>

<body style="background: url('./img/background_login.png') no-repeat center center fixed;
             background-size: cover;">
    @include('components.loader')
    <div class="wrapper">
        <!-- Improved Header -->
        @if(Route::is('event', 'news', 'contact', 'about', 'home'))
        <header class="main-header">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container container-fluid">
                    <a class="navbar-brand" href="{{ route('landing') }}">
                        <img src="{{ asset('assets/img/logo_sidetext.png') }}" alt="MediaOneTix Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                                    href="{{ route('home') }}">HOME</a>
                            </li>
                            <!-- <li class="nav-item">
                                    <a class="nav-link {{ Route::is('event') ? 'active' : '' }}"
                                        href="{{ route('event') }}">EVENTS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('news') ? 'active' : '' }}"
                                        href="{{ route('news') }}">NEWS</a>
                                </li> -->
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('about') ? 'active' : '' }}"
                                    href="{{ route('about') }}">ABOUT US</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}"
                                    href="{{ route('contact') }}">CONTACT US</a>
                            </li>
                        </ul>

                        <div class="search-container">
                            <form class="d-flex" role="search">
                                <input class="form-control search-input" type="search" placeholder="Search events..."
                                    aria-label="Search">
                                <i class="bi bi-search search-icon"></i>
                            </form>
                        </div>

                    </div>
                </div>
            </nav>
        </header>
        @endif

        <div class="main-panel" style="width: 100% !important; padding: 0 !important;">
            <div class="container mt--1" style="width: 100% !important; max-width: 100% !important;">
                @yield('content')
            </div>

            @if(Route::is('event', 'home', 'news', 'contact', 'about'))
            <!-- Improved Footer -->
            <footer class="footer">
                <div class="container text-white" style="place-content: center">
                    <div class="row g-4 align-items-center">
                        <div class="col-12 col-md-3 text-center text-md-start">
                            <img src="{{ asset('assets/img/logo_sidetext.png') }}" alt="MediaOne Tix Logo" height="50"
                                class="mb-3 mb-md-0">
                        </div>

                        <div class="col-12 col-md-6">
                            <ul class="nav justify-content-center flex-wrap">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">HOME</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('event') }}">EVENTS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('news') }}">NEWS</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about') }}">ABOUT US</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}">CONTACT US</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12 col-md-3">
                            <form class="d-flex justify-content-center justify-content-md-end">
                                <div class="input-group" style="max-width: 250px;">
                                    <input type="text" class="form-control rounded-start-pill px-3"
                                        placeholder="Search">
                                    <button class="btn btn-white rounded-end-pill px-3" type="submit">
                                        <i class="bi bi-search" style="color: #0F355A;"></i>
                                    </button>
                                </div>
                            </form>
                        </div>


                        <div class="col-12">
                            <hr class="full-width-hr">
                        </div>

                        <div class="col-12 text-center">
                            <small>Copyright © 2025. Powered by MediaOne Software Solutions</small>
                        </div>
                    </div>
                </div>
            </footer>
            @endif
        </div>
    </div>

    <script src="{{ asset('ajax/ticket.js') }}"></script>
    <script src="{{ asset('ajax/landing-ddc.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
</body>

</html>
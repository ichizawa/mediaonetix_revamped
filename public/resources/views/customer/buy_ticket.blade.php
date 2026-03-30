

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
    <!-- <link href="{{ asset('assets/css/kaiadmin.min.css') }}" rel="stylesheet"> -->
</head>
<script>
    $(document).ready(function () {
        // Use both "load" and "pageshow" events to hide the loader
        $(window).on("load pageshow", function (event) {
            // For the pageshow event, check if the page was loaded from cache
            if (event.type === "pageshow" && event.originalEvent.persisted) {
                $('.loadings-container').fadeOut('slow');
            } else if (event.type === "load") {
                $('.loadings-container').fadeOut('slow');
            }
        });
        // Remove or comment out the fadeIn on beforeunload if it's causing issues
        // $(window).on("beforeunload", function () {
        //   $('.loadings-container').fadeIn('slow');
        // });
    });
</script>

<body style="background: url('./img/background_login.png') no-repeat center center fixed;
             background-size: cover;">
    @include('components.loader')
    <div class="wrapper">
        <div class="main-header">
            <nav class="navbar navbar-header navbar-expand-lg navbar-light">
                <div class="container-fluid d-flex align-items-center w-100 justify-items-center p-5">
                    <div class="nav-controls">
                        <a class="navbar-brand" href="{{ route('landing') }}">
                            <img src="{{ asset('assets/img/mediaoneTix.png') }}" alt="Bootstrap" height="60">
                        </a>

                        <button class="topbar-toggler more" data-bs-toggle="collapse" data-bs-target="#menuIconHeader"
                            aria-expanded="false" aria-controls="#menuIconHeader">
                            <i class="gg-more-vertical-alt bg-primary text-primary"></i>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="menuIconHeader">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center d-flex flex-wrap gap-2">
                            <li class="dropdown nav-item topbar-user hidden-caret">
                                <div class="form-group w-100 w-md-auto">
                                    <select name="search-event" id="search-event-1"
                                        class="form-select border border-primary rounded"
                                        style="height: 40px; min-width: 200px;">
                                        <option value="" selected hidden>Select Event</option>
                                    </select>
                                </div>
                            </li>
                            <li class="dropdown nav-item topbar-user hidden-caret">
                                <div class="form-group w-100 w-md-auto">
                                    <select name="search-event" id="search-event-2"
                                        class="form-select border border-primary rounded"
                                        style="height: 40px; min-width: 200px;">
                                        <option value="" selected hidden>Select Event</option>
                                    </select>
                                </div>
                            </li>
                            <li class="dropdown nav-item topbar-user hidden-caret">
                                <button class="btn btn-sta w-100 w-md-auto" style="height: 40px;">Go</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="main-panel" style="width: 100% !important; padding: 0 !important;">
            <div class="container mt--1" style="width: 100% !important; max-width: 100% !important;">
                @yield('content')
                <div class="py-5 px-3 position-relative" style="background-color: #0F355A12;">
                    <div id="eventCarousel" class=" container carousel slide" data-bs-ride="carousel"
                        data-bs-touch="true">
                        <div class="carousel-inner">
                            <!-- Event 1 -->
                            <div class="carousel-item active">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-6 text-center text-md-start">
                                        <div class="d-flex flex-column gap-1 mb-2">
                                            <h2 class="fw-bold mb-0" style="font-size: 3rem;">DAVAO GRUNGE NIGHT</h2>
                                            <div class="d-flex align-items-center gap-3">
                                                <p class="mb-0">MIC 1 LIVE ROOM</p>
                                                <p class="mb-0">
                                                    <i class="fa-solid fa-calendar"></i> May 1, 2025 &nbsp;
                                                    <i class="fas fa-clock"></i> 6:00 PM
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ route('buy.ticket', ['event' => 'davao-grunge-night']) }}" class="btn mt-4 align-items-center" style="background-color: #0F355A12; border: 2px solid #0F355A; color: #0F355A; width: 150px; height: 40px;">
                                            Buy Ticket
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img src="{{ asset('assets/img/events/grunge_night.png') }}" class="img-fluid"
                                            style="max-height: 455px;" alt="Davao Grunge Night Poster">
                                    </div>
                                </div>
                            </div>
                            <!-- Add more events below like this -->
                            <div class="carousel-item">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-6 text-center text-md-start">
                                        <div class="d-flex flex-column gap-1 mb-2">
                                            <h2 class="fw-bold mb-0" style="font-size: 3rem;">ROCK NIGHT FEST</h2>
                                            <div class="d-flex align-items-center gap-3">
                                                <p class="mb-0">OPEN GROUNDS</p>
                                                <p class="mb-0">
                                                    <i class="fa-solid fa-calendar"></i> June 5, 2025 &nbsp;
                                                    <i class="fas fa-clock"></i> 7:30 PM
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ route('buy.ticket', ['event' => 'davao-grunge-night']) }}" class="btn mt-4 align-items-center" style="background-color: #0F355A12; border: 2px solid #0F355A; color: #0F355A; width: 150px; height: 40px;">
                                            Buy Ticket
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img src="{{ asset('assets/img/events/Davao Grunge Night 4.png') }}"
                                            class="img-fluid" style="max-height: 455px;" alt="Rock Night Poster">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators justify-content-center position-absolute ">
                        <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                </div>

                <div class="flex">
                    <div class="container mt-5">
                        <h4 class="fw-bold fs-2">Events</h4>
                    </div>
                    <div class="flex">
                        <hr style="opacity: 1; background-color: #0F355A; width: 100%; margin-bottom: 24px;">
                    </div>
                    <div class=" flex container">
                        <div class=" flex container bg-light py-3 px-0 ">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card h-auto text-center">
                                        <div class="position-relative hover-container">
                                            <img src="{{ asset('assets/img/events/grunge_night.png') }}"
                                                class="card-img-top img-hover" alt="Grunge Night Poster">

                                            <div class="position-absolute top-50 start-50 translate-middle d-none hover-show">
                                                <a href="{{ route('buy.ticket', ['event' => 'davao-grunge-night']) }}" class="btn btn-buy-ticket px-4 py-2">
                                                    Buy Ticket
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Davao Grunge Night</h5>
                                        <p class="card-text mb-0"><i class="fa-solid fa-calendar"></i> May 1, 2025 - 6PM</p>
                                        <p class="badge mt-1"
                                            style="background-color: #0F355A12; border: 2px solid #0F355A; color: #0F355A;">
                                            MIC 1 LIVE ROOM - DAVAO CITY
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card h-auto d-flex justify-content-center align-items-center"
                                        style="min-height: 520px;">
                                        <h5 class="text-center" style="color: #0F355A;">More Event Here</h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Event Name</h5>
                                        <p class="card-text mb-0"><i class="fa-solid fa-calendar"></i> Event Date</p>
                                        <p class="badge mt-1vfs-1"
                                            style="background-color: #0F355A12; border: 2px solid #0F355A; color: #0F355A;">
                                            Event Venue/Address/Location
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card h-auto d-flex justify-content-center align-items-center"
                                        style="min-height: 520px;">
                                        <h5 class="text-center" style="color: #0F355A;">More Event Here</h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Event Name</h5>
                                        <p class="card-text mb-0"><i class="fa-solid fa-calendar"></i> Event Date</p>
                                        <p class="badge mt-1vfs-1"
                                            style="background-color: #0F355A12; border: 2px solid #0F355A; color: #0F355A;">
                                            Event Venue/Address/Location
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer"
                style="width: 100% !important; max-width: 100% !important; background: #0F355A; padding: 20px 0;">
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center text-center gap-2"
                    style="width: 100% !important; max-width: 100% !important;">
                    <img src="{{ asset('assets/img/logo_sidetext.png') }}" alt="MediaOne Tix Logo" height="50" />
                    <div class="text-white">
                        Copyright © 2025. Powered By MediaOne Software Solutions
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('ajax/ticket.js') }}"></script>
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
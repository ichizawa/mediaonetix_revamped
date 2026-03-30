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

<body class="is-preloaded" style="background: url('./img/background_login.png') no-repeat center center fixed;
             background-size: cover;">
    @include('components.loader')

    @yield('content')

    <!-- <script src="{{ asset('assets2/js/jquery.scrolly.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets2/js/browser.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets2/js/breakpoints.min.js') }}"></script> -->
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
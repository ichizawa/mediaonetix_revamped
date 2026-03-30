<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MediaoneTix</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/mediaone_tix_1.png') }}">
    <link href="{{ asset('assets/css/base.css') }}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    html,
    body {
        background: hsla(60, 50%, 3%, 1);
    }
</style>

<body class="demo-4">
    <main>
        <div class="content content--canvas">
            <div class="wrapper">
                <h1>Be right back</h1>
                <p>We're brewing something and it's gonna be amazing! </p>
                <div class="icons">
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href=""><i class="fa-brands fa-youtube"></i></a>
                    <a href=""><i class="fa fa-paper-plane"></i></a>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/coalesce.js') }}"></script>
    <script src="{{ asset('assets/js/util.js') }}"></script>
    <script src="{{ asset('assets/js/noise.min.js') }}"></script>
</body>

</html>
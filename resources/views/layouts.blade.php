<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{--
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediaonetix</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles />
</head>

<body>
    <div>
        @if(Route::is('admin.*'))
            <x-navbar />
            <x-sidebar />
        @endif
       
        @yield('content')
        <livewire:scripts />
    </div>

    @if(session('success'))
        <script type="module">
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    
    @if($errors->any())
        <script type="module">
            Toast.fire({
                icon: 'error',
                title: "{{ implode(' ', $errors->all()) }}"
            });
        </script>
    @endif
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>
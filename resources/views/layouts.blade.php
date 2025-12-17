<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediaonetix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js'])
    <livewire:styles />
</head>

<body>
    <div>
        @if (Route::is('admin.*'))
            @include('components.navbar')
            @include('components.sidebar')
        @endif
        @yield('content')
    </div>
    <livewire:scripts />
</body>
</html>
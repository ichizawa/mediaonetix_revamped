<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .container {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            position: relative;
        }

        .page-break {
            page-break-after: always;
        }

        .image-container {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .left {
            position: absolute;
            left: 50%;
            bottom: 20px;
            transform: translateX(-50%);
            color: black;
            z-index: 2;
            text-align: center;
        }

        .right {
            position: absolute;
            right: 30px;
            top: 60%;
            transform: translateY(-50%);
            text-align: center;
            z-index: 2;
            display: block;

        }

        .right>* {
            display: block;
            margin: 8px auto;
            text-align: center;
        }

        .qrcode-container {
            width: 200px;
            height: 200px;
            display: block;
            overflow: hidden;
            margin: 10px auto;
            position: relative;
        }

        .qrcode-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .left h1 {
            font-weight: bold;
            font-size: 17px;
        }

        .right h1 {
            font-size: 24px;
        }
    </style>
</head>

<body>
    @foreach ($sales as $index => $sale)
        @php
            $imagePath = public_path('assets/img/ticket_template.png');
            $base64Image = base64_encode(file_get_contents($imagePath));

            // Add page break class only if it's not the last item
            $containerClass = $index < count($sales) - 1 ? 'container page-break' : 'container';
        @endphp
        <div class="{{ $containerClass }}">
            <div class="image-container" style="background-color: {{ $sale['ticket_color'] }};">
                <img src="data:image/png;base64,{{ $base64Image }}" alt="">
                <div class="left">
                    <h1>Entrance Code: {{ $sale['reference_num'] }}</h1>
                </div>
                <div class="right">
                    <h1>{{ $sale['ticket_type'] }}</h1>
                    <div class="qrcode-container">
                        <img src="data:image/png;base64,{!! base64_encode($sale['qrcode']) !!}" alt="QR Code" />
                    </div>
                    <h1>{{ $sale['ticket_price'] }} PHP</h1>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>

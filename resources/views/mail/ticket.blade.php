<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:wght@700&display=swap');

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

        .image-container>img.bg-template {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .event-img-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 31.8%;
            height: 100%;
            z-index: 2;
            overflow: hidden;
            /* Crucial for the crop bounds */
            background-color: #f3f4f6;
            /* Fallback background */
        }

        .event-details {
            position: absolute;
            left: 34.5%;
            top: 15%;
            z-index: 2;
            color: black;
            max-width: 40%;
        }

        .event-category {
            font-family: 'Montserrat', sans-serif;
            /* Added Montserrat */
            font-size: 14px;
            font-weight: 700;
            /* 700 is Bold */
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .event-name {
            font-family: 'Archivo Black', sans-serif;
            /* Added Archivo Black */
            font-size: 45px;
            font-weight: normal;
            /* Archivo Black is inherently bold, so normal weight is usually best here */
            line-height: 1.05;
            margin: 0 0 15px 0;
            text-transform: uppercase;
        }

        .event-date {
            font-family: 'Montserrat', sans-serif;
            /* Added Montserrat */
            font-size: 18px;
            font-weight: 700;
            /* 700 is Bold */
        }

        .stub-event-name {
            position: absolute;
            right: 30px;
            top: 8%;
            z-index: 2;
            font-size: 20px;
            font-weight: 900;
            text-transform: uppercase;
            text-align: center;
            max-width: 15%;
        }

        .left {
            position: absolute;
            left: 34.5%;
            /* Matches the left position of .event-details */
            bottom: 25px;
            /* Adjust this if it sits too high or low relative to the dashed line */
            color: black;
            z-index: 2;
            text-align: left;
            /* Changed from center to left */
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

        .fallback-icon {
            width: 100%;
            height: 100%;
            display: table;
            text-align: center;
        }

        .fallback-icon-inner {
            display: table-cell;
            vertical-align: middle;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    @foreach ($sales as $index => $sale)
        @php
            // 1. Template Background Image
            $imagePath = public_path('images/ticket_template.png');
            $base64Image = base64_encode(file_get_contents($imagePath));

            // 2. Event Image & Crop Logic
            $hasEventImage = false;
            $base64EventImage = '';
            $cropImageStyle = 'width: 100%; height: 100%; object-fit: cover; position: absolute;';

            if (!empty($sale['event_image'])) {
                // Adjust this path if 'event_image' already contains the folder name
                $eventImagePath = public_path('images/events/' . $sale['event_image']);

                // Fallback check if path construction is different in your DB
                if (!file_exists($eventImagePath)) {
                    $eventImagePath = public_path($sale['event_image']);
                }

                if (file_exists($eventImagePath) && is_file($eventImagePath)) {
                    $base64EventImage = base64_encode(file_get_contents($eventImagePath));
                    $hasEventImage = true;

                    // Apply the Crop Math if data is available
                    $hasCrop =
                        isset(
                            $sale['crop_x'],
                            $sale['crop_y'],
                            $sale['crop_width'],
                            $sale['crop_height'],
                            $sale['crop_natural_width'],
                            $sale['crop_natural_height'],
                        ) &&
                        $sale['crop_width'] > 0 &&
                        $sale['crop_height'] > 0;

                    if ($hasCrop) {
                        $widthPercent = ($sale['crop_natural_width'] / $sale['crop_width']) * 100;
                        $heightPercent = ($sale['crop_natural_height'] / $sale['crop_height']) * 100;
                        $leftPercent = -($sale['crop_x'] / $sale['crop_width']) * 100;
                        $topPercent = -($sale['crop_y'] / $sale['crop_height']) * 100;

                        $cropImageStyle = sprintf(
                            'position: absolute; width: %.6f%%; height: %.6f%%; max-width: none; max-height: none; left: %.6f%%; top: %.6f%%;',
                            $widthPercent,
                            $heightPercent,
                            $leftPercent,
                            $topPercent,
                        );
                    }
                }
            }

            // Add page break class only if it's not the last item
$containerClass = $index < count($sales) - 1 ? 'container page-break' : 'container';
        @endphp
        <div class="{{ $containerClass }}">
            <div class="image-container" style="background-color: {{ $sale['ticket_color'] }};">
                <img class="bg-template" src="data:image/png;base64,{{ $base64Image }}" alt="">

                <div class="event-img-wrapper">
                    @if ($hasEventImage)
                        <img src="data:image/png;base64,{{ $base64EventImage }}" style="{{ $cropImageStyle }}"
                            alt="Event Cover">
                        <div
                            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.2); z-index: 3;">
                        </div>
                    @else
                        <div class="fallback-icon">
                            <div class="fallback-icon-inner">
                                No Image
                            </div>
                        </div>
                    @endif
                </div>

                <div class="event-details">
                    <div class="event-category">{{ $sale['event_category'] }}</div>
                    <div class="event-name">{{ $sale['event_name'] }}</div>
                    <div class="event-date">
                        {{ \Carbon\Carbon::parse($sale['event_date'])->format('F d, Y - g:i A') }}
                    </div>
                </div>



                <div class="left">
                    <h1>Entrance Code: {{ $sale['reference_num'] }}</h1>
                </div>
                <div class="right">
                    <h1>{{ $sale['ticket_type'] }}</h1>
                    <div class="qrcode-container">
                        <img src="data:image/png;base64,{!! base64_encode($sale['qrcode']) !!}" alt="QR Code" />
                    </div>
                  
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>

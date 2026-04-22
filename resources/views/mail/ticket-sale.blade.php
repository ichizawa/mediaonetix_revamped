<body>
    <p>Thank you for your purchase! Here are your ticket details:</p>

    <p>
        <strong>Name:</strong> {{ $sale->customer_name }}<br>
        <strong>Admission Type:</strong> {{ $sale->ticket->type }}<br>
        <strong>Event Name:</strong> {{ $sale->event->event_name }}<br>
        <strong>Event Date:</strong> {{ $sale->event->event_date }} at {{ $sale->event->event_time }}<br>
        <strong>Event Venue:</strong> {{ $sale->event->event_venue }}
    </p>

    <p>This is your login details:</p>
    <p>
        <strong>Login URL:</strong> https://mediaonetix.com/login<br>
        <strong>Email:</strong> {{ $sale->customer_email }}<br>
        <strong>Password:</strong> {{ $password }}<br>
    </p>

    <p><strong>Scan for Entry:</strong><br>
    Please present the QR code attached below at the entrance for a smooth check-in.</p>

    <p>We look forward to seeing you at the event!</p>
</body>

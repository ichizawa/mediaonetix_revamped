<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>{{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="color-scheme" content="light">
  <meta name="supported-color-schemes" content="light">

  <style>
    * {
      padding: 0;
      margin: 0;
    }



    .wrapper {
      font-family: Helvetica, sans-serif;
      background-color: #48a7c5;
      padding: 2em;
      height: 700px;


    }

    .body {

      background-color: white;
      margin: auto auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 95%;
      border-radius: 5px;

      overflow: visible;
      height: 95%;
    }

    .head {
      min-height: 75px;
      padding: 1em;
    }

    .header {
      font-size: 20px;
      font-weight: bold;
      padding: 0;
    }

    .loc-and-age-details {

      font-size: 15px;
      margin-bottom: 25px;
    }

    .loc {
      color: gray;
    }

    .age {
      color: rgb(5, 179, 48);
    }

    .separator {
      width: 150%;
      height: 50px;
      display: block;
      margin: 0 -1.5em;



    }



    .separator>span {


      padding: 2px;
      margin: auto 4px;
      height: 5px;
      width: 5px;
      border-radius: 50%;
      background-color: #48a7c5;
      margin-bottom: 13px;
      display: inline-block;
    }

    #left-circle,
    #right-circle {
      margin-bottom: 0;

      padding: 15px;
      color: '#48a7c5';

    }


    .image {
      padding: 0 1em;
      margin: 0 auto;
      height: 250px;
      padding: 0.5em;
      padding-bottom: 2em;
      border-bottom: 1px solid #eeecec;
      margin-bottom: 1em;
    }

    .image img {
      margin-left: 15%;
      width: 250px;
      height: 250px;
      background-color: gray;

    }





    .details {
      padding: 0 1em;
      display: block;
      min-height: 50px;
    }

    .details div:last-of-type {
      float: right;
    }

    .details div:first-of-type {
      float: left;
    }

    .title {
      color: gray;
    }

    .value {
      font-weight: bold;
    }

    .footer {
      min-height: 50px;
      width: 100%;
      border-radius: 0 0 5px 5px;

      background-color: rgb(235, 235, 235);
    }

    .footer>* {
      display: inline-block;

    }
  </style>
</head>

<body>
  @foreach ($sales as $sale)
    <style>
    .separator>span {
      background-color:
      <?= htmlspecialchars($sale['ticket_color'], ENT_QUOTES, 'UTF-8') ?>
      ;
    }
    </style>
    <div class="wrapper" style="background-color: <?= $sale['ticket_color'] ?>">
    <div class="body">
      <div class="head">
      <h1 class="header">{{ $sale['ticket_type'] }}</h1>
      <div class="loc-and-age-details">
        <p class="loc">Ticket Type: {{ $sale['ticket_type'] }}</p>
        <p class="age">{{ date('F d, Y', strtotime($sale['event_date'])) }}</p>
      </div>
      </div>
      <div class="separator">
      <span
        id="left-circle"></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span
        id="right-circle"></span>
      </div>
      <div class="image">
      <img src="data:image/png;base64, {!! base64_encode($sale['qrcode']) !!}" alt="QR Code">
      </div>
      <div class="details">
      <div class="detail">
        <p class="title">Entrance code</p>
        <p class="value">{{ $sale['reference_num'] }}</p>
      </div>
      </div>
      <div class="separator">
      <span
        id="left-circle"></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span
        id="right-circle"></span>
      </div>
      <div class="details">
      <div class="detail">
        <p class="title">Ticket Type</p>
        <p class="value">{{ $sale['ticket_type'] }}</p>
      </div>
      <div class="detail">
        <p class="title">Price(PHP)</p>
        <p class="value">{{ $sale['ticket_price'] }}</p>
      </div>
      </div>

      <div class="footer">
      </div>
    </div>
    </div>
  @endforeach
</body>

</html>
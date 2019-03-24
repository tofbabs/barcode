<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            .centralised {
                background-color: white;
                width: 570px;
                height: 400px;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
            .top-banner img{
                height: 90px;
                width: 570px;
                position: absolute;
                top: 0px;
            }
            .bottom-banner img{
                height: 90px;
                width: 570px;
                position: absolute;
                bottom: 0px;
            }
            .bib-number p{
                color: black;
                font-size: 11em;
                margin-top: 74px;
                font-family: Arial, Helvetica, sans-serif;
            }

            .bib-code {
                height: 70px;
                width: 200px;
                margin-right: 10px; 
                margin-top: -210px;
                float: right;
            }
        </style>
    </head>
    <body>
        <div class="centralised">
            <div class="top-banner">
                <img src="{{ asset('images/marathon1.png') }}" alt="Marathon">
            </div>
            
            <div class="bib-number">
                <p>{{$barcode}}</p>
                
            </div>
            <div class="bib-code">
                <p>{!! DNS1D::getBarcodeHTML("$barcode", "C128B"); !!}</p>
            </div>

            <div class="bottom-banner">
                <img src="{{ asset('images/marathon2.png') }}" alt="Marathon">
            </div>
        </div>
    </body>

</html>

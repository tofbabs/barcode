<!doctype html>
<html>
    <head>
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
                <p>{{$data}}</p>
                
            </div>
            <div class="bib-code">
                <p>{!! DNS1D::getBarcodeHTML("$data", "C128B"); !!}</p>
            </div>

            <div class="bottom-banner">
                <img src="{{ asset('images/marathon2.png') }}" alt="Marathon">
            </div>
        </div>
    </body>

</html>

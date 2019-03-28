<!doctype html>
<html>
    <head>
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div style="position:absolute;
            left:40%;
            top: 50%;
            transform: translate(-50%,-50%);">
            <div class="top-banner">
                <img src="images/marathon1.png" alt="Marathon">
                <span style="font-size: 230px;">56875</span>
                <span style="float:right; margin-top: 230px; margin-right: 40px;">{!! DNS1D::getBarcodeHTML("56875", "C128B"); !!}</span>
            </div>
            <div class="bottom-banner">
                <img src="images/marathon2.png" alt="Marathon">
            </div>
        </div>
    </body>

</html>

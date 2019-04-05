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
            text-align: center;
            transform: translate(-50%,-50%);">
    <div class="top-banner">
        <img src="images/marathon1.png" alt="Marathon">
        <span style="font-size: 180px; font-family: Arial, Helvetica, sans-serif">{{$barcode}}</span>
        <span style="margin: 20px 0">{!! DNS1D::getBarcodeHTML("$barcode", "C128B"); !!}</span>
    </div>
    <div class="bottom-banner">
        <img src="images/marathon2.png" alt="Marathon">
    </div>
</div>
</body>

</html>
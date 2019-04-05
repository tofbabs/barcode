<!doctype html>
<html>
<head>
    <!-- Styles -->
    <style>
    </style>
</head>
<body>
<div style="position:absolute;
            left:50%;
            top: 50%;
            text-align: center;
            transform: translate(-50%,-50%);">
    <div class="top-banner">
        <img src="images/marathon1.png" alt="Marathon">
        <strong style="font-size: 200px; font-family: Arial, Helvetica, sans-serif">{{$barcode}}</strong>
        <div style="position: relative; margin: 20px 0; left: 80%">{!! DNS1D::getBarcodeHTML("$barcode", "C128B"); !!}</div>
    </div>
    <div class="bottom-banner">
        <img src="images/marathon2.png" alt="Marathon">
    </div>
</div>
</body>

</html>
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
        <strong style="position: relative; margin-bottom: -20px; font-weight: 600; line-height: 1; font-size: 250px; font-family: Arial, Helvetica, sans-serif">{{$barcode}}</strong>
        <div style="position: relative; margin: 5px 0; left: 80%">{!! DNS1D::getBarcodeHTML("$barcode", "C128B"); !!}</div>
    </div>
    <div class="bottom-banner">
        <img src="images/marathon2.png" alt="Marathon">
    </div>
</div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barcode Scanner</title>
</head>
<body>
    <h1>Barcode scanner</h1>
    
    <p>Scan uw barcode!</p>
    
    <form method="post" action="/barcodes">
        @csrf
        <input type="text" name="barcode">
    </form>
</body>
</html>
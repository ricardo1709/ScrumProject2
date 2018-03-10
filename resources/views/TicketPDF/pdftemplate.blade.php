<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h1 {
            background: #999999;
        }
        img, p, h1{
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h1>Hallo</h1>
    <img src="data:image/png;base64,' . {{ $imgBarcode }} . '" alt="">
    <p>{{ $barcode }}</p>
    <p>{{ $movie->movieTitle. ' in room ' . $room->roomId .' at '. $planning->time }}
</body>
</html>
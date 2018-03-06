<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
        $index = 0;
    @endphp

    @foreach($tickets as $ticket)
        <a href="localhost:8000/ticket/{{ $ticket->ticketId }}/view">ticket {{ ++$index }}</a>
    @endforeach
</body>
</html>
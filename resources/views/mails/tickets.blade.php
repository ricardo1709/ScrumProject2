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
        <a href="http://localhost:8000/ticket/{{ $ticket->ticketId }}/view" type="application/pdf">
            <embed width="100%" height="100%" name="plugin" id="plugin" src="http://localhost:8000/ticket/{{ $ticket->ticketId }}/view" type="application/pdf" internalinstanceid="20">
            ticket {{ ++$index }}
        </a>
    @endforeach
</body>
</html>
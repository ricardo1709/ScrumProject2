@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/style.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Tickets Bestellen</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class="zaalslider">
                        @foreach ($rooms as $room)
                        @if (!empty($seatArray[$room->roomId]))
                        <div class="zaal">
                            <div class="zaalheader">
                                <span onclick="plusDivs(-1)" class="fas fa-chevron-left gc"></span>
                                <h3>Zaal {{ $room->roomId }}</h3>
                                <span onclick="plusDivs(1)" class="fas fa-chevron-right gc"></span>
                            </div>

                            <style>
                            .normalseats{{ $room->roomId }} {
                                display: grid;
                                margin: 0 auto;
                                text-align: center;

                                grid-gap: 1%;

                                grid-template-columns: {{ $seatStrings[$room->roomId] }};
                            }

                            .loverseats{{ $room->roomId }} {
                                display: grid;
                                margin: 0 auto;
                                text-align: center;

                                grid-gap: 1%;

                                grid-template-columns: {{ $loveSeatStrings[$room->roomId] }};
                            }
                        </style>

                        <div class="stoelen">
                            <div class="normalseats{{ $room->roomId }}">
                                @for ($i = 1; $i <= $room->rows; $i++)
                                @for ($i = 1; $i <= $room->seats; $i++)
                                <div class="stoel">
                                    @if ($seatArray[$room->roomId][($i - 1)]->isGereserveerd == 0)
                                    <a onclick="addSeat({{ $seatArray[$room->roomId][($i - 1)]->seatId }}, this)">
                                    @else
                                    <a onclick="Taken()">
                                    @endif
                                        <img src="img/chair.png" alt="Stoel">
                                        <p>
                                            @if ($seatArray[$room->roomId][($i - 1)]->isGereserveerd == 1)
                                            Stoel Bezet
                                            @else
                                            Stoel {{ $seatArray[$room->roomId][($i - 1)]->seatId }}
                                            @endif
                                        </p>
                                    </a>
                                </div>
                                @endfor
                                @endfor
                            </div>

                            <div class="loverseats{{ $room->roomId }}">
                                @for ($i = 1; $i <= $room->loverRow; $i++)
                                @for ($a = 1; $i <= $room->loverSeats; $i++)
                                <div class="lovestoel">
                                    @if ($loveSeatArray[$room->roomId][($i - 1)]->isGereserveerd == 0)
                                    <a onclick="AddLoveSeat({{ $loveSeatArray[$room->roomId][($i - 1)]->seatId }}, this)">
                                    @else
                                    <a onclick="Taken()">
                                    @endif
                                    <img src="img/loveseat.png" alt="LoveSeat Stoel">
                                    @if ($loveSeatArray[$room->roomId][($i - 1)]->isGereserveerd == 1)
                                        <p>Love Seat Bezet</p>
                                    @else
                                        <p>Love Seat {{ $loveSeatArray[$room->roomId][($i - 1)]->seatId }}</p>
                                    @endif
                                    </a>
                                </div>
                                @endfor
                                @endfor
                            </div>
                        </div>
                    </div>   
                    @endif
                    @endforeach
                </div>
            </div>
        </div>



        <div class="card card-default">
            <div class="card-header">Geselecteerde Stoelen</div>

            <div class="card-body">
                <ul id="selected">
            
                </ul>
                <div class="orderbuttons card-header">
                    <a class="btn btn-primary" onclick="Order()">Bestellen</a>
                    <span id="paylocation">{{route('pay')}}</span>
                    <a class="btn btn-danger" onclick="Clear()">Wissen</a>
                </div>

            </div>
        </div>

    </div>
</div>
</div>
<script src="js/slider.js"></script>
<script src="js/orderseat.js"></script>
@endsection

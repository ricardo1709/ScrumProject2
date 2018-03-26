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

                    <div class="acceptchairs">
                        <p>Medewerker heeft de volgende stoelen geselecteerd:</p>
                        <ul>
                            @foreach ($allseats as $seat)
                                <li>Stoel: {{ $seat }}</li>
                            @endforeach
                        </ul>
                    </div>


                
                    <div class="paycontrols">
                        <a class="btn btn-danger" href="{{ route('home') }}">Afbreken</a>
                        <a class="btn btn-primary" href="">Bevestigen &amp; Bestellen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

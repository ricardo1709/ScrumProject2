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

                <p>U heeft betaald voor de stoelen: {{ $allseats }}</p>
                
                    
            </div>
        </div>
    </div>
</div>
</div>
@endsection

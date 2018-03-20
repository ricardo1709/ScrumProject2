@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header"><p>Welkom, {{ $currentUser['name'] }}!</p></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($currentUser['role'] == 3)
                        <p>Klik hier om naar het Admin Dashboard te gaan,</p>
                        <a href="/admin" class="btn btn-primary" role="button">Ga naar Admin Dashboard</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

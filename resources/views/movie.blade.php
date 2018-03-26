@extends('layouts.app')

@section('content')
<div class="banner">
    <div class="container-fluid">
        <div class="row">
            <img src="//placehold.it/1624x500" style="width: 100%;">
        </div>
    </div>
</div>

<div class="movieheading">
    <div class="container">
        
            <div class="movieheader">
                <h2 class="mt-4 mb-4 text-center">{{ $title }}</h2>
                <p class="text-center">{!! nl2br(e($desc)) !!}</p>
            </div>            
        
    </div>
</div>

<div class="reservebutton mt-5 mb-5">
    @if($loggedIn == true)
        <a href="{{ route('order', $id) }}" role="button" class="btn btn-primary btn-lg btn-block">Reserveer</a>
    @else
        <div class="text-center">
            <button type="button" class="btn btn-secondary disabled btn-lg btn-block">Je moet ingelogged zijn om deze film te kunnen reserveren!</button>
        </div>
    @endif
</div>

<div class="moviedescription">
    <div class="container d-flex">
        <div class="cast w-50 mr-5">
            <h3 class="mb-3">Cast</h3>
            <div class="row">
                <div class="col">
                    <img src="http://via.placeholder.com/100x100">
                    <p>Acteur</p>
                </div>
                <div class="col">
                    <img src="http://via.placeholder.com/100x100">
                    <p>Acteur</p>
                </div>
                <div class="col">
                    <img src="http://via.placeholder.com/100x100">
                    <p>Acteur</p>
                </div>
                <div class="col">
                    <img src="http://via.placeholder.com/100x100">
                    <p>Acteur</p>
                </div>
            </div>
        </div>

        <div class="details w-50">
            <h3 class="mb-3">Details</h3>
            <div class="row">
                <div class="col"><p>Genre:</p></div>
                <div class="col"><p>{{ $genre }}</p></div>
            </div>

            <div class="row">
                <div class="col"><p>Filmlengte:</p></div>
                <div class="col"><p>{{ $runtime }}</p></div>
            </div>

            <div class="row">
                <div class="col"><p>Director:</p></div>
                <div class="col"><p>Haal director op</p></div>
            </div>

            <div class="row">
                <div class="col"><p>Schrijvers:</p></div>
                <div class="col"><p>Haal schrijvers op</p></div>
            </div>

            <div class="row">
                <div class="col"><p>Release:</p></div>
                <div class="col"><p>Haal release op</p></div>
            </div>

            <div class="row">
                <div class="col"><p>Budget:</p></div>
                <div class="col"><p>Haal budget op</p></div>
            </div>

            <div class="kijkwijzer mt-3">
                <h4>Kijkwijzers</h4>
                <p>Haal kijkwijzers op</p>
            </div>
        </div>
        
        
    </div>
</div>
@stop

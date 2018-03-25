@extends('layouts.app')

@section('content')
<div id="home" class="container-fluid">

    <div id="filterBar">
        <div id="dateFilter">
            <form action="{{ action('MovieController@index') }}" method="GET">
            @for($i = 0; $i < 14; $i++)
                <div class="dateBtn">
                    <label for="date">{{ $date['day'] }}</label>
                    <input class="dateRadio" id="date" type="radio" name="date" value="{{ $date['day'] }}" @if($dateSelected == $date['day']) checked @else @endif>
                </div>
                <?php
                if($date['day'] > 30){
                    $date['month']++;
                    $date['day'] = 1;
                } else {
                    $date['day']++;
                }
                ?>
            @endfor
            </form>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <form action="{{ action('MovieController@index') }}" method="GET">
                    <label for="genre" class="dropdown-item">All
                        <input type="radio" name="genre" id="genreAll" @if($radioSelected == "All") checked @endif>
                    </label>

                    @foreach($movieGenres as $movieGenre)
                    <label for="{{ $movieGenre }}" class="dropdown-item">
                            {{ $movieGenre }}
                            <input type="radio" id="{{ $movieGenre }}" name="genre" value="{{ $movieGenre }}" @if($radioSelected == $movieGenre) checked @endif>
                    </label>
                    @endforeach
                </form>
            </div>
        </div>

    </div>

    <div id="movies" style="display: flex; flex-wrap: wrap;">
        @foreach($movies as  $movie)
            <div class="movieObject">
                <div>
                    <img onClick="showOverlay({{ $movie->movieId }})" src="{{ $movie->poster }}" alt="Movie Post">
                </div>

                <div onClick="showOverlay({{ $movie->movieId }})" class="movieOverlay" id="movieOverlay{{ $movie->movieId }}">
                    <div class="overlayContent">
                        <h3>{{ $movie->movieTitle }}</h3>
                        <a href="/movies/{{ $movie->movieId }}">Naar de Film</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@stop

@section('page-script')
{{-- This script submits after a radio button gets selected --}}
<script>
    $(document).ready(function() {
        $('input[name=genre]').change(function(){
            $('form').submit();

        });
    });

    $(document).ready(function() {
        $('input[name=date]').change(function(){
            $('form').submit();

        });
    });

    function showOverlay(id) {
        var element = document.getElementById("movieOverlay" + id);

        if(element.style.display == "block") {
            element.style.display = "none";
        } else {
            element.style.display = "block";
        }
    }
</script>
@stop


@extends('layouts.app')

@section('content')
<div id="home" class="">
    <div id="filterBar">
        <div id="dateFilter">
            <form action="{{ action('MovieController@index') }}" method="GET" id="date">
            @for($i = 0; $i < 14; $i++)
                <?php
		            $currentDateString = "%s-%s-%s";
		            $currentDate = sprintf($currentDateString, $date['year'], $date['month'], $date['day']);
                ?>
                <div class="dateBtn">
                    <label for="{{ $date['day'] }}" @if($dateSelected == $currentDate) style="font-weight: bold; color: Orange;" @endif>{{ $date['day'] }}</label>
                    <input class="dateRadio" id="{{ $date['day'] }}" type="radio" name="date" value="{{ $date['year'] }}-{{ $date['month'] }}-{{ $date['day'] }}">
                </div>
                <?php
                    if($date['day'] > 30){
                        $date['month']++;
                        $date['day'] = 1;
                    } else {
                        $date['day']++;
                    } ?>
            @endfor
            </form>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter
            </button>
            <form action="{{ action('MovieController@index') }}" method="GET" id="genre">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    <label for="genreRadio" class="dropdown-item">
                        All
                        <input type="radio" name="genre" id="genreRadio" value="" @if($radioSelected == "All") checked @endif>
                    </label>

                    @foreach($movieGenres as $movieGenre)
                    <label for="{{ $movieGenre }}" class="dropdown-item">
                            {{ $movieGenre }}
                            <input type="radio" id="{{ $movieGenre }}" name="genre" value="{{ $movieGenre }}" @if($radioSelected == $movieGenre) checked @endif>
                    </label>
                    @endforeach
                </div>
            </form>
        </div>

    </div>

    <div id="movies" class="container-fluid">
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
        $('input[name=date]').change(function(){
            $('form[id=date]').submit();

        });
    });

    $(document).ready(function() {
        $('input[name=genre]').change(function(){
            $('form[id=genre]').submit();

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


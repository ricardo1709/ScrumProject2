@include('layouts.app')

<div class="container">
    {{--This part can be used for the LaraFilm Project--}}
    @foreach($movies as  $movie)
        <div class="Movie">
            
            <div>
                <h3><a href="{{ action('MovieController@show', $movie->movieId ) }}">{{$movie->movieTitle}}</a></h3>
                <p>{{$movie->movieDescription}}</p>
                <p>Zaal: {{$movie->roomId}}</p>
                <p>Datum en tijdstip:</p>
                <p>{{$movie->time}}</p>
            </div>
        </div>
    @endforeach
    {{--Ends here!--}}


</div>
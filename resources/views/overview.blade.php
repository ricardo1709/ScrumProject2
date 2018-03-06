@include('layouts.app')

<div class="container">
    {{--This part can be used for the LaraFilm Project--}}
    @foreach($movies as  $movie)
        <div class="Movie">
            <img src="{{$movie->imageSource}}" alt="">
            <div>
                <h3><a href="{{ action('MovieController@show', $movie->movieId ) }}">{{$movie->movieTitle}}</a></h3>
                <p>{{$movie->movieDescription}}</p>
            </div>
        </div>
    @endforeach
    {{--Ends here!--}}
</div>
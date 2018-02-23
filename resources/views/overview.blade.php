@include('layouts.app')

    {{--This part can be used for the LaraFilm Project--}}
    @foreach($movies as  $movie)
        <div class="Movie">
            <img src="{{$movie->imageSource}}" alt="">
            <div>
                <h3>{{$movie->movieTitle}}</h3>
                <p>{{$movie->movieDescription}}</p>
            </div>
        </div>
    @endforeach
    {{--Ends here!--}}


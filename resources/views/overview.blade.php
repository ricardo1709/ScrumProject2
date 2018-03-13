@include('layouts.app')

<div class="container">

    {{-- This is the radiobutton selection part --}}
    <form action="{{ action('MovieController@index') }}" method="GET">
        <label for="genre">All</label>
        <input type="radio" name="genre" value="" @if($radioSelected == "All") checked @endif>
        @foreach($movieGenres as $movieGenre)
            <label for="genre">{{ $movieGenre }}</label>
            <input type="radio" name="genre" value="{{ $movieGenre }}" @if($radioSelected == $movieGenre) checked @endif>
        @endforeach
    </form>



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

{{-- This script submits after a radio button gets selected --}}
<script>
    $('input[name=genre]').change(function(){
        $('form').submit();

    });
</script>
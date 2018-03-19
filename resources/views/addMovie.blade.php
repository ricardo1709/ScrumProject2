@extends('layouts/app')


@section('content')
	<h2> add a new movie</h2>
	<p>Write the title of the movie you want to add.</p>
	<p>If you want to see the suggestions, click out of the box.</p>
	
	<h3 class="error">
		@if ($noMovieError == "invalid movie title")
			Movie doesn't exist!
		@endif
	</h3>
	<form action="{{action('MovieController@store')}}" method="post">
		{{csrf_field()}}
		<label for="movieName">Movie name</label>
		<input id="movieName" type="text" name="movieAdd">
		<input type="submit" name="add" value="Add movie">
	</form>

	<ul id="titles"></ul>

	<script type="text/javascript" src="{{ URL::asset('js/autocomplete.js') }}"></script>

@stop
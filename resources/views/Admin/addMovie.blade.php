@extends('layouts/app')

@section('content')
	<h2> add a new movie</h2>
	<p>Write the title of the movie you want to add.</p>
	
	<form action="{{action('MovieController@store')}}" method="post">
		{{csrf_field()}}
		<label for="movieName">Movie name</label>
		<input id="movieName" type="text" name="movieAdd">
		<input type="submit" name="add" value="Add movie">
	</form>
	

@stop
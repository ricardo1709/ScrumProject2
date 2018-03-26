@extends('layouts.admin')


@section('content')
	<div class="card">
		<div class="card-header">
			<h2>Add a new movie</h2>
		</div>
		<div class="card-body">
			<p>Write the title of the movie you want to add.</p>
			<p>If you want to see the suggestions, click out of the box.</p>
			<p>The suggestions might take a second to load so be patient.</p>

			<h3 class="error">
				@if ($noMovieError == "invalid movie title")
					Movie doesn't exist!
				@endif
			</h3>
			<form action="{{action('MovieController@store')}}" method="post" id="movieAddForm">
				{{csrf_field()}}
				<label for="movieName">Movie name</label>
				<input id="movieName" type="text" name="movieAdd" autocomplete="off">
				<input type="submit" name="add" value="Add movie">
			</form>

			<ul id="titles"></ul>
		</div>
	</div>
@endsection

@section('page-script')
	<script type="text/javascript" src="{{ URL::asset('js/autocomplete.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
@endsection
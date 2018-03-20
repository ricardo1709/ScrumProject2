@extends('layouts.app')

@section('content')

<div class="container">

	<div class="card">
		<div class="card-body text-center planning">
			<h2>Film planning</h2>
			
			<form action="/admin/planning/create" method="POST">
			@csrf
			<input type="number" name="room"/>
			<input type="number" name="movie" />
			<input type="datetime-local" name="time" />
			<input type="submit" />
			</form>
		</div>
	</div>

</div>

@endsection

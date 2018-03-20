@extends('layouts.admin')

@section('content')

<div class="container">

	<div class="card">
		<div class="card-header">
			<h2>Film planning</h2>
		</div>
		<div class="card-body text-center planning">

			
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

@extends('layouts.admin')

@section('content')

<div class="container">

	<div class="card">
		<div class="card-header">
			<h2>Film planning</h2>
		</div>
		<div class="card-body planning">

			<ul>
				<form action="/admin/planning/create" method="POST">
				@csrf
					<li>
						<label for="room">Zaal</label>
						<select name="room" id="">
							@foreach($rooms as $room)
								<option value="{{ $room->roomId }}">{{ $room->roomId }}</option>
							@endforeach
						</select>
					</li>
					<li>
					<label for="movie">Film</label>
						<select name="movie" id="">
							@foreach($movies as $movie)
								<option value="{{ $movie->movieId }}">{{ $movie->movieTitle }} : {{ $movie->speeltijd }}</option>
							@endforeach
						</select>
					</li>

					<select name="time" id="time">
						@foreach($schedule as $date)
							<option value="{{ $date }}">{{ $date }}</option>
						@endforeach
					</select>
					<input type="submit" />
				</form>
			</ul>
		</div>
	</div>

</div>

@endsection

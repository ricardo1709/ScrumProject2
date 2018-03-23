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
						@for($i = 0; $i < 14; $i++)
							<optgroup label="{{ $date['day'] }}-{{ $date['month'] }}-{{ $date['year'] }}">
								<option value="{{ $date['year'] }}-{{ $date['month'] }}-{{ $date['day'] }} 15:00">15:00 - 17:00</option>
								<option value="{{ $date['year'] }}-{{ $date['month'] }}-{{ $date['day'] }} 18:00">18:00 - 20:00</option>
								<option value="{{ $date['year'] }}-{{ $date['month'] }}-{{ $date['day'] }} 20:30">20:30 - 22:00</option>
								<option value="{{ $date['year'] }}-{{ $date['month'] }}-{{ $date['day'] }} 22:30">22:30 - 00:00</option>
							</optgroup>

                            <?php
                            if($date['day'] > 30){
                                $date['month']++;
                                $date['day'] = 1;
                            } else {
                                $date['day']++;
                            }

                            ?>
						@endfor
					</select>
					<input type="submit" />
				</form>
			</ul>
		</div>
	</div>

</div>

@endsection

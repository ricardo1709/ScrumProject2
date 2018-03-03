@include('layouts.app')

<div class="banner">
    <div class="container-fluid">
        <div class="row">
            <img src="//placehold.it/1624x500" class="img-responsive">
        </div>
    </div>
</div>

<div class="moviedescription">
    <div class="container">
        @foreach($results as $result)
            {{ $result->movieTitle }}
        @endforeach
    </div>
</div>
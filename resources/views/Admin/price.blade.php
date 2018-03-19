@extends('layouts.admin')


@section('content')

<br>
<p>De huidige prijs is {{ $currentPrice }} euro</p>

<form action="/price" method="post">
   @csrf
   
    <label for="new_price">Voer uw nieuwe prijs per stoel in: </label>
    <input type="text" name="new_price">
    <input type="submit" value="Prijs updaten">
</form>

@endsection
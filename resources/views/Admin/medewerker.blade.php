@extends('layouts.admin')


@section('content')
<div>
<h3>Medewerkers</h3>

<table>

@foreach($medewerkers as $medewerker)
    <tr>
        <td> {{ $medewerker->name }} </td> 
        <td> <a href="medewerker/{{ $medewerker->id }}/delete">Delete</a> </td>
        
        
    </tr>
@endforeach

</table>
</div>

<div>
   <h3>Medewerker toevoegen</h3>
    <form action="/medewerker" method="post">
       @csrf
       <p><input type="text" name="name" placeholder="Mederwerker naam"></p>
       <p><input type="email" name="email" placeholder="Medewerker email"></p>
       <input type="submit" value="mederwerker toevoegen">
    </form>
</div>

@endsection
@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Datum</th>
      <th scope="col">Tijd</th>
      <th scope="col">Film</th>
      <th scope="col">barcode</th>
    </tr>
  </thead>
  <tbody>
  	@foreach ($totaldata as $data)
    <tr>
      <th scope="row">{{$data['ticket']->ticketId}}</th>
      <td>{{$date->formatLocalized('%A %d %B %Y')}}</td>
      <td>
        {{$begintijd->format('H:i')}}
        -
        {{$eindtijd = $begintijd->addMinutes($addMinutes)->format('H:i')}}
      </td>
      <td>{{$data['movie']->movieTitle}}</td>
      <td>{{$data['ticket']->barcode}}</td>
      <td><a href="#">Cancel</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop
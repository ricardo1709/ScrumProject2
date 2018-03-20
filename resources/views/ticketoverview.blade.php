@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Datum</th>
      <th scope="col">Tijd</th>
      <th scope="col">Film</th>
      <th scope="col">Barcode</th>
    </tr>
  </thead>
  <tbody>
  	@foreach ($totaldata as $data)
    @if ($data['planning']->time > $currentTime)
    <tr>
      <th scope="row">{{$data['ticket']->ticketId}}</th>
      <?php $date = new Carbon($data['planning']->date); ?>
      <td>{{$date->formatLocalized('%A %d %B %Y')}}</td>
      <td>
        <?php $begintijd = new Carbon($data['planning']->time); ?>
        {{$begintijd->format('H:i')}}
        -
        <?php $addMinutes = $data['movie']->speeltijd ?>
        {{$eindtijd = $begintijd->addMinutes($addMinutes)->format('H:i')}}
      </td>
      <td>{{$data['movie']->movieTitle}}</td>
      <td>{{$data['ticket']->barcode}}</td>
      <td><a href="#">Cancel</a></td>
    </tr>

    @endif
    @endforeach
  </tbody>
</table>


<table id="verlopen" class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Verlopen</th>
      <th scope="col">Tijd</th>
      <th scope="col">Film</th>
      <th scope="col">Barcode</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($totaldata as $data)
    @if ($data['planning']->time < $currentTime)
    <tr>
      <th scope="row">{{$data['ticket']->ticketId}}</th>
      <?php $date = new Carbon($data['planning']->date); ?>
      <td>{{$date->formatLocalized('%A %d %B %Y')}}</td>
      <td>
        <?php $begintijd = new Carbon($data['planning']->time); ?>
        {{$begintijd->format('H:i')}}
        -
        <?php $addMinutes = $data['movie']->speeltijd ?>
        {{$eindtijd = $begintijd->addMinutes($addMinutes)->format('H:i')}}
      </td>
      <td>{{$data['movie']->movieTitle}}</td>
      <td>{{$data['ticket']->barcode}}</td>
    </tr>

    @endif
    @endforeach
  </tbody>
</table>

@stop
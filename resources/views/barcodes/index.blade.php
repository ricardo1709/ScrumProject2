@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Barcode scanner</h1>
        </div>
        <div class="card-body">
            <p>Scan uw barcode!</p>
            <form method="post" action="/barcodes">
                @csrf
                <input type="text" name="barcode">
            </form>
        </div>
    </div>
@endsection
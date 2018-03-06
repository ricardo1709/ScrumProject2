@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <form action="localhost:8000/admin/ticket" method="post">
                        <input name="seats[]" type="text">
                        <input name="seats[]" type="text">

                        <input name="movie" type="text">

                        <input type="submit" value="send">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

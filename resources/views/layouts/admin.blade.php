<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LaraFilms</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- JAVASCRIPT -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/ajaxfixer.js"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                LARA<span id="navbar-brand-light">FILMS</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="admin-main">
        <div class="nav-left">
            <h3><a href="/admin">DASHBOARD</a></h3>
            <ul class="list-group list-group-flush">
                <li>
                    <h4>Films</h4>
                </li>
                <li class="@if(strpos($_SERVER['REQUEST_URI'],'movieupdate')) dash-active @endif"><a href="/admin/movieupdate">Toevoegen</a></li>
                <li class="@if(strpos($_SERVER['REQUEST_URI'],'planning/create')) dash-active @endif"><a href="/admin/planning/create">Inplannen</a></li>
                <li class="@if(strpos($_SERVER['REQUEST_URI'],'planning')) dash-active @endif"><a href="/admin/planning">Planning</a></li>
            </ul>
            <ul class="list-group list-group-flush">
                <li>
                    <h4>Zalen</h4>
                </li>
                <li><a href="">Alle zalen</a></li>
                <li><a href="">Zaal wijzigen</a></li>
            </ul>
            <ul class="list-group list-group-flush">
                <li>
                    <h4>Tickets</h4>
                </li>
                <li class="@if(strpos($_SERVER['REQUEST_URI'],'admin/ticket')) dash-active @endif"><a href="/admin/ticket">Overzicht</a></li>
                <li class="@if(strpos($_SERVER['REQUEST_URI'],'admin/bestellen')) dash-active @endif"><a href="/admin/bestellen">Bestellen</a></li>
                <li class="@if(strpos($_SERVER['REQUEST_URI'],'barcodes')) dash-active @endif"><a href="/barcodes">Scannen</a></li>
                <li><a href="">Annuleren</a></li>
            </ul>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="{{ URL::asset('js/app.js') }}"></script>
@yield('page-script')
</body>
</html>

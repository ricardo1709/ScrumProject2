<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LaraFilms</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- JAVASCRIPT -->
    <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>

</head>
<body>

    <div id="app">
        <div class="header">
            <h1>lara<span>film</span></h1>
            <div id="phonenavbar">
                <button id="phonebutton">Homepage</button>
            </div>
            <div class="navbar">
                <div class="navbar-item">
                    <img src="img/house-black-silhouette-without-door.png" alt="Homepage">
                    <a href="/movies">Homepage</a>
                </div>
                <div class="navbar-item">
                    <img src="img/video-camera.png" alt="Movies">
                    <a href="">Movies</a>
                </div>
                <div class="navbar-item">
                    <img src="img/information-button.png" alt="Information">
                    <a href="">information</a>
                </div>
            </div>
            <div class="userbar">
                <div class="userbar-item">
                    @guest
                        <a href="{{ route('login') }}">login</a>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                        <img src="img/man-user.png" alt="userpage">
                    @else
                        <a class="" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <img src="img/man-user.png" alt="userpage">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
        {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">--}}
            {{--<div class="container-fluid">--}}
                {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                    {{--LARA<span id="navbar-brand-light">FILMS</span>--}}
                {{--</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                {{--</button>--}}

                {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav mr-auto">--}}

                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav ml-auto">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@guest--}}
                            {{--<li><a class="nav-link" href="{{ route('login') }}">Login</a></li>--}}
                            {{--<li><a class="nav-link" href="{{ route('register') }}">Register</a></li>--}}
                        {{--@else--}}
                            {{--<li class="nav-item dropdown">--}}
                                {{--<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                {{--</a>--}}
                                {{--<div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
                                    {{----}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--@endguest--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}

        <main class="">
            @yield('content')
        </main>
    </div>

    <div class="footer">
        <navbar class="footer-links">
            <a href="" class="footer-link">Werken bij Larafilm</a>
            <a href="" class="footer-link">Voorwaarden</a>
            <a href="" class="footer-link">FAQ</a>
            <a href="" class="footer-link">Adverteren</a>
        </navbar>
        <div class="footer-socialmedia">
            <a href=""><img src="{{ asset('../img/instagram.png') }}" alt=""></a>
            <a href=""><img src="{{ asset('img/twitter.png') }}" alt=""></a>
            <a href=""><img src="{{ asset('img/facebook.png') }}" alt=""></a>
            <a href=""><img src="{{ asset('img/whatsapp.png') }}" alt=""></a>
            <a href=""><img src="{{ asset('img/youtube.png') }}" alt=""></a>
        </div>
        <button id="totop">Naar Boven</button>
        <p id="copyright">© 2018 <span>Larafilm</span></p>
    </div>

    @yield('page-script')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

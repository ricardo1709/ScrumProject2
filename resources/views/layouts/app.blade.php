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
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>

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
                    <img src="{{ URL::asset('img/house-black-silhouette-without-door.png') }}" alt="Homepage">
                    <a href="/movies">Homepage</a>
                </div>
                <div class="navbar-item">
                    <img src="{{ URL::asset('img/video-camera.png') }}" alt="Movies">
                    <a href="">Movies</a>
                </div>
                <div class="navbar-item">
                    <img src="{{ URL::asset('img/information-button.png') }}" alt="Information">
                    <a href="">information</a>
                </div>
            </div>
            <div class="userbar">
                <div class="userbar-item">
                    @guest
                        <a href="{{ route('login') }}">login</a>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                        <img src="{{ URL::asset('img/man-user.png') }}" alt="userpage">
                    @else
                        <a class="" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <a class="nav-link" href="/home"><img src="{{ URL::asset('img/man-user.png') }}" alt="userpage"></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>

        <main class="">
            <div id="cookieModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Cookies!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <p>Wij gebruiken cookies op deze website, als je zou willen weten waarom cookies bestaan of waarom wij ze gebruiken kan een korte google search je veel informatie bieden.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Accepteer</button>
                  </div>
                </div>
              </div>
            </div>
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

    <!-- Scripts -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('js/app.js') }}"></script>
    @yield('page-script')
</body>
</html>

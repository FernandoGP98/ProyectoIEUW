<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/0de3fe663e.js" crossorigin="anonymous" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/proyecto.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="mt-0 mb-0 navbar navbar-expand-md navbar-light bg-white shadow-sm justify-content-md-center">
            <div class="d-flex order-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand navbar-collapse collapse navbarSupportedContent" href="{{ url('/') }}">
                    <img src="/images/logo.png" alt="" srcset="" width="115px" height="auto">
                </a>
                <form class="form-inline my-2 my-lg-0 mx-1" method="post" action="/busqueda">
                    @csrf
                    <input class="form-control mr-sm-2" style="border-radius: 20px;" id="search-box" name="search" type="search"
                        placeholder="Busca en Atomix" aria-label="Search">
                        <i class="btn fas fa-search"></i>
                </form>
            </div>
            <div class="mt-2 collapse navbar-collapse position-absolute order-1 navbarSupportedContent">
                <!-- Middle Side Of Navbar -->
                <ul class="navbar-nav justify-content-center mx-auto" style="text-align: right">
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="nav-item {{ request()->is('filtro/noticias*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/noticias') }}">NOTICIAS</a>
                    </li>
                    <li class="nav-item {{ request()->is('filtro/reseñas*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/reseñas') }}">RESEÑAS</a>
                    </li>
                    <li class="nav-item {{ request()->is('filtro/nintendo*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/nintendo') }}">NINTENDO</a>
                    </li>
                    <li class="nav-item {{ request()->is('filtro/sony*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/sony') }}">SONY</a>
                    </li>
                    <li class="nav-item {{ request()->is('filtro/xbox*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/xbox') }}">XBOX</a>
                    </li>
                </ul>
            </div>
            <div class="mt-2 navbar-collapse collapse order-2 dual-collapse2">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item mx-0">
                            <a class="mt-lg-5" style="display: inline;" href="{{ url('perfil') }}">
                                <img style="border-radius:50%; float: right;" src="{{Auth::user()->profile_photo_path}}" alt="" width="5%" height="auto">
                            </a>
                        </li>
                        <li style="clear:right;" class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/perfil"> {{ __('Perfil') }}</a>
                                @auth
                                <a class="dropdown-item" href="/redactar/noticia"> {{ __('Redactar noticia') }}</a>
                                <a class="dropdown-item" href="/redactar/reseña"> {{ __('Redactar reseña') }}</a>
                                @endauth
                                <hr>
                                <a id="logoff" class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
    <footer style="background-color:white;" class="page-footer font-small blue pt-4">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">Atomix</h5>
                    <div class="">© 2018 Copyright:
                        <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
                    </div>
                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <div class="mb-3">
                        <h5 class="">Vistanos en</h5>
                        <img class="mr-3" src="/images/facebook.png" width="40px" height="auto" alt="">
                        <img class="mr-3" src="/images/youtube.png" width="40px" height="auto" alt="">
                        <img src="/images/twitter.png" width="40px" height="auto" alt="">
                    </div>
                    <div>Icons made by
                        <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik
                        </a> from
                        <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com
                        </a>
                    </div>

                </div>

            </div>
            <!-- Grid row -->

        </div>

    </footer>
    <!-- Footer -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/redactar.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/b6viljwvwtt7o1eqxe5d2fneiy77vre2xetex4yi6hwl40rb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    @yield('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
          $('.SliderReseñas').slick({
            speed: 1200,
            autoplay:false,
            slidesToShow: 7,
            slidesToScroll: 7,
          });
        });

        $(function() {
            $('.img-carousel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                centerMode: true,
            });
        });
    </script>
    <script>
        tinymce.init({
            selector: '#noticia-contenido',
            height : "480",
        });
    </script>
</body>
</html>

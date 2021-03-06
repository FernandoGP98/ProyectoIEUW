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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                <form class="form-inline my-2 my-lg-0 mx-1" method="post" action="/busqueda" id="form_busqueda">
                    @csrf
                    <input class="form-control mr-sm-2" style="border-radius: 20px;" id="search-box" name="search" type="search"
                        placeholder="Busca en Atomix" aria-label="Search">
                        <i class="submit fas fa-search"></i>
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
                    <li class="nav-item {{ request()->is('filtro/Nintendo*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/Nintendo') }}">NINTENDO</a>
                    </li>
                    <li class="nav-item {{ request()->is('filtro/Sony*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/Sony') }}">SONY</a>
                    </li>
                    <li class="nav-item {{ request()->is('filtro/Xbox*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/filtro/Xbox') }}">XBOX</a>
                    </li>
                </ul>
            </div>
            <div class="mt-2 navbar-collapse collapse order-2 dual-collapse2">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Inicias sesión') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item mx-0">
                            <a class="mt-lg-5" style="display: inline;" href="{{ url('perfil') }}">
                                <img class="navbar-foto" style="float: right;" src="{{Auth::user()->profile_photo_path}}" alt="">
                            </a>
                        </li>
                        <li style="clear:right;" class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/perfil" active> {{ __('Perfil') }}</a>
                                @if (Auth::user()->rol_id<3)
                                <a class="dropdown-item" href="/redactar/noticia"> {{ __('Redactar noticia') }}</a>
                                <a class="dropdown-item" href="/redactar/reseña"> {{ __('Redactar reseña') }}</a>
                                @endif
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

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
    <footer style="background-color:white;" class="page-footer font-small blue pt-4">
        <div class="container-fluid text-center text-md-left">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 mt-md-0 mt-3 mb-3">
                    <h5 class="text-uppercase text-center">Atomix</h5>
                    <div class="text-center">© 2018 Copyright:
                        <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/b6viljwvwtt7o1eqxe5d2fneiy77vre2xetex4yi6hwl40rb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function(){

            $('i.submit').click(function(){
                $('#form_busqueda').submit();
            });

            tinymce.init({
                selector: '#noticia-contenido',
                height : "480",
            });
        });
    </script>
</body>
</html>

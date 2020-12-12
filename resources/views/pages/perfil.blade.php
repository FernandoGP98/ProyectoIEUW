@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-2">
            <div class="imgPerfil mb-lg-4">
                <img class="foto-perfil" src="{{Auth::user()->profile_photo_path}}" alt="" width="100%" height="auto">
            </div>
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-perfil-list" data-toggle="list" href="#list-perfil" role="tab" aria-controls="perfil">Perfil</a>
                @if (Auth::user()->rol_id!=3)
                <a class="list-group-item list-group-item-action" id="list-publicaciones-list" data-toggle="list" href="#list-publicaciones" role="tab" aria-controls="publicaciones">Publicaciones</a>
                @endif
                @if (Auth::user()->rol_id==1)
                <a class="list-group-item list-group-item-action" id="list-autores-list" data-toggle="list" href="#list-autores" role="tab" aria-controls="autores">Registrar autores</a>
                @else
                <form action="/eliminarCuenta" method="post" id="eliminarCuentaForm">
                    @csrf
                    <a class="list-group-item list-group-item-action" id="list-eliminar-list" data-toggle="list" href="#list-eliminar" role="tab" aria-controls="eliminar"
                    onclick="event.preventDefault();
                    document.getElementById('eliminarCuentaForm').submit();">
                        {{ __('Eliminar cuenta') }}
                    </a>
                </form>
                @endif
                <a id="list-sesion-list" class="list-group-item list-group-item-action" href="{{ route('logout') }}" data-toggle="list" role="tab"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Cerrar sesion') }}
                </a>
            </div>
        </div>

        <div class="col-lg-10" style="color: white">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="list-perfil" role="tabpanel" aria-labelledby="list-perfil-list">
                <div class="card login-reg">
                    <div class="card-body">
                        <h1 style="font-family: MetropolisBold">PERFIL</h1>
                        <form id="formPerfil" method="POST" enctype="multipart/form-data" action="/UsuarioUpdate">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid
                                    @enderror" name="name" value="{{Auth::user()->name}}"
                                    autocomplete="name">

                                    <p class="perfilAlert mb-lg-0 mt-lg-2" id="nombreAlert" style="display: none;">nombre mal</p>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electronico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid
                                    @enderror" name="email" value="{{Auth::user()->email}}"
                                    autocomplete="email">

                                    <p class="perfilAlert mb-lg-0 mt-lg-2" id="mailAlert" style="display: none;">correo mal</p>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password')
                                    is-invalid @enderror" name="password" autocomplete="new-password">

                                    <p class="perfilAlert mb-lg-0 mt-lg-2" id="passAlert" style="display: none;">pass mal</p>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Foto de perfil nueva') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="foto" id="imgload"
                                        class="input-multimedia" accept="image/*"
                                        style="width: 70%">

                                    <label for="imgload" class="btn"><i
                                            class="mr-2 fas fa-file-upload"></i>Imagen</label>


                                    <img class="my-lg-3" id="imgshow" style="max-width:256px;" src="\images\user-image.png" alt="" width="80%" height="auto">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="perfilGuardar" type="submit" class="btn">
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade ml-lg-4" id="list-publicaciones" role="tabpanel" aria-labelledby="list-publicaciones-list">
                @if (Auth::user()->rol_id ==1)
                    <div class="row"><h1 style="font-family: MetropolisBold" >Publicaciones</h1></div>
                    <div class="row">
                        <h3 style="font-family: MetropolisBold" >Pendientes de autores </h3>
                        <div class="col-lg-12 misPublicaciones" id="pendientes">
                        @foreach ($pendientes as $post)
                            <div>
                                <div class="reseña-item">
                                    <a class="aPublicar" href="{{$post->id}}">
                                        @if (!$post->noticia_reseña)
                                            <img class="reseña-badge" width="60px" height="auto" src="\images\BADGES.png">
                                        @endif
                                        <img class="reseña-imagen" width="186px" height="270px" src="{{$post->imagen}}" alt="" srcset="">
                                        <div class="overlay">
                                            <div class="text">Publicar</div>
                                        </div>
                                        <input type="text" name="es" value="{{$post->noticia_reseña}}" hidden>
                                    </a>
                                </div>
                                <p>{{$post->titulo}}</p>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @endif
                <div class="row"><h1 style="font-family: MetropolisBold" >Mis publicaciones</h1></div>
                <div class="row">
                    <h3 style="font-family: MetropolisBold" >Por publicar</h3>
                    <div class="col-lg-12 misPublicaciones">
                    @foreach ($pp as $post)
                        <div>
                            <div class="reseña-item">
                                <a href="{{url('editar/publicacion/'.$post->id)}}">
                                    @if (!$post->noticia_reseña)
                                        <img class="reseña-badge" width="60px" height="auto" src="\images\BADGES.png">
                                    @endif
                                    <img class="reseña-imagen" width="186px" height="270px" src="{{$post->imagen}}" alt="" srcset="">
                                    <div class="overlay">
                                        <div class="text">Editar</div>
                                    </div>
                                </a>
                            </div>
                            <p>{{$post->titulo}}</p>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="row">
                    <h3 style="font-family: MetropolisBold" >Mis noticias</h3>
                    <div class="col-lg-12 misPublicaciones" id="noticias">
                        @foreach ($noticias as $post)
                            <div>
                                <div class="reseña-item">
                                    <a href="{{url('editar/publicacion/'.$post->id)}}">
                                        @if (!$post->noticia_reseña)
                                            <img class="reseña-badge" width="60px" height="auto" src="\images\BADGES.png">
                                        @endif
                                        <img class="reseña-imagen" width="186px" height="270px" src="{{$post->imagen}}" alt="" srcset="">
                                        <div class="overlay">
                                            <div class="text">Editar</div>
                                        </div>
                                    </a>
                                </div>
                                <p>{{$post->titulo}}</p>
                            </div>
                        @endforeach
                        </div>
                </div>
                <div class="row">
                    <h3 style="font-family: MetropolisBold" >Mis reseñas</h3>
                    <div class="col-lg-12 misPublicaciones" id="reseñas">
                        @foreach ($reseñas as $post)
                            <div>
                                <div class="reseña-item">
                                    <a href="{{url('detalle/publicacion/'.$post->id)}}">
                                        @if (!$post->noticia_reseña)
                                            <img class="reseña-badge" width="60px" height="auto" src="\images\BADGES.png">
                                        @endif
                                        <img class="reseña-imagen" width="186px" height="270px" src="{{$post->imagen}}" alt="" srcset="">
                                        <div class="overlay">
                                            <div class="text">Editar</div>
                                        </div>
                                    </a>
                                </div>
                                <p>{{$post->titulo}}</p>
                            </div>
                        @endforeach
                        </div>
                </div>
              </div>

              <div class="tab-pane fade" id="list-autores" role="tabpanel" aria-labelledby="list-autores-list">
                <div class="card login-reg my-4">
                    <div class="card-header">{{ __('Registrar autores') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/AutorRegistrar" id="formAutor">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nameAutor" type="text" class="form-control @error('name') is-invalid @enderror" name="nameAutor" value="{{ old('name') }}" autocomplete="name" autofocus>

                                    <p class="perfilAlert mb-lg-0 mt-lg-2" id="nombreAlertAutor" style="display: none;">nombre mal</p>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electronico') }}</label>

                                <div class="col-md-6">
                                    <input id="emailAutor" type="email" class="form-control @error('email') is-invalid @enderror" name="emailAutor" value="{{ old('email') }}" autocomplete="email">
                                    <p class="perfilAlert mb-lg-0 mt-lg-2" id="emailAlertAutor" style="display: none;">nombre mal</p>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="passwordAutor" type="password" class="form-control @error('password') is-invalid @enderror" name="passwordAutor" autocomplete="new-password">
                                    <p class="perfilAlert mb-lg-0 mt-lg-2" id="passAlertAutor" style="display: none;">nombre mal</p>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirmAutor" type="password" class="form-control" name="password_confirmationAutor" autocomplete="new-password">
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="submitAutor" type="submit" class="btn">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/perfil.js"></script>
@if (!empty(Session::get('toastr')))
    <script>
        $(document).ready(function(){
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
            toastr.success('Perfil actualizado');
        });

    </script>
@endif
@endsection

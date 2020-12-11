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
                <a class="list-group-item list-group-item-action" id="list-publicaciones-list" data-toggle="list" href="#list-publicaciones" role="tab" aria-controls="publicaciones">Publicaciones</a>
                @if (Auth::user()->rol_id==1)
                <a class="list-group-item list-group-item-action" id="list-autores-list" data-toggle="list" href="#list-autores" role="tab" aria-controls="autores">Registrar autores</a>
                @else
                <a class="list-group-item list-group-item-action" id="list-eliminar-list" data-toggle="list" href="#list-eliminar" role="tab" aria-controls="eliminar">Eliminar cuenta</a>
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
                <div class="card login-reg">
                    <div class="card-header">{{ __('Registrar autores') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn">
                                        {{ __('Guardar') }}
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
<script>
    $(document).ready(function(){

        var jq = jQuery.noConflict();
        function pendientesInit() {
            jq('#pendientes').slick({
                speed: 1200,
                autoplay:false,
                slidesToShow: 4,
                slidesToScroll: 4,
            });
        }
        function pendientesDestroy() {
            if ($('#pendientes').hasClass('slick-initialized')) {
                jq('#pendientes').slick('destroy');
            }
        }
        function slickCarousel() {
            jq('.misPublicaciones').slick({
                speed: 1200,
                autoplay:false,
                slidesToShow: 4,
                slidesToScroll: 4,
            });
        }
        function destroyCarousel() {
            if ($('.misPublicaciones').hasClass('slick-initialized')) {
                jq('.misPublicaciones').slick('unslick');
            }
        }

        $('.aPublicar').click(function(e){
            e.preventDefault();
            var i = $(this).parent().parent().attr("data-slick-index");
            var element = $(this).parent().parent();
            /*var source = element.find('img.reseña-imagen').attr('src')
            alert(source);
            var titulo = element.parent().parent().find('p').text();
            alert(titulo);
            var es = element.find('input[type="text"]').val();
            alert(es);*/
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let postId = $(this).attr("href");
            let path = "/noticia/"+postId+"/edit";
            $.ajax({
                url:path,
                type:"GET",
                data:{
                    _token:_token,
                    id:postId
                },
                success:function(response){
                    if(response){
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
                        toastr.success('Publicacion publicada');
                    }
                    animateRemove(element, i);
                }
            });
        });

        function animateRemove(el, i) {
            el.animate({height: '0px', width: '0px'}, 800, function(){
                jq('#pendientes').slick('slickRemove', i);
                pendientesDestroy()
                pendientesInit()
            });
        }

        $('a[data-toggle="list"]').on('shown.bs.tab', function(e) {
            var s = jq($(this).attr('href')).find('.misPublicaciones');
            s.slick({
                speed: 1200,
                autoplay:false,
                slidesToShow: 4,
                slidesToScroll: 4,
            })
        });

        $("#imgload").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgshow').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#perfilGuardar').click(function(e){
            e.preventDefault();
            var nombre = $("[name='name']").val();
            var valid=true;
            if(nombre==""){
                valid = false;
                $("#nombreAlert").text("Ingrese un nombre porfavor");
                $("#nombreAlert").show();
            }
            var email = $("[name='email']").val();
            if(email==""){
                valid = false;
                $("#mailAlert").text("Ingrese un correo porfavor");
                $("#mailAlert").show();
            }else if(!email.includes("@")){
                valid = false;
                $("#mailAlert").text("Ingrese un correo valido porfavor");
                $("#mailAlert").show();
            }
            var passv1 = $("[name='password']").val();
            var passv2 = $("[name='password_confirmation']").val();
            var upperCase= new RegExp('[A-Z]');
            var lowerCase= new RegExp('[a-z]');
            var passSize=passv1.length;
            if(passv1!=""){
                if(passv2==""){
                    valid = false;
                    $("#passAlert").text("Ingrese ambas contraseñas");
                    $("#passAlert").show();
                }else if(passv1.match(upperCase) && passv1.match(lowerCase) && passSize>=8){
                    if(passv1!=passv2){
                        valid = false;
                        $("#passAlert").text("Las contraseñas no coinciden");
                        $("#passAlert").show();
                    }
                }else{
                    valid = false;
                    $("#passAlert").html("La contraseña debe tener mayusculas, minusculas y tener como minimo 8 digitos");
                    $("#passAlert").show();
                }
            }

            if(valid){
                $('#formPerfil').submit();
            }
        });
    });
</script>
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

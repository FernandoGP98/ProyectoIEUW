@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 text-center">
            <h1 class="titulo-seccion text-left">{{$noticia->titulo}}</h1>
        </div>
    </div>
    <div class="row d-flex justify-content-center mb-lg-4">
        <div class="col-lg-10 px-lg-4 pb-4" style="background-color: white">
            <div class="card-autorFecha my-lg-4">
                <span style="background-color: #cccccc;" class="card-autor">Por <a href="/autor" title="Autor">{{$autor}}</a></span>
                <span style="background-color: #cccccc;" class="card-comentarios"> {{$cComentario." comentarios"}} </span>
                <span style="color: #cccccc;" class="card-fecha">{{$noticia->fecha}}</span>
            </div>
            <div class="img-carousel">
                @foreach ($imagenes as $imagen)
                    <div>
                        <img class="img-slide" src="{{$imagen->imagen}}" alt="" srcset="" width="100%">
                    </div>
                @endforeach
            </div>
            <div class="detalle-contenido my-lg-4">
                <?= $noticia->contenido ?>
            </div>
            <div >
                <h2 style="display:inline; font-family: MetropolisBold;">Seccion: </h2>
                <a href="{{url('/filtro/'.$categoria->titulo)}}"><h4 style="display:inline;"><span class="categoria">{{$categoria->titulo}}</span></h4></a>
            </div>
            @auth
            <div class="like">
            <h1 id="conteo" style="display:inline; font-family: MetropolisBold;">{{$conteo}}</h1>
                <form style="display: {{$hasLike ? 'inline' : 'none'}} " action="/like/{{$noticia->id}}" method="post" id="likeSi">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="conteoLikeSi" value="{{$conteo}}">
                    <input type="hidden" name="noticiaLikeSi" value="{{$noticia->id}}">
                    <input type="hidden" name="usuarioLikeSi" value="{{Auth::user()->id}}">
                    <button id="btnLikeSi" class="btn pb-lg-4" type="submit"><i class="fas fa-thumbs-up fa-3x" like="1"></i></button>
                </form>
                <form style="display: {{$hasLike ? 'none' : 'inline'}} " action="/like" method="post" id="likeNo">
                    @csrf
                    <input type="hidden" name="conteoLikeNo" value="{{$conteo}}">
                    <input type="hidden" name="noticiaLikeNo" value="{{$noticia->id}}">
                    <input type="hidden" name="usuarioLikeNo" value="{{Auth::user()->id}}">
                    <button id="btnLikeNo" class="btn pb-lg-4" type="submit"><i class="far fa-thumbs-up fa-3x"></i></i></button>
                </form>
            </div>
            @endauth

            @guest
            <a href="{{ route('login') }}"><h3>Inicia sesion para dejar tu like y unirte a los comentarios</h3></a>
            @endguest

            <div class="my-lg-5 px-lg-5">
                <div class="row mb-lg-4">
                    <div class="col-lg-12">
                        <h4>Comentarios</h4>
                    </div>
                </div>
                @auth
                <form action="/comentar" method="post">
                    <div class="row align-items-center h-100">

                        <div class="col-lg-1">
                            <img style="border-radius:10%;" src="{{Auth::user()->profile_photo_path}}" alt="" width="100%" height="auto">
                            <input type="text" name="idUsuario" id="idUsuario" value="{{Auth::user()->id}}" hidden>
                            <input type="text" name="nameUsuario" id="nameUsuario" value="{{Auth::user()->name}}" hidden>
                            <input type="text" name="imgUsuario" id="imgUsuario" value="{{Auth::user()->profile_photo_path}}" hidden>
                            <input type="text" name="idPost" id="idPost" value="{{$noticia->id}}" hidden>
                        </div>

                        <div class="col-lg-10">
                            <input class="w-100 form-control-lg" type="text" name="comentario" id="comentario" placeholder="Unete a la discusion...">
                        </div>
                        <div class="col-lg-1 ">
                            <button class="btn px-lg-0" type="submit" id="comentar"><i class="fas fa-comment-dots fa-3x"></i></button>
                        </div>
                    </div>
                </form>
                @endauth

                <div id="coment-container">
                    @foreach ($comentarios as $coment)
                        <div class="row  my-lg-4 p-lg-3 comentario">
                            <div class="col-lg-1">
                                <img style="border-radius:10%;" src="{{$coment->profile_photo_path}}" alt="" width="100%" height="auto">
                            </div>
                            <div class="col-lg-11">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{$coment->name}}
                                        <p style="display: inline-block"> - {{$coment->created_at}}</p>
                                    </div>

                                </div>
                                <div>
                                    {{$coment->texto}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $('#comentar').click(function(e){
            e.preventDefault();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let comentario = $("input[name=comentario]").val();
            let usuario = $("input[name=idUsuario]").val();
            let nombre = $("input[name=nameUsuario]").val();
            let foto = $("input[name=imgUsuario]").val();
            let post = $("input[name=idPost]").val();

            $.ajax({
                url:"/comentar",
                type:"POST",
                data:{
                    comentario:comentario,
                    usuario:usuario,
                    post:post,
                    _token:_token
                },
                success:function(response){
                    var div ='<div class="row  my-lg-4 p-lg-3 comentario">'+
                            '<div class="col-lg-1">'+
                                '<img style="border-radius:10%;" src="'+foto+'" alt="" width="100%" height="auto">'+
                            '</div>'+
                            '<div class="col-lg-11">'+
                                '<div class="row">'+
                                    '<div class="col-lg-12">'+
                                        nombre+
                                        '<p style="display: inline-block"> - Fechas</p>'+
                                    '</div>'+
                                '</div>'+
                                '<div>'+
                                    comentario+
                                '</div>'+
                            '</div>'
                    //$("#coment-container").prepend(div).fadeIn('slow');
                    $("input[name=comentario]").val("");
                    $(div).prependTo('#coment-container').hide().fadeIn(1000);
                },
            });
        });

        $('#btnLikeSi').click(function(e){
            e.preventDefault();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let usuario = $("input[name=usuarioLikeSi]").val();
            let post = $("input[name=noticiaLikeSi]").val();
            let conteo = $("#conteo").text();
            $.ajax({
                url:"/like/"+post,
                type:"DELETE",
                data:{
                    _token:_token,
                    usuario:usuario,
                    post:post,
                    conteo:conteo
                },
                success:function(response){
                    $('#likeSi').hide();
                    $('#likeNo').css('display', 'inline');
                    conteo=parseInt(conteo)-1;
                    $("#conteo").text(conteo.toString());
                }
            });
        });

        $('#btnLikeNo').click(function(e){
            e.preventDefault();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let usuario = $('input[name="usuarioLikeNo"]').val();
            let post = $('input[name="noticiaLikeNo"]').val();
            let conteo = $("#conteo").text();
            $.ajax({
                url:"/like",
                type:"POST",
                data:{
                    _token:_token,
                    usuario:usuario,
                    post:post,
                    conteo:conteo
                },
                success:function(response){
                    $('#likeNo').hide();
                    $('#likeSi').css('display', 'inline');
                    conteo=parseInt(conteo)+1;
                    $("#conteo").text(conteo.toString());
                }
            });
        });
    });

</script>
@endsection

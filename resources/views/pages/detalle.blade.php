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
                <span style="background-color: #cccccc;" class="card-comentarios"> 0 comentarios</span>
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


            @auth
            <form action="moverLike" method="post" id="formLike">
                <input type="hidden" name="opcion" value="1">
                <input type="hidden" name="noticia" value="">
                <input type="hidden" name="usuario" value="">
                <i class="far fa-thumbs-up"></i>
                <!--<img class="like submit" id="moverLike" src="resources/image/Like_gray.png" width="50px" height="50px" like="0" alt="">-->
            </form>
            <form action="moverLike" method="post" id="formLike">
                <input type="hidden" name="opcion" value="2">
                <input type="hidden" name="noticia" value="">
                <input type="hidden" name="usuario" value="">
                <i class="submit fas fa-thumbs-up" like="1"></i>
                <!--<img class="like submit" id="moverLike" src="resources/image/Like_blue.png" width="50px" height="50px"  alt="">-->
            </form>
            @endauth

            <div class="my-lg-5 px-lg-5">
                <div class="row mb-lg-4">
                    <div class="col-lg-12">
                        <h4>Comentarios</h4>
                    </div>
                </div>
                @auth
                <form action="" method="post">
                    <div class="row align-items-center h-100">

                        <div class="col-lg-1">
                            <img style="border-radius:10%;" src="{{Auth::user()->profile_photo_path}}" alt="" width="100%" height="auto">
                        </div>

                        <div class="col-lg-10">
                            <input class="w-100 form-control-lg" type="text" name="" id="" placeholder="Unete a la discusion...">
                        </div>
                        <div class="col-lg-1 ">
                            <button class="btn px-lg-0" type="submit"><i class="fas fa-comment-dots fa-3x"></i></button>
                        </div>
                    </div>
                </form>
                @endauth
                @for ($i = 0; $i < 5; $i++)
                    <div class="row  my-lg-4">
                        <div class="col-lg-1">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="col-lg-11">
                            <div class="row">
                                <div class="col-lg-12">
                                    Nombre de usuario
                                    <p style="display: inline-block"> - Fechas</p>
                                </div>

                            </div>
                            <div>
                                Su comentario chido
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection

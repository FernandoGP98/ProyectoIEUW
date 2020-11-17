@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 text-center">
            <h1 class="titulo-seccion text-left">SURGEN MÁS JUEGOS DE PS4 QUE NO SON COMPATIBLES CON PS5</h1>
        </div>
    </div>
    <div class="row d-flex justify-content-center mb-lg-4">
        <div class="col-lg-10 px-lg-4 pb-4" style="background-color: white">
            <div class="card-autorFecha my-lg-4">
                <span style="background-color: #cccccc;" class="card-autor">Por <a href="/autor" title="Autor">Autor perron</a></span>
                <span style="background-color: #cccccc;" class="card-comentarios"> 0 comentarios</span>
                <span style="color: #cccccc;" class="card-fecha">3/11/2020 7:52 PM</span>
            </div>
            <img src="https://cdn.atomix.vg/wp-content/uploads/2020/11/ps5-ps4-.jpg" alt="" srcset="" width="100%">
            <div class="detalle-contenido my-lg-4">

                    Hace tiempo, Sony compartió una pequeña lista de juegos de PS4 que no son compatibles en PS5. Ahora, gracias a que la nueva consola ya está en el mercado, varias personas han tenido el tiempo necesario para explorar la retrocompatibilidad del hardware. De esta forma, se han descubierto más títulos de PS4 que, al parecer, no se pueden disfrutar en el PS5.

                    De acuerdo con This Gen Gaming, en total hay cinco juegos más que, al momento de intentar iniciar desde un PS5, aparece el siguiente mensaje: “Disponible: solo PS4”. Actualmente se desconoce por qué los siguientes títulos no se incluyeron en la lista original publicada por Sony.

                    Estos son los juegos:

                    -Pool Nation

                    -Tower of Time

                    -The Gardens Between

                    -YIIK: A Postmodern RPG

                    -Golem

                    De igual forma, This Gen Gaming menciona que PixelBOT EXTREME! presentaba el mismo mensaje de error, pero recientemente recibió un parche que lo hace accesible a todos los usuarios del PS5. De esta forma, es posible que los cinco títulos previamente mencionados reciban un tratamiento similar, aunque por el momento no hay información oficial.

            </div>
            <iframe width="100%" height="480" src="https://www.youtube.com/embed/RkC0l4iekYo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

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

            <div class="my-lg-5 px-lg-5">
                <div class="row mb-lg-4">
                    <div class="col-lg-12">
                        <h4>Comentarios</h4>
                    </div>
                </div>
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

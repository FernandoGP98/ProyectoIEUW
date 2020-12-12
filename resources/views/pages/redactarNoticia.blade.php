@extends('layouts.app')
@section('content')
<div class="container c-detalle">
    <div class="row d-flex justify-content-center mb-lg-4">
        <div class="col-lg-10  py-lg-3 px-lg-4 pb-4" style="background-color: white">
            <form action="/noticia" method="post" enctype="multipart/form-data" id="redactarNoticia">
                @csrf
                <div class="noticia-titulo">
                    <label for="titulo"><h1>Titulo</h1></label>
                    <input style="text-transform: uppercase;" class="w-100 form-control" type="text" name="titulo" id="titulo">
                    <p class="perfilAlert mb-lg-0 mt-lg-2 ml-lg-3" id="tituloAlert" style="display: none;">nombre mal</p>
                </div>

                <div class="noticia-descripcion">
                    <label for="descripcion"><h1>Descripcion</h1></label>
                    <textarea class="form-control w-100" name="descripcion" id="descripcion"
                    cols="30" rows="5" maxlength="255"></textarea>
                    <p id="Crestantes">255</p>
                    <p class="perfilAlert mb-lg-0 mt-lg-2 ml-lg-3" id="descripcionAlert" style="display: none;">nombre mal</p>
                </div>

                <div class="noticia-categoria">
                    <label for="descripcion"><h1>Categoria</h1></label>
                    <select name="categoria" id="categoria" class="form-control">

                        <option class="dropdown-item" value="1">Nintendo</option>
                        <option class="dropdown-item" value="2">Sony</option>
                        <option class="dropdown-item" value="3">Xbox</option>

                    </select>
                </div>
                @if (!$esReseña)
                    <div class="noticia-fecha">
                        <label for="pFecha"><h1>Fecha de acontecimiento</h1></label>
                        <input class="form-control" style="display:block; width:100%;" type="date" name="fecha"
                            id="pFecha" value="null">
                    </div>
                @endif

                <div class="detalle-contenido my-lg-4">
                    <label for="noticia-contenido"><h1>Contenido</h1></label>
                    <textarea class="form-control" name="noticia_contenido" id="noticia-contenido"></textarea>
                    <p class="perfilAlert mb-lg-0 mt-lg-2 ml-lg-3" id="contenidoAlert" style="display: none;">nombre mal</p>
                </div>

                <div class="contenedor-imagenes" style="width: 100%;">
                    <label for="multimedia"><h1>Imagenes</h1></label>
                    <p class="perfilAlert mb-lg-0 mt-lg-2 ml-lg-3" id="imagenAlert" style="display: none;">nombre mal</p>
                    <input type="file" name="fileImagenes[]" id="multimedia"
                        class="input-multimedia" accept="image/*"
                        style="width: 70%" multiple>

                    <label id="img_input" for="multimedia" class="btn"><i
                            class="mr-2 fas fa-file-upload"></i>Imagenes</label>

                    <div class="img-carousel">

                    </div>
                </div>

                <div id="imagenes-input" hidden>
                    <small>Esto va HIDDEN al final, lo dejo por ahora, para asegurarme de que funciona</small>
                    <br>
                    Imagenes: <span id="contador">###</span>
                    <br>
                </div>

                <div>
                    <label for="multimedia-v"><h1>Video</h1></label>
                    <p class="perfilAlert mb-lg-0 mt-lg-2 ml-lg-3" id="videoAlert" style="display: none;">nombre mal</p>
                    <input type="file" name="video" id="multimedia-v"
                        class="input-multimedia" accept="video/*"
                        style="width: 70%">
                    <label id="video_input" for="multimedia-v" class="btn">
                        <i class="mr-2 fas fa-file-upload"></i>
                        Video
                    </label>
                    <video width="100%" height="512px" controls>
                        <source src="" id="video_here">
                            Your browser does not support HTML5 video.
                    </video>
                </div>

                <input type="text" value="{{Auth::user()->id}}" name="autor" hidden>
                @if ($esReseña)
                <input type="text" value="0" name="esNoticia" hidden>
                @else
                <input type="text" value="1" name="esNoticia" hidden>
                @endif
                <div class="text-center ">
                    <input class="mb-2 btn btn-submit" type="submit" value="Guardar" id="guardarNota">
                    <!--<input class="mb-2 btn btn-submit" type="submit" value="Guardar" id="guardarNota">-->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/redactar.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('.img-carousel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                centerMode: true,
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
            toastr.success('Publicacion guardada, revise su perfil');
        });

    </script>
    @endif
@endsection


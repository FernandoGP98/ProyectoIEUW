@extends('layouts.app')
@section('content')

<div class="row no-gutters mb-4 reseñas-contenedor">
    <h1 class="container">Reseñas</h1>
    <div class="col-md-12 pt-0 SliderReseñas">
        @foreach ($reseñas as $res)
            <div>
                <div class="reseña-item">
                <a href="{{url('detalle/reseña/'.$res->id)}}">
                    <img class="reseña-badge" width="60px" height="auto" src="\images\BADGES.png">
                    <img class="reseña-imagen" width="186px" height="270px" src="{{$res->imagen}}" alt="" srcset="">
                </a>
                </div>
                <p>{{$res->titulo}}</p>
            </div>
        @endforeach
    </div>
</div>

<div class="row no-gutters">
    <h1 class="container" >Noticias</h1>
</div>
<div class="row no-gutters d-flex justify-content-center">

    <div class="col-md-9">
        @foreach ($noticias as $item)
        <div class="card">

            <a class="link_post" href="{{url('/detalle/noticia/'.$item->id)}}">
                <img id class="imgPost card-img-top" src="{{$item->imagen}}" alt="Card image cap">
            </a>
            <div class="card-body">
                <div class="gradient">
                    <h1><a class="card-titulo" title="Lee: Titulo bien perron" href="{{url('/detalle/noticia/'.$item->id)}}">{{$item->titulo}}</a></h1>
                    <div class="card-autorFecha">
                        <span class="card-autor">Por <a href="/autor" title="Autor">{{$item->autor}}</a></span>
                        @foreach ($countC as $count)
                            @if ($count->id==$item->id)
                                <span class="card-comentarios"> {{$count->Total}} comentarios</span>
                            @endif
                        @endforeach
                        <a href="{{url('/filtro/'.$item->categoria)}}"><span class="categoria">{{$item->categoria}}</span></a>
                        <span class="card-fecha">{{$item->fecha}}</span>
                    </div>
                    <p class="card-text">
                        {{$item->descripcion}}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $( function() {
            var availableTags= [
            "Review"
            ];
            //alert({{$tags}});
            var noticias =JSON.parse('{{$tags}}'.replace(/&quot;/g, '"'));
            for (let index = 0; index < Object.keys(noticias).length; index++) {
                availableTags.push(noticias[index].titulo);
            }
            $( "#search-box" ).autocomplete({
            source: availableTags
            });
        });

        $('.SliderReseñas').slick({
            speed: 1200,
            autoplay:false,
            slidesToShow: 7,
            slidesToScroll: 7,
        });
    });
</script>
@endsection

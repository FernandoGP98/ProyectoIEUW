@extends('layouts.app')
@section('content')

<div class="row no-gutters">
    <div class="col-md-12 pt-0 SliderReseñas">

        @for ($i=1; $i <=20 ; $i++)

            <div>
                <a href="{{url('detalle/noticia/'.$i)}}"><img src="https://cdn.atomix.vg/wp-content/uploads/2020/10/Review-Watch-Dogs-Legion-186x278.png" alt="" srcset=""></a>
                <p>Titulo</p>
            </div>

        @endfor
    </div>
</div>

<div class="row no-gutters">
    <div class="col-md-9">
        @foreach ($noticias as $item)
        <div class="card">
            <a href="{{url('/detalle/noticia/'.$item->id)}}">
                <div class="gradient">
                    <img id class="imgPost card-img-top" src="{{$item->imagen}}" alt="Card image cap">
                </div>
            </a>
            <div class="card-body">
                <h1><a class="card-titulo" title="Lee: Titulo bien perron">{{$item->titulo}}</a></h1>
                <div class="card-autorFecha">
                    <span class="card-autor">Por <a href="/autor" title="Autor">{{$item->autor}}</a></span>
                    <span class="card-comentarios"> 0 comentarios</span>
                    <span class="card-fecha">{{$item->fecha}}</span>
                </div>
                    <p class="card-text">
                        {{$item->descripcion}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-3">

    </div>
</div>

@endsection

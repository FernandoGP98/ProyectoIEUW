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

<div class="row no-gutters d-flex justify-content-center">
    <div class="col-md-9">
        @foreach ($noticias as $item)
        <div class="card">
            <a href="{{url('/detalle/noticia/'.$item->id)}}">
                <div class="gradient">
                    <img id class="imgPost card-img-top" src="{{$item->imagen}}" alt="Card image cap">
                </div>
            </a>
            <div class="card-body">
                <h1><a class="card-titulo" title="Lee: Titulo bien perron" href="{{url('/detalle/noticia/'.$item->id)}}">{{$item->titulo}}</a></h1>
                <div class="card-autorFecha">
                    <span class="card-autor">Por <a href="/autor" title="Autor">{{$item->autor}}</a></span>
                    @foreach ($countC as $count)
                        @if ($count->id==$item->id)
                            <span class="card-comentarios"> {{$count->Total}} comentarios</span>
                        @endif
                    @endforeach
                    <span class="card-fecha">{{$item->fecha}}</span>
                </div>
                    <p class="card-text">
                        {{$item->descripcion}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

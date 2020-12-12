@extends('layouts.app')
@section('content')
<div class="container">
    @isset($esSearch)
        <div class="row mt-3">
            <div class="col-lg-12">
                <form action="/busquedaAvanzada" method="post" id="busquedaAvanzada">
                    @csrf
                    <div class="row">
                        <div class="col-lg-11">
                            <input class="mr-sm-2 form-control-lg" style="border-radius: 5px; width:100%; height:100%;" id="search-box" name="search" type="search"
                            placeholder="Busca en Atomix" aria-label="Search">
                        </div>
                        <div class="col-lg-1">
                            <i style="color: white" class="submitAvanzado fas fa-search fa-3x"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <h4 class="mb-0 mt-3" style="color: white;">DE:</h4>
                            <input class="form-control" type="date" name="from" id="">
                        </div>
                        <div class="col-lg-6">
                            <h4 class="mb-0 mt-3" style="color: white;">A:</h4>
                            <input class="form-control" type="date" name="to" id="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endisset
    <h1 class="titulo-seccion">{{$header}}</h1>
    <div class="d-flex justify-content-center">
        {!! $noticias->links("pagination::bootstrap-4") !!}
    </div>
    @php
        $i=1;
    @endphp
    @foreach ($noticias as $noticia)
    <div class="card p-3 {{ $i%2 == 1 ? 'card-gris' : '' }}">
        <div class="row mb-4">
            <div class="col-3">
                <a href="{{url('/detalle/noticia/'.$noticia->id)}}">
                    <img id ="imgPost" style="object-fit: cover;" src="{{$noticia->imagen}}"
                    alt="Card image cap" height="100%" width="100%">
                </a>
            </div>
            <div class="col-9">
                <div class="card-body pl-0">
                    <h1><a class="card-titulo" title="Lee: {{$noticia->titulo}}" href="{{url('/detalle/noticia/'.$noticia->id)}}">{{$noticia->titulo}}</a></h1>
                    <div class="card-autorFecha">
                        <span class="card-autor">Por <a href="/autor" title="Autor">{{$noticia->autor}}</a></span>
                        @foreach ($countC as $count)
                            @if ($count->id==$noticia->id)
                                <span class="card-comentarios"> {{$count->Total}} comentarios</span>
                            @endif
                        @endforeach
                        <span class="card-fecha">{{$noticia->fecha}}</span>
                    </div>
                    <p class="card-text">{{$noticia->descripcion}}</p>
                </div>
            </div>
        </div>
    </div>
    @php
        $i++;
    @endphp
    @endforeach
    <div class="d-flex justify-content-center">
        {!! $noticias->links("pagination::bootstrap-4") !!}
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.submitAvanzado').click(function(){
                $('#busquedaAvanzada').submit();
            });
        });
    </script>
@endsection

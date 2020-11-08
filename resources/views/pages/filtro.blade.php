@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="titulo-seccion">Noticias</h1>
    <nav aria-label="Page navigation example">
        <ol class="pagination">
            <li class="page-item"><a class="page-link" href="filtro"><<</a></li>
            @for ($i = 1; $i <= 10; $i++)
                <li class="page-item {{ request()->is('filtro/'.$i) ? 'active' : '' }}"><a class="page-link" href="filtro/{{$i}}">{{$i}}</a></li>
            @endfor
          <li class="page-item"><a class="page-link" href="#">>></a></li>
        </ol>
      </nav>
    @for ($i = 0; $i < 5; $i++)
    <div class="card p-3 {{ $i%2 == 1 ? 'card-gris' : '' }}">
        <div class="row mb-4">
            <div class="col-3">
                <img id ="imgPost" style="object-fit: cover;" src="https://cdn.atomix.vg/wp-content/uploads/2020/11/New-Project-2020-11-03T170620.951.jpg"
                alt="Card image cap" height="100%" width="100%">
            </div>
            <div class="col-9">
                <div class="card-body pl-0">
                    <h1><a class="card-titulo" title="Lee: Titulo bien perron">DAYS GONE TENDRÁ MEJORA GRATUITA PARA PS5</a></h1>
                    <div class="card-autorFecha">
                        <span class="card-autor">Por <a href="/autor" title="Autor">Autor perron</a></span>
                        <span class="card-comentarios"> 0 comentarios</span>
                        <span class="card-fecha">3/11/2020 7:52 PM</span>
                    </div>
                    <p class="card-text">Cada vez son más los desarrolladores que confirman mejoras gratuitas de sus juegos para PlayStation 5, y ahora podemos sumar a Sony Bend a esa lista. El estudio confirmó que su más reciente proyecto, Days Gone, también tendrá una serie de actualizaciones para esta nueva consola y acá te decimos exactamente cuáles son.</p>
                </div>
            </div>
        </div>
    </div>
    @endfor
</div>
@endsection

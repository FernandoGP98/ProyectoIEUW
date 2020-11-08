@extends('layouts.app')
@section('content')

<div class="row no-gutters">
    <div class="col-md-12 pt-0 SliderReseñas">

        @for ($i=0; $i <20 ; $i++)

            <div>
                <img src="https://cdn.atomix.vg/wp-content/uploads/2020/10/Review-Watch-Dogs-Legion-186x278.png" alt="" srcset="">
                <p>Titulo</p>
            </div>

        @endfor
    </div>
</div>
<div class="row no-gutters">
    <div class="col-md-9">
        <div class="card">
            <img id ="imgPost" class="card-img-top" src="https://cdn.atomix.vg/wp-content/uploads/2020/11/New-Project-2020-11-03T170620.951.jpg" alt="Card image cap">
            <div class="card-body">
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
    <div class="col-md-3">

    </div>
</div>

@endsection

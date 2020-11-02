@extends('layouts.app')
@section('content')
<div class="pt-0 SliderReseñas">

    @for ($i=0; $i <20 ; $i++)

        <div>
            <img src="https://cdn.atomix.vg/wp-content/uploads/2020/10/Review-Watch-Dogs-Legion-186x278.png" alt="" srcset="">
            <p>Titulo</p>
        </div>

    @endfor
</div>
@endsection

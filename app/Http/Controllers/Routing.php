<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\post;
use App\Models\imagen;
use App\Models\User;

class Routing extends Controller
{
    public function index(){
        $noticias = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->join('imagens', 'imagens.post_id', '=', 'posts.id')
        ->select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
         'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen');

        $noticias = $noticias->get();

        return view('pages.landing')->with(compact('noticias'));

    }

    public function redactarNoticia(){
        return view('pages.redactarNoticia');
    }

    public function redactarReseña(){
        return view('pages.redactarReseña');
    }

    public function filtro($a, $b=1){
        return view('pages.filtro');
    }

    public function detalle($a, $b){
        $noticia = post::find($b);
        $autor = User::find($noticia->user_id);
        $autor=$autor->name;

        $imagenes = imagen::where('post_id', $b)->get();
        return view('pages.detalle')->with(compact('noticia', 'autor', 'imagenes'));
    }
}

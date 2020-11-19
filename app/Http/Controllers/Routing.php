<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\post;
use App\Models\imagen;
use App\Models\User;
use App\Models\Like;

class Routing extends Controller
{
    public function index(){
        $noticias = DB::table('posts')
        ->select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
         'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->join('imagens', 'imagens.post_id', '=', 'posts.id')->groupBy('posts.id')
        ->get();

        $countC = DB::table('posts')
        ->selectRaw('posts.id,count(posts.id) as Total')
        ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')->groupBy('posts.id')->get();

        return view('pages.landing')->with(compact('noticias', 'countC'));
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

        $hasLike=false;
        $conteo=0;
        if(Auth::check()){
            $hasLike = Like::where('user_id', auth()->user()->id)->where('post_id', $b)->get();
            if ($hasLike->isEmpty()) {
                $hasLike=false;

            }else{
                $hasLike=true;
                $conteo = Like::where('post_id', $b)->count();
            }
        }



        $comentarios = DB::table('comentarios')
        ->select('comentarios.texto', 'comentarios.created_at', 'users.name', 'users.profile_photo_path')
        ->join('users', 'users.id','=', 'comentarios.user_id')
        ->where('comentarios.post_id', $b)
        ->orderByDesc('comentarios.created_at')->get();

        $cComentario = $comentarios->count();

        return view('pages.detalle')->with(compact('noticia', 'autor', 'imagenes', 'comentarios','cComentario', 'hasLike', 'conteo'));
    }
}

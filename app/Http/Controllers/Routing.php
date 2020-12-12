<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;

use App\Models\post;
use App\Models\imagen;
use App\Models\video;
use App\Models\User;
use App\Models\Like;
use App\Models\categoria;

class Routing extends Controller
{
    public function index(){
        $noticias = DB::table('posts')
        ->select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
         'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen', 'categorias.titulo as categoria')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->join('categorias', 'categorias.id', '=', 'posts.categoria_id')
        ->join('imagens', 'imagens.post_id', '=', 'posts.id')->where('posts.noticia_reseña', 1)
        ->where('publicado', 2)->groupBy('posts.id');

        $noticias = $noticias->orderBy('fecha', 'desc')->get();

        $reseñas = DB::table('posts')
        ->select('posts.id as id','posts.titulo as titulo','imagens.imagen as imagen')
        ->join('imagens', 'imagens.post_id', '=', 'posts.id')->where('posts.noticia_reseña', 0)
        ->where('publicado', 2)->groupBy('posts.id')
        ->get();

        $countC = DB::table('posts')
        ->selectRaw('posts.id,count(posts.id) as Total')
        ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')->groupBy('posts.id')->get();

        return view('pages.landing')->with(compact('noticias', 'reseñas', 'countC'));
    }

    public function redactarNoticia(){
        return view('pages.redactarNoticia');
    }
    public function editarPublicacion($a){
        $post=post::find($a);

        $imagenes = imagen::where('post_id', $a)->get();
        $video = video::where('post_id', $a)->get();

        return view('pages.editarPublicacion')->with(compact('post', 'imagenes', 'video'));
    }

    public function redactarReseña(){
        return view('pages.redactarReseña');
    }

    public function perfil(){
        $pp = post::select('posts.id', 'posts.titulo', 'imagens.imagen', 'posts.noticia_reseña')
        ->join('imagens', 'imagens.post_id', '=', 'posts.id')
        ->where('user_id', Auth::user()->id)->where('publicado', 0)->groupBy('posts.id')->get();

        $noticias = post::select('posts.id', 'posts.titulo', 'imagens.imagen', 'posts.noticia_reseña')
        ->join('imagens', 'imagens.post_id', '=', 'posts.id')
        ->where('user_id', Auth::user()->id)->where('publicado', 2)->where('posts.noticia_reseña', 1)->groupBy('posts.id')->get();

        $reseñas = post::select('posts.id', 'posts.titulo', 'imagens.imagen', 'posts.noticia_reseña')
        ->join('imagens', 'imagens.post_id', '=', 'posts.id')
        ->where('user_id', Auth::user()->id)->where('publicado', 2)->where('posts.noticia_reseña', 0)->groupBy('posts.id')->get();

        if (Auth::user()->rol_id==1) {
            $pendientes = post::select('posts.id', 'posts.titulo', 'imagens.imagen', 'posts.noticia_reseña')
            ->join('imagens', 'imagens.post_id', '=', 'posts.id')
            ->where('user_id', Auth::user()->id)->where('publicado', 1)->groupBy('posts.id')->get();

            return view('pages.perfil')->with(compact('pp', 'noticias', 'reseñas', 'pendientes'));
        }

        return view('pages.perfil')->with(compact('pp', 'noticias', 'reseñas'));
    }

    public function filtro($a){
        switch ($a) {
            case 'noticias':
                $noticias = post::
                select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
                 'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('imagens', 'imagens.post_id', '=', 'posts.id')
                ->where('posts.noticia_reseña', 1)->orderBy('posts.fecha')->groupBy('posts.id');

                $noticias=$noticias->paginate(5);

                $countC = DB::table('posts')
                ->selectRaw('posts.id,count(posts.id) as Total')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                ->where('posts.noticia_reseña', 1)
                ->groupBy('posts.id')->get();

                $header="NOTICIAS";

                return view('pages.filtro')->with(compact('noticias', 'countC', 'header'));
                break;
            case 'reseñas':
                $noticias = DB::table('posts')
                ->select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
                 'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('imagens', 'imagens.post_id', '=', 'posts.id')
                ->where('posts.noticia_reseña', 0)->orderBy('posts.fecha')->groupBy('posts.id');

                $noticias=$noticias->paginate(5);

                $header="RESEÑAS";

                $countC = DB::table('posts')
                ->selectRaw('posts.id,count(posts.id) as Total')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                ->where('posts.noticia_reseña', 0)
                ->groupBy('posts.id')->get();

                return view('pages.filtro')->with(compact('noticias', 'countC', 'header'));
                break;
            case 'Nintendo':
                $noticias = DB::table('posts')
                ->select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
                 'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('imagens', 'imagens.post_id', '=', 'posts.id')
                ->where('posts.categoria_id', 1)->orderBy('posts.fecha')->groupBy('posts.id');

                $noticias=$noticias->paginate(5);

                $header="NINTENDO";

                $countC = DB::table('posts')
                ->selectRaw('posts.id,count(posts.id) as Total')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                ->where('posts.noticia_reseña', 0)
                ->groupBy('posts.id')->get();

                return view('pages.filtro')->with(compact('noticias', 'countC', 'header'));
                break;
            case 'Sony':
                $noticias = DB::table('posts')
                ->select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
                 'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('imagens', 'imagens.post_id', '=', 'posts.id')
                ->where('posts.categoria_id', 2)->orderBy('posts.fecha')->groupBy('posts.id');

                $noticias=$noticias->paginate(5);

                $header="SONY";

                $countC = DB::table('posts')
                ->selectRaw('posts.id,count(posts.id) as Total')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                ->where('posts.noticia_reseña', 0)
                ->groupBy('posts.id')->get();

                return view('pages.filtro')->with(compact('noticias', 'countC', 'header'));
                break;
            case 'Xbox':
                $noticias = DB::table('posts')
                ->select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
                 'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('imagens', 'imagens.post_id', '=', 'posts.id')
                ->where('posts.categoria_id', 3)->orderBy('posts.fecha')->groupBy('posts.id');

                $noticias=$noticias->paginate(5);

                $header="XBOX";

                $countC = DB::table('posts')
                ->selectRaw('posts.id,count(posts.id) as Total')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                ->where('posts.noticia_reseña', 2)
                ->groupBy('posts.id')->get();

                return view('pages.filtro')->with(compact('noticias', 'countC', 'header'));
                break;
        }
    }

    public function detalle($a, $b){
        $noticia = post::find($b);
        $autor = User::find($noticia->user_id);
        $autor=$autor->name;

        $categoria = categoria::find($noticia->categoria_id);

        $imagenes = imagen::where('post_id', $b)->get();
        $video = video::where('post_id', $b)->get();

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

        return view('pages.detalle')->with(compact('noticia', 'autor', 'imagenes', 'comentarios',
        'cComentario', 'hasLike', 'conteo', 'categoria', 'video'));
    }

    public function busqueda(Request $request){
        $esSearch=1;
        if($request->search!=""){
            $noticias = post::select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
            'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('imagens', 'imagens.post_id', '=', 'posts.id')
            ->where('publicado', 2)->where('titulo', 'like', '%'.$request->search.'%')
            ->orderBy('posts.fecha')->groupBy('posts.id');
        }else{
            $noticias = post::select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
            'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('imagens', 'imagens.post_id', '=', 'posts.id')
            ->where('publicado', 2)
            ->orderBy('posts.fecha')->groupBy('posts.id');
        }

        $noticias = $noticias->paginate(5);

        $header = "Publicaciones";

        $countC = DB::table('posts')
                ->selectRaw('posts.id,count(posts.id) as Total')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                ->where('posts.publicado', 2)
                ->groupBy('posts.id')->get();
        return view('pages.filtro')->with(compact('noticias', 'header', 'countC', 'esSearch'));
    }

    public function busquedaAvanzada(Request $request){
        $esSearch=1;
        if($request->search!=""){
            if($request->from !="" && $request->to != ""){
                $from = date($request->from);
                $to = date($request->to);
                $noticias = post::select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
                'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('imagens', 'imagens.post_id', '=', 'posts.id')
                ->where('publicado', 2)->where('titulo', 'like', '%'.$request->search.'%')->whereBetween('fecha', [$from, $to])
                ->orderBy('posts.fecha')->groupBy('posts.id');
            }else{
                if($request->from !=""){
                    $noticias = post::select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
                    'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
                    ->join('users', 'users.id', '=', 'posts.user_id')
                    ->join('imagens', 'imagens.post_id', '=', 'posts.id')
                    ->where('publicado', 2)->where('titulo', 'like', '%'.$request->search.'%')->where('fecha', [$from, $to])
                    ->orderBy('posts.fecha')->groupBy('posts.id');
                }
            }
            $noticias = post::select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
            'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('imagens', 'imagens.post_id', '=', 'posts.id')
            ->where('publicado', 2)->where('titulo', 'like', '%'.$request->search.'%')
            ->orderBy('posts.fecha')->groupBy('posts.id');
        }else{
            $noticias = post::select('posts.id as id','posts.titulo as titulo', 'posts.descripcion as descripcion',
            'posts.fecha as fecha', 'users.name as autor','imagens.imagen as imagen')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('imagens', 'imagens.post_id', '=', 'posts.id')
            ->where('publicado', 2)
            ->orderBy('posts.fecha')->groupBy('posts.id');
        }

        $noticias = $noticias->paginate(5);

        $header = "Publicaciones";

        $countC = DB::table('posts')
                ->selectRaw('posts.id,count(posts.id) as Total')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                ->where('posts.publicado', 2)
                ->groupBy('posts.id')->get();
        return view('pages.filtro')->with(compact('noticias', 'header', 'countC', 'esSearch'));
    }
}

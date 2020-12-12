<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\post;
use App\Models\imagen;
use App\Models\comentario;
use App\Models\video;
use App\Models\like;

class noticia extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $nuevaNoticia=new post();
            $nuevaNoticia->titulo=$request->titulo;
            $nuevaNoticia->descripcion=$request->descripcion;
            $nuevaNoticia->categoria_id=$request->categoria;
            $nuevaNoticia->fecha=$request->fecha;
            $nuevaNoticia->contenido=$request->noticia_contenido;
            $nuevaNoticia->user_id=$request->autor;
            $nuevaNoticia->noticia_reseña=$request->esNoticia;
            $nuevaNoticia->publicado=0;
            $nuevaNoticia->save();
            $idPost = $nuevaNoticia->id;


            $i=0;
            if($request->hasFile('imagenes')){
                foreach ($request->file('imagenes') as $imagen) {
                    $img = new imagen;
                    $imgName = time().$i.'.'.$imagen->getClientOriginalExtension();

                    $imagen->move('images/', $imgName);
                    $rute='/images/'.$imgName;
                    $img->imagen=$rute;
                    $img->post_id=$idPost;
                    $img->save();
                    $i++;
                }
            }

            if($request->hasFile('video')){
                $video = $request->file('video');
                $vid = new video;
                $vidName = time().'.'.$video->getClientOriginalExtension();

                $video->move('videos/', $vidName);
                $rute='/videos/'.$vidName;
                $vid->video=$rute;
                $vid->post_id=$idPost;
                $vid->save();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('no', 2);
        }

        return redirect()->back()->with('toastr', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=post::find($id);
        $post->publicado = 2;
        $post->save();
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=post::find($id);
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->contenido = $request->noticia_contenido;
        $post->fecha = $request->fecha;
        $post->publicado = 1;
        $post->categoria_id = $request->categoria;

        if($post->save()){
            if($request->imgE!=""){
                $imgE = explode("|", $request->imgE);
                //return $imgE[0];
                $imagenes = imagen::where('post_id', $id)->get();
                foreach ($imagenes as $item) {
                    for ($i=0; $i < count($imgE); $i++) {
                        if($item->id == $imgE[$i]){
                            $item->delete();
                        }
                    }
                }
            }

            $i=0;
            if($request->hasFile('imagenes')){
                foreach ($request->file('imagenes') as $imagen) {
                    $img = new imagen;
                    $imgName = time().$i.'.'.$imagen->getClientOriginalExtension();

                    $imagen->move('images/', $imgName);
                    $rute='/images/'.$imgName;
                    $img->imagen=$rute;
                    $img->post_id=$post->id;
                    $img->save();
                    $i++;
                }
            }

            if($request->hasFile('video')){
                video::where('post_id', $post->id)->delete();
                $video = $request->file('video');
                $vid = new video;
                $vidName = time().'.'.$video->getClientOriginalExtension();

                $video->move('videos/', $vidName);
                $rute='/videos/'.$vidName;
                $vid->video=$rute;
                $vid->post_id=$post->id;
                $vid->save();
            }
        }

        return redirect()->back()->with('toastr', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        imagen::where('post_id', $id)->delete();
        video::where('post_id', $id)->delete();
        comentario::where('post_id', $id)->delete();
        like::where('post_id', $id)->delete();
        $post = post::find($id);
        $post->delete();
        return redirect('/perfil');
    }
}

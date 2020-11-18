<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\post;
use App\Models\imagen;

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
                $rute='images/'.$imgName;
                $img->imagen=$rute;
                $img->post_id=$idPost;
                $img->save();
                $i++;
            }
        }
        return "ya termino";
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

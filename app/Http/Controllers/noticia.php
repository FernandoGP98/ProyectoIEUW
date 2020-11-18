<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        switch ($request->categoria) {
            case 'Nintendo':
                $nuevaNoticia->categoria_id=1;
                break;
            case 'Sony':
                $nuevaNoticia->categoria_id=2;
                break;
            case 'Xbox':
                $nuevaNoticia->categoria_id=3;
                break;
        }

        $nuevaNoticia->fecha=$request->fecha;
        $nuevaNoticia->contenido=$request->noticia_contenido;
        $nuevaNoticia->user_id=$request->autor;
        $nuevaNoticia->titulo=$noticia_reseña->esNoticia;

        if($request->hasFile('imagenes')){

        }
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

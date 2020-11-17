<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Routing extends Controller
{
    public function index(){
        return view('pages.landing');
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
        return view('pages.detalle');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Routing extends Controller
{
    public function index(){
        return view('pages.landing');
    }

    public function filtro(){
        return view('pages.filtro');
    }
}
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;
use App\Http\Controllers\Ajax;
use App\Http\Controllers\noticia;
use App\Http\Controllers\comentar;
use App\Http\Controllers\likes;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [Routing::class, 'index']);
Route::get('/redactar/noticia', [Routing::class, 'redactarNoticia']);
Route::get('/redactar/reseña', [Routing::class, 'redactarReseña']);
Route::get('/filtro/{a}', [Routing::class, 'filtro']);
Route::get('/detalle/{a}/{b}', [Routing::class, 'detalle']);
Route::get('/perfil', [Routing::class, 'perfil']);

Route::resource('/noticia', noticia::class);
Route::resource('/comentar', comentar::class);
Route::resource('/like', likes::class);

//Route::view('/', 'landing')->middleware('auth');

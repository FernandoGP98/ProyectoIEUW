<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;
use App\Http\Controllers\Ajax;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [Routing::class, 'index']);
Route::get('/redactar/noticia', [Routing::class, 'redactarNoticia']);
Route::get('/redactar/reseña', [Routing::class, 'redactarReseña']);
Route::get('/filtro/{a}/{b}', [Routing::class, 'filtro']);
Route::get('/detalle/{a}/{b}', [Routing::class, 'detalle']);

Route::resource('ajax', Ajax::class);

//Route::view('/', 'landing')->middleware('auth');

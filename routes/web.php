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
Route::get('/editar/publicacion/{a}', [Routing::class, 'editarPublicacion']);
Route::get('/redactar/reseña', [Routing::class, 'redactarReseña']);
Route::get('/filtro/{a}', [Routing::class, 'filtro']);
Route::get('/detalle/{a}/{b}', [Routing::class, 'detalle']);
Route::get('/perfil', [Routing::class, 'perfil']);
Route::post('/busqueda', [Routing::class, 'busqueda']);
Route::post('/busquedaAvanzada', [Routing::class, 'busquedaAvenzada']);

Route::post('/UsuarioUpdate', 'usuario@UsuarioUpdate');

Route::resource('/noticia', 'noticia');
Route::resource('/comentar', 'comentar');
Route::resource('/like', 'likes');

//Route::view('/', 'landing')->middleware('auth');

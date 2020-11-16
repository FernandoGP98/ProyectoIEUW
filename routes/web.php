<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [Routing::class, 'index']);
Route::get('/filtro/{a}/{b}', [Routing::class, 'filtro']);
Route::get('/detalle/{a}/{b}', [Routing::class, 'detalle']);

//Route::view('/', 'landing')->middleware('auth');

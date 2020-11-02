<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [Routing::class, 'index']);
Route::get('/noticias', [Routing::class, 'filtro']);

Route::view('home', 'home')->middleware('auth');

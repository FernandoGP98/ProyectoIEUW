<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [Routing::class, 'index']);
Route::get('/filtro', [Routing::class, 'filtro']);
Route::get('/filtro/1', [Routing::class, 'filtro']);

Route::view('home', 'home')->middleware('auth');

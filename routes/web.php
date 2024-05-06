<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return;
})->name("login");

Route::get('/buscar', function () {
    return;
})->name("trabajo_grado.buscar");

Route::get('/publicar', function () {
    return;
})->name("trabajo_grado.publicar");

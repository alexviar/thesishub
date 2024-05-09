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

Auth::routes(
    [
        'register' => false, // Deshabilitar el registro de usuarios
        'reset' => false, // Deshabilitar restablecimiento de contraseña
        'verify' => false, // Deshabilitar verificación de correo electrónico
        'confirm' => false, // Deshabilitar confirmación de contraseña
    ]
);

Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
Route::get('trabajos-grado/buscar', function () {
    return;
})->name("trabajo_grado.buscar");

Route::get('trabajos-grado/publicar', function () {
    return;
})->name("trabajo_grado.publicar");

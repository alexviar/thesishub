<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TrabajoGradoController;
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
    return redirect(RouteServiceProvider::HOME);
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

Route::controller(TrabajoGradoController::class)->prefix('trabajos-grado')->group(function(){

    Route::get('buscar', 'index')->name("trabajo_grado.publicar");    
    Route::get('publicar', 'create')->name("trabajo_grado.publicar");    
    Route::post('publicar', 'store');
});

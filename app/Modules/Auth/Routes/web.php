<?php

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

use App\Modules\Auth\Http\Controllers\UsuarioController;
use App\Modules\Auth\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes(
//     [
//         'login' => 'LoginController@login',
//         'register' => false, // Deshabilitar el registro de usuarios
//         'reset' => false, // Deshabilitar restablecimiento de contraseña
//         'verify' => false, // Deshabilitar verificación de correo electrónico
//         'confirm' => false, // Deshabilitar confirmación de contraseña
//     ]
// );

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});
// Route::get('/logout', 'LoginController@logout');

Route::resource('usuarios', UsuarioController::class )->middleware(['auth','can:administrar-usuarios'])->except(['destroy']);

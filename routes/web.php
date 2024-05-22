<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TrabajoGradoController;
use App\Http\Controllers\UsuarioController;
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
    Route::get('', 'index')->name("trabajos_grado.index");
    Route::get('buscar', 'buscar')->name("trabajos_grado.buscar");   
    Route::middleware('auth')->get('publicar', 'create')->name("trabajos_grado.publicar");    
    Route::middleware('auth')->post('publicar', 'store');
    Route::get('{id}', 'show')->name('trabajos_grado.show');
    Route::get('descargar/{filename}', 'descargar')->name('trabajos_grado.descargar');
});

Route::get('tutores/{codigo}', function ($codigo){
    $tutor = \App\Models\Tutor::firstWhere("codigo", $codigo);
    if($tutor == null) {
        throw new ModelNotFoundException();
    }
    return response()->json($tutor);
});

Route::get('estudiantes/{nro_registro}', function ($nro_registro){
    $estudiante = \App\Models\Estudiante::firstWhere("nro_registro", $nro_registro);
    if($estudiante == null) {
        throw new ModelNotFoundException();
    }
    return response()->json($estudiante);
});
Route::resource('usuarios', UsuarioController::class );

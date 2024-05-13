<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TrabajoGradoController;
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

Route::get('trabajogrado',[TrabajoGradoController::class,'index']);
Route::get('trabajogrado/{id}', [TrabajoGradoController::class, 'show']);
Route::get('trabajogrado/buscar', [TrabajoGradoController::class, 'buscar'])->name('trabajo_grado.buscar');
Route::get('trabajogrado/publicar', [TrabajoGradoController::class, 'publicar'])->name('trabajo_grado.publicar');
Route::get('trabajogrado/{filename}/descargar', [TrabajoGradoController::class, 'descargar'])->name('trabajo_grado.descargar');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/buscar-trabajos', [TrabajoGradoController::class,'buscar'])->name('trabajos.buscar');

Route::get('/', function () {
    return view('welcome');
});

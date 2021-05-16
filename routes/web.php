<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecibosController;
use App\Http\Controllers\CobranzasController;

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

Route::get('cobranzas', function(){
    return view('cobranzas.index');
})->name('cobranzas.index');

Route::resource('recibos', RecibosController::class);
Route::get('recibos/{id?}', [RecibosController::class, 'index'])->name('recibos.index');


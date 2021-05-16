<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecibosController;
use App\Http\Controllers\CobranzasController;
use App\Http\Controllers\DocumentosController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('cobranzas', function () {
        return view('cobranzas.index');
    })->name('cobranzas.index');

    Route::resource('cobranzas/recibos', RecibosController::class);
    Route::get('cobranzas/recibos/{id?}', [RecibosController::class, 'index'])->name('recibos.index');

    Route::post('documentos/details', [DocumentosController::class, 'details'])->name('documentos.details');
});


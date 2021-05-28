<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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

    Route::get('cobranzas/relaciones', [CobranzasController::class, "index"])->name("cobranzas.index");
    Route::delete('cobranzas/relaciones/{id}', [CobranzasController::class, "destroy"])->name("cobranzas.destroy");
    Route::post('cobranzas/relaciones/create', [CobranzasController::class, 'store'])->name('cobranzas.store');
    Route::get('cobranzas/relaciones/show/{id}', [CobranzasController::class, 'show'])->name('cobranzas.show');
    Route::delete('cobranzas/relaciones/delete-recibo/{id_recibo}', [CobranzasController::class, "remove_recibo"])->name("cobranzas.remove_recibo");
    Route::get('cobranzas/relaciones/print/{id}', [CobranzasController::class, 'print'])->name('cobranzas.print');


    Route::get('cobranzas/recibos/print/{id}', [RecibosController::class, 'print'])->name('recibos.print');
    Route::resource('cobranzas/recibos', RecibosController::class);
    Route::post('documentos/details', [DocumentosController::class, 'details'])->name('documentos.details');

    Route::resource('config/users', UsersController::class)->names('config.users');
});

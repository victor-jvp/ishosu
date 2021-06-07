<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RecibosController;
use App\Http\Controllers\CobranzasController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\EstacionController;

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
    Route::post('cobranzas/relaciones', [CobranzasController::class, 'store'])->name('cobranzas.store');
    Route::get('cobranzas/relaciones/show/{id}', [CobranzasController::class, 'show'])->name('cobranzas.show');
    Route::delete('cobranzas/relaciones/delete-recibo/{id_recibo}', [CobranzasController::class, "remove_recibo"])->name("cobranzas.remove_recibo");
    Route::get('cobranzas/relaciones/print/{id}', [CobranzasController::class, 'print'])->name('cobranzas.print');


    Route::get('cobranzas/recibos/print/{id}', [RecibosController::class, 'print'])->name('recibos.print');
    Route::get('cobranzas/recibos/marcar-vuelto/{id}', [RecibosController::class, 'marcar_vuelto'])->name('recibos.marcar_vuelto');
    Route::resource('cobranzas/recibos', RecibosController::class);
    Route::post('documentos/ajaxSearchById', [DocumentosController::class, 'ajaxSearchById'])->name('documentos.ajaxSearchById');

    Route::delete('config/users/delete/{id}', [UsersController::class, 'delete'])->name('config.users.delete');
    Route::resource('config/users', UsersController::class)->only(['index', 'create', 'store', 'edit', 'update'])->names('config.users');

    Route::delete('config/estaciones/delete/{id}', [EstacionController::class, 'delete'])->name('config.estaciones.delete');
    Route::resource('config/estaciones', EstacionController::class)->only(['index', 'create', 'store', 'edit', 'update'])->names('config.estaciones');
});

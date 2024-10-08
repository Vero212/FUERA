<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuenteController; 
use App\Http\Controllers\GeometriaController; 
use App\Http\Controllers\DepositoController; 
use App\Http\Controllers\TipoController; 
use App\Http\Controllers\UnidadController; 
use App\Http\Controllers\EmisionController; 
use App\Http\Controllers\UsoController; 


/* Route::get('/', function () {
    return view('welcome');
}); */

// Redirigir a la página de login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rutas Fuentes
/* Route::get('/fuentes', function () {
    return view('fuentes');
})->middleware(['auth', 'verified'])->name('fuentes'); */
Route::resource('fuentes',FuenteController::class);
Route::post('/fuentes', [FuenteController::class, 'store'])->name('fuentes.store');
//Modificacion Fuentes
Route::get('fuentes/{id}/edit', [FuenteController::class, 'edit'])->name('fuentes.edit');
Route::put('fuentes/{id}', [FuenteController::class, 'update'])->name('fuentes.update');


//Rutas Geometria
Route::resource('geometrias',GeometriaController::class);
Route::post('/geometrias', [GeometriaController::class, 'store'])->name('geometrias.store');
//Modificacion Geometria
Route::get('geometrias/{id}/edit', [GeometriaController::class, 'edit'])->name('geometrias.edit');
Route::put('geometrias/{id}', [GeometriaController::class, 'update'])->name('geometrias.update');

//Rutas Depositos
Route::resource('depositos',DepositoController::class);
Route::post('/depositos', [DepositoController::class, 'store'])->name('depositos.store');
//Modificacion Despositos
Route::get('depositos/{id}/edit', [DepositoController::class, 'edit'])->name('depositos.edit');
Route::put('depositos/{id}', [DepositoController::class, 'update'])->name('depositos.update');

//Rutas Tipos
Route::resource('tipos',TipoController::class);
Route::post('/tipos', [TipoController::class, 'store'])->name('tipos.store');
//Modificacion Tipos
Route::get('tipos/{id}/edit', [TipoController::class, 'edit'])->name('tipos.edit');
Route::put('tipos/{id}', [TipoController::class, 'update'])->name('tipos.update');

//Rutas Unidades
Route::resource('unidades',UnidadController::class);
Route::post('/unidades', [UnidadController::class, 'store'])->name('unidades.store');
//Modificacion Unidades
Route::get('unidades/{id}/edit', [UnidadController::class, 'edit'])->name('unidades.edit');
Route::put('unidades/{id}', [UnidadController::class, 'update'])->name('unidades.update');

//Rutas Emisiones
Route::resource('emisiones',EmisionController::class);
Route::post('/emisiones', [EmisionController::class, 'store'])->name('emisiones.store');
//Modificacion Emisiones
Route::get('emisiones/{id}/edit', [EmisionController::class, 'edit'])->name('emisiones.edit');
Route::put('emisiones/{id}', [EmisionController::class, 'update'])->name('emisiones.update');

//Rutas Usos
Route::resource('usos',UsoController::class);
Route::post('/usos', [UsoController::class, 'store'])->name('usos.store');
//Modificacion Usos
Route::get('usos/{id}/edit', [UsoController::class, 'edit'])->name('usos.edit');
Route::put('usos/{id}', [UsoController::class, 'update'])->name('usos.update');

//Generacion de PDF - por letra
Route::post('/fuentes/pdf', [FuenteController::class, 'generarPDFPorFuente'])->name('fuentes.pdf');
//Exportacion a Excel
Route::post('/fuentes/exportar-csv', [FuenteController::class, 'exportarCSV'])->name('fuentes.exportar.csv');

//Generacion de PDF - Bajas
Route::post('/fuentesbaja/pdf', [FuenteController::class, 'generarPDFBajas'])->name('fuentesbaja.pdf');
//Exportacion a Excel Bajas
Route::post('/fuentesbajas/exportar-csv', [FuenteController::class, 'exportarCSVBajas'])->name('fuentesbajas.exportar.csv');



require __DIR__.'/auth.php';


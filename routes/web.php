<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuenteController; 
use App\Http\Controllers\GeometriaController; 
use App\Http\Controllers\DepositoController; 
use App\Http\Controllers\TipoController; 


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/fuentes', function () {
    return view('fuentes');
})->middleware(['auth', 'verified'])->name('fuentes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rutas Geometria
Route::resource('geometrias',GeometriaController::class);
Route::post('/geometrias', [GeometriaController::class, 'store'])->name('geometrias.store');
//Modificacion Geometria
Route::get('geometrias/{id}/edit', [GeometriaController::class, 'edit'])->name('geometrias.edit');
Route::put('geometrias/{id}', [GeometriaController::class, 'update'])->name('geometrias.update');

//Rutas Depositos
Route::resource('depositos',DepositoController::class);
Route::post('/depositos', [DepositoController::class, 'store'])->name('depositos.store');
//Modificacion Geometria
Route::get('depositos/{id}/edit', [DepositoController::class, 'edit'])->name('depositos.edit');
Route::put('depositos/{id}', [DepositoController::class, 'update'])->name('depositos.update');

//Rutas Tipos
Route::resource('tipos',TipoController::class);
Route::post('/tipos', [TipoController::class, 'store'])->name('tipos.store');
//Modificacion Geometria
Route::get('tipos/{id}/edit', [TipoController::class, 'edit'])->name('tipos.edit');
Route::put('tipos/{id}', [TipoController::class, 'update'])->name('tipos.update');



Route::resource('fuentes',FuenteController::class);


require __DIR__.'/auth.php';


<?php
use App\Http\Controllers\ModuloController;

Route::get('modulos', [ModuloController::class,'index'])->name('modulos.index')->middleware('sesion.iniciada');
Route::get('modulos/agregar', [ModuloController::class,'agregar'])->name('modulos.agregar')->middleware('sesion.iniciada');
Route::get('modulos/{id}', [ModuloController::class,'mostrar'])->name('modulos.mostrar')->middleware('sesion.iniciada');
Route::post('modulos', [ModuloController::class,'insertar'])->name('modulos.insertar')->middleware('sesion.iniciada');
Route::get('modulos/{id}/modificar', [ModuloController::class,'modificar'])->name('modulos.modificar')->middleware('sesion.iniciada');
Route::put('modulos/{modulo}', [ModuloController::class,'actualizar'])->name('modulos.actualizar')->middleware('sesion.iniciada');
Route::delete('modulos/{modulo}', [ModuloController::class,'eliminar'])->name('modulos.eliminar')->middleware('sesion.iniciada');

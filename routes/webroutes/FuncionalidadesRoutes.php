<?php
use App\Http\Controllers\FuncionalidadController;
Route::get('funcionalidades', [FuncionalidadController::class,'index'])->name('funcionalidades.index')->middleware('sesion.iniciada');
Route::get('funcionalidades/agregar', [FuncionalidadController::class,'agregar'])->name('funcionalidades.agregar')->middleware('sesion.iniciada');
Route::get('funcionalidades/{id}', [FuncionalidadController::class,'mostrar'])->name('funcionalidades.mostrar')->middleware('sesion.iniciada');
Route::post('funcionalidades', [FuncionalidadController::class,'insertar'])->name('funcionalidades.insertar')->middleware('sesion.iniciada');
Route::get('funcionalidades/{id}/modificar', [FuncionalidadController::class,'modificar'])->name('funcionalidades.modificar')->middleware('sesion.iniciada');
Route::put('funcionalidades/{funcionalidad}', [FuncionalidadController::class,'actualizar'])->name('funcionalidades.actualizar')->middleware('sesion.iniciada');
Route::delete('funcionalidades/{funcionalidad}', [FuncionalidadController::class,'eliminar'])->name('funcionalidades.eliminar')->middleware('sesion.iniciada');

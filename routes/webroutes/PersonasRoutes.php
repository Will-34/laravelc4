<?php
use App\Http\Controllers\PersonaController;

Route::get('personas', [PersonaController::class,'index'])->name('personas.index')->middleware('sesion.iniciada');
Route::get('personas/agregar', [PersonaController::class,'agregar'])->name('personas.agregar')->middleware('sesion.iniciada');
Route::get('personas/{id}', [PersonaController::class,'mostrar'])->name('personas.mostrar')->middleware('sesion.iniciada');
Route::post('personas', [PersonaController::class,'insertar'])->name('personas.insertar')->middleware('sesion.iniciada');
Route::get('personas/{id}/modificar', [PersonaController::class,'modificar'])->name('personas.modificar')->middleware('sesion.iniciada');
Route::put('personas/{persona}', [PersonaController::class,'actualizar'])->name('personas.actualizar')->middleware('sesion.iniciada');
Route::delete('personas/{persona}', [PersonaController::class,'eliminar'])->name('personas.eliminar')->middleware('sesion.iniciada');

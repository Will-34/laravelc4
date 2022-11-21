<?php
use App\Http\Controllers\PerfilController;

Route::get('perfiles', [PerfilController::class,'index'])->name('perfiles.index')->middleware('sesion.iniciada');
Route::get('perfiles/agregar', [PerfilController::class,'agregar'])->name('perfiles.agregar')->middleware('sesion.iniciada');
Route::get('perfiles/{id}', [PerfilController::class,'mostrar'])->name('perfiles.mostrar')->middleware('sesion.iniciada');
Route::post('perfiles', [PerfilController::class,'insertar'])->name('perfiles.insertar')->middleware('sesion.iniciada');
Route::get('perfiles/{id}/modificar', [PerfilController::class,'modificar'])->name('perfiles.modificar')->middleware('sesion.iniciada');
Route::put('perfiles/{perfil}', [PerfilController::class,'actualizar'])->name('perfiles.actualizar')->middleware('sesion.iniciada');
Route::delete('perfiles/{perfil}', [PerfilController::class,'eliminar'])->name('perfiles.eliminar')->middleware('sesion.iniciada');

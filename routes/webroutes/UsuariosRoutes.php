<?php
use App\Http\Controllers\UsuarioController;

Route::get('usuarios', [UsuarioController::class,'index'])->name('usuarios.index')->middleware('sesion.iniciada');
Route::get('usuarios/agregar', [UsuarioController::class,'agregar'])->name('usuarios.agregar')->middleware('sesion.iniciada');
Route::get('usuarios/{id}', [UsuarioController::class,'mostrar'])->name('usuarios.mostrar')->middleware('sesion.iniciada');
Route::post('usuarios', [UsuarioController::class,'insertar'])->name('usuarios.insertar')->middleware('sesion.iniciada');
Route::get('usuarios/{id}/modificar', [UsuarioController::class,'modificar'])->name('usuarios.modificar')->middleware('sesion.iniciada');
Route::put('usuarios/{usuario}', [UsuarioController::class,'actualizar'])->name('usuarios.actualizar')->middleware('sesion.iniciada');
Route::delete('usuarios/{usuario}', [UsuarioController::class,'eliminar'])->name('usuarios.eliminar')->middleware('sesion.iniciada');

Route::get('usuarios/personas-activas/buscar', [UsuarioController::class,'personasActivas'])->name('usuarios.personasActivas')->middleware('sesion.iniciada');


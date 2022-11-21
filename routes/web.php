<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;

use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuloController;
// use App\Http\Controllers\FuncionalidadController;
// use App\Http\Controllers\EstudianteController;
// use App\Http\Controllers\DocenteController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', HomeController::class)->middleware('sesion.iniciada')->name('index');
Route::post('iniciar-session', [SessionController::class,'iniciar'])->name('iniciar.session');
Route::get('cerrar-session', [SessionController::class,'cerrar'])->name('cerrar.session');

Route::get('login',  function () {
    return view('login');
})->name('login'); 

include_once 'webroutes/ModulosRoutes.php';


include_once 'webroutes/PersonasRoutes.php';

include_once 'webroutes/PerfilesRoutes.php';
include_once 'webroutes/UsuariosRoutes.php';

include_once 'webroutes/FuncionalidadesRoutes.php';



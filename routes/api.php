<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Permiso;
use App\Models\Proyecto;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function (Request $request) {
    return 'pong';
});

Route::get('/auth-user', function (Request $request) {
    $session_id = $request->session_id;
    $proyecto_id =  $request->proyecto_id;
    $permiso = new Permiso();
    $usuario = $permiso->obtenerUsuarioSession($session_id,$proyecto_id);
    if(!$usuario){
        $respuesta =['success'=>false,"message"=>"usuario y proyecto no encontrado"];
        return response($respuesta, 200)->header('Content-Type', 'application/json');
    }
    $respuesta =['success'=>true,"usuario"=>$usuario];
    return response($respuesta, 200)->header('Content-Type', 'application/json');
    

});
Route::post('/guardar-modelo', function (Request $request) {
    $proyecto = new Proyecto();
    $proyecto_id = $request->proyecto_id;
    $json_modelo = $request->json_modelo;
    
    $res= $proyecto->guardarModeloProyecto($proyecto_id,$json_modelo);
    $respuesta =['success'=>true, 'proyecto_id'=> $proyecto_id, 'modelo'=>$json_modelo];
    return response($respuesta, 200)->header('Content-Type', 'application/json');

});
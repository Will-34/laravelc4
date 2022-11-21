<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Libs\Funciones;
use Illuminate\Http\Request;
//ModuloController
class ModuloController extends Controller
{
    public $parControl=[
        'modulo'=>'seguridad',
        'funcionalidad'=>'modulos',
        'titulo' =>'Modulos',
    ];

    public function index(Request $request)
    {
        $modulo = new Modulo();
        $buscar=$request->buscar;
        $pagina=$request->pagina;
        $resultado = $modulo->obtenerModulos($buscar,$pagina);
        $mergeData = ['modulos'=>$resultado['modulos'],'total'=>$resultado['total'],'buscar'=>$buscar,'parPaginacion'=>$resultado['parPaginacion'],'parControl'=>$this->parControl];
        return view('modulos.index',$mergeData);
    }
    public function mostrar($id)
    {
        $modulo = Modulo::find($id);
        $mergeData = ['id'=>$id,'modulo'=>$modulo,'parControl'=>$this->parControl];
        return view('modulos.mostrar',$mergeData);
    }

    public function agregar()
    {   
        $mergeData = ['parControl'=>$this->parControl];
        return view('modulos.agregar',$mergeData);
    }

    public function insertar(Request $request)
    {
        $request->validate([
            'titulo'=>'required|max:30',
            'codigo'=>'required|max:25',
            'icono'=>'required|max:20',
            'orden'=>'required',
            'activo'=>'required',
        ]);

        $modulo = new Modulo();
        $modulo->titulo = $request->titulo;
        $modulo->codigo = $request->codigo;
        $modulo->icono = $request->icono;
        $modulo->orden = $request->orden;
        $modulo->activo = $request->activo?true:false;
        $modulo->save();

        return redirect()->route('modulos.mostrar',$modulo->id);
    }

    public function modificar($id)
    {
        $modulo = Modulo::find($id);
        $mergeData = ['id'=>$id,'modulo'=>$modulo,'parControl'=>$this->parControl];
        return view('modulos.modificar',$mergeData);
    }

    public function actualizar(Request $request, Modulo $modulo)
    {
        $request->validate([
            'titulo'=>'required|max:30',
            'codigo'=>'required|max:25',
            'icono'=>'required|max:20',
            'orden'=>'required',
            'activo'=>'required',
        ]);
        $modulo->titulo = $request->titulo;
        $modulo->codigo = $request->codigo;
        $modulo->icono = $request->icono;
        $modulo->orden = $request->orden;
        $modulo->activo = $request->activo?true:false;
        $modulo->save();

        return redirect()->route('modulos.mostrar',$modulo->id);
    }

    public function eliminar($id)
    {
        $modulo = Modulo::find($id);
        $modulo->eliminado=true;
        $modulo->save();
        return redirect()->route('modulos.index');
    }
}

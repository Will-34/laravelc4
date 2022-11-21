<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Libs\Funciones;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public $parControl=[
        'modulo'=>'seguridad',
        'funcionalidad'=>'personas',
        'titulo' =>'Personas',
    ];

    public function index(Request $request)
    {
        $persona = new Persona();
        $buscar=$request->buscar;
        $pagina=$request->pagina;
        $resultado = $persona->obtenerPersonas($buscar,$pagina);
        $mergeData = [
            'personas'=>$resultado['personas'],
            'total'=>$resultado['total'],
            'buscar'=>$buscar,
            'parPaginacion'=>$resultado['parPaginacion'],
            'parControl'=>$this->parControl
        ];
        return view('personas.index',$mergeData);
    }
    public function mostrar($id)
    {
        $persona = Persona::find($id);
        $mergeData = ['id'=>$id,'persona'=>$persona,'parControl'=>$this->parControl];
        return view('personas.mostrar',$mergeData);
    }

    public function agregar()
    { 
        $mergeData = ['parControl'=>$this->parControl];
        return view('personas.agregar',$mergeData);  
    }

    public function insertar(Request $request)
    {
        $request->validate([
            'nombres'=>'required|max:30',
            'primer_apellido'=>'required|max:30',
            'segundo_apellido'=>'max:30',
            'genero'=>'required|max:1',
            'ci'=>'required|max:10',
            'ci_exp'=>'required|max:5',
            'fecha_nacimiento'=>'required|max:10',
            'celular'=>'required|max:8',
            'telefono'=>'max:8',
            'direccion'=>'max:30',
            'correo'=>'max:30',
            'activo'=>'required',
        ]);

        $persona = new Persona();
        $persona->nombres = $request->nombres;
        $persona->primer_apellido = $request->primer_apellido;
        $persona->segundo_apellido = $request->segundo_apellido;
        $persona->genero = $request->genero;
        $persona->ci = $request->ci;
        $persona->ci_exp = $request->ci_exp;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->celular = $request->celular;
        $persona->telefono = $request->telefono;
        $persona->direccion = $request->direccion;
        $persona->correo = $request->correo;
        $persona->activo = $request->activo?true:false;
        $persona->save();

        return redirect()->route('personas.mostrar',$persona->id);
    }

    public function modificar($id)
    {
        $persona = Persona::find($id);
        $mergeData = ['id'=>$id,'persona'=>$persona,'parControl'=>$this->parControl];
        return view('personas.modificar',$mergeData);
    }

    public function actualizar(Request $request, Persona $persona)
    {
        $request->validate([
            'nombres'=>'required|max:30',
            'primer_apellido'=>'required|max:30',
            'segundo_apellido'=>'max:30',
            'genero'=>'required|max:1',
            'ci'=>'required|max:10',
            'ci_exp'=>'required|max:5',
            'fecha_nacimiento'=>'required|max:10',
            'celular'=>'required|max:8',
            'telefono'=>'max:8',
            'direccion'=>'required|max:30',
            'correo'=>'required|max:30',
            'activo'=>'required',
        ]);
        $persona->nombres = $request->nombres;
        $persona->primer_apellido = $request->primer_apellido;
        $persona->segundo_apellido = $request->segundo_apellido;
        $persona->genero = $request->genero;
        $persona->ci = $request->ci;
        $persona->ci_exp = $request->ci_exp;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->celular = $request->celular;
        $persona->telefono = $request->telefono;
        $persona->direccion = $request->direccion;
        $persona->correo = $request->correo;
        $persona->activo = $request->activo?true:false;
        $persona->save();

        return redirect()->route('personas.mostrar',$persona->id);
    }

    public function eliminar($id)
    {
        $persona = Persona::find($id);
        $persona->eliminado=true;
        $persona->save();
        return redirect()->route('personas.index');
    }
}

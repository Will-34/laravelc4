<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proyecto extends Model
{
    use HasFactory;
    protected $table="proyectos";

        
    public function obtenerProyectoEditar($proyecto_id)
    {
        $sql = "select id, nombre, modelos from proyectos p where p.id=$proyecto_id";
        $proyectos = DB::select($sql);
        if(count($proyectos)>0){
            return $proyectos[0];
        }else{
            return null;
        }
    }
    public function guardarModeloProyecto($proyecto_id, $json_modelo)
    {
        DB::table('proyectos')
            ->where('id', $proyecto_id)
            ->update(['modelos' => $json_modelo]);
        return true;
    }
}

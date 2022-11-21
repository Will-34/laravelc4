<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Turno extends Model
{
    use HasFactory;
    protected $table="turnos";

    public function obtenerTurnos($buscar='', $pagina=1)
    {
        $limite=15;        
        $pagina = $pagina ? $pagina : 1;//no modificar (inicia la pagina)
        $inicio =  ($pagina -1)* $limite; // define el inicio

        $filtro="";
        if ($buscar!="") {
            $filtro=" and (t.nombre like '%$buscar%' or t.hora_ini like '%$buscar%') ";
        }

        $sql = "select * from turnos t
                where t.eliminado = 0 $filtro order by id desc limit $inicio,$limite";
        $turnos = DB::select($sql);

        $sqlTotal = "select count(*) as total from turnos t
                    where t.eliminado = 0 $filtro";
        $result = DB::select($sqlTotal); //no tocar 
        $total=$totPaginas=0;
        if (count($result)>0) {
            $total=$result[0]->total;
            $totPaginas = round($total/$limite, 2)>floor($total/$limite)?floor($total/$limite)+1:floor($total/$limite);
        } //hasta aqui
        return [
            'turnos'=>$turnos,
            'total'=>$total, //NT
            'parPaginacion'=>['pagActual'=>$pagina,'totPaginas'=>$totPaginas] //NT
        ];
    }

    
    public function obtenerTurnosActivos()
    {
        $sql = "select id,nombre 
                from turnos t 
                where t.eliminado =0 and activo=1 order by nombre asc";
        $turnos = DB::select($sql);
        return $turnos;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    use HasFactory;
    protected $table="personas";

    public function obtenerPersonas($buscar='', $pagina=1)
    {
        $limite=7;        
        $pagina = $pagina ? $pagina : 1;//no modificar (inicia la pagina)
        $inicio =  ($pagina -1)* $limite; // define el inicio

        $filtro="";
        if ($buscar!="") {
            $filtro=" and (p.nombres like '%$buscar%' or p.primer_apellido or p.segundo_apellido or p.ci like '%$buscar%') ";
        }

        $sql = "select * from personas p
                where p.eliminado = 0 $filtro order by id desc limit $inicio,$limite";
        $personas = DB::select($sql);

        $sqlTotal = "select count(*) as total from personas p
                    where p.eliminado = 0 $filtro";
        $result = DB::select($sqlTotal); //no tocar 
        $total=$totPaginas=0;
        if (count($result)>0) {
            $total=$result[0]->total;
            $totPaginas = round($total/$limite, 2)>floor($total/$limite)?floor($total/$limite)+1:floor($total/$limite);
        } //hasta aqui
        return [
            'personas'=>$personas,
            'total'=>$total, //NT
            'parPaginacion'=>['pagActual'=>$pagina,'totPaginas'=>$totPaginas] //NT
        ];
    }

    public function getNombreCompleto($id){
        $sql = "select concat(p.primer_apellido,' ',coalesce(p.segundo_apellido,''),' ',p.nombres) as nombre from personas p where p.id=$id";
        $personas= DB::select($sql);

        if(count($personas)>0){
            return $personas[0]->nombre;
        }else{
            return "";
        }
    }

}

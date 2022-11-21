<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Perfil extends Model
{
    use HasFactory;
    protected $table="perfiles";

    public function obtenerPerfiles($buscar='', $pagina=1)
    {
        $limite=15;
        $pagina = $pagina ? $pagina : 1;//no modificar (inicia la pagina)
        $inicio =  ($pagina -1)* $limite; // define el inicio

        $filtro="";
        if ($buscar!="") {
            $filtro=" and (p.nombre like '%$buscar%' ) ";
        }

        $sql = "select * from perfiles p
                    where p.eliminado =0 $filtro order by id desc limit $inicio,$limite";
        $perfiles = DB::select($sql);

        $sqlTotal = "select count(*) as total from perfiles p
                    where p.eliminado = 0 $filtro";
        $result = DB::select($sqlTotal); //no tocar 
        $total=$totPaginas=0;
        if (count($result)>0) {
            $total=$result[0]->total;
            $totPaginas = round($total/$limite, 2)>floor($total/$limite)?floor($total/$limite)+1:floor($total/$limite);
        } //hasta aqui
        return [
            'perfiles'=>$perfiles,
            'total'=>$total, //NT
            'parPaginacion'=>['pagActual'=>$pagina,'totPaginas'=>$totPaginas] //NT
        ];
    }

    public function obtenerPerfilesActivos()
    {
        $sql = "select id,nombre from perfiles p where p.eliminado =0 and activo=1 order by nombre asc";
        $perfiles = DB::select($sql);
        return $perfiles;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modulo extends Model
{
    use HasFactory;
    protected $table="modulos";

    public function obtenerModulos($buscar='', $pagina=1)
    {
        $limite=15;
        $filtro="";
        if ($buscar!="") {
            $filtro=" and (m.titulo like '%$buscar%' or m.codigo like '%$buscar%')";
        }
        $pagina = $pagina ? $pagina : 1;
        $inicio =  ($pagina -1)* $limite;
        $sql = "select * from modulos m where m.eliminado=0 $filtro order by id asc limit $inicio,$limite ";
        $modulos = DB::select($sql);

        $sqlTotal = "select count(*) as total from modulos m where m.eliminado=0 $filtro";
        $result = DB::select($sqlTotal);
        $total=$totPaginas=0;
        if (count($result)>0) {
            $total=$result[0]->total;
            $totPaginas = round($total/$limite, 2)>floor($total/$limite)?floor($total/$limite)+1:floor($total/$limite);
        }
        return [
            'modulos'=>$modulos,
            'total'=>$total,
            'parPaginacion'=>['pagActual'=>$pagina,'totPaginas'=>$totPaginas]
        ];
    }
    public function obtenerModulosActivos()
    {
        $sql = "select id,titulo from modulos a where a.eliminado =0 and activo=1 order by orden asc";
        $modulos = DB::select($sql);
        return $modulos;
    }
}

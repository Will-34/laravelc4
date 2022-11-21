<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Funcionalidad extends Model
{
    use HasFactory;
    protected $table="funcionalidades";

    public function obtenerFuncionalidades($buscar='', $pagina=1)
    {
        $limite=15;
        $pagina = $pagina ? $pagina : 1;//no modificar (inicia la pagina)
        $inicio = ($pagina -1)* $limite; // define el inicio

        $filtro="";
        if ($buscar!="") {
            $filtro=" and (f.titulo like '%$buscar%' ) ";
        }

        $sql = "select f.*, m.titulo as modulo from funcionalidades f
        inner join modulos m on m.id =f.modulo_id 
        where f.eliminado =0 $filtro order by f.id desc limit $inicio,$limite";
        $funcionalidades = DB::select($sql);

        $sqlTotal = "select count(*) as total from funcionalidades f
        inner join modulos m on m.id =f.modulo_id 
        where f.eliminado =0 $filtro ";
        $result = DB::select($sqlTotal); //no tocar
        $total=$totPaginas=0;
        if (count($result)>0) {
            $total=$result[0]->total;
            $totPaginas = round($total/$limite, 2)>floor($total/$limite)?floor($total/$limite)+1:floor($total/$limite);
        } //hasta aqui
        return [
            'funcionalidades'=>$funcionalidades,
            'total'=>$total, //NT
            'parPaginacion'=>['pagActual'=>$pagina,'totPaginas'=>$totPaginas], //NT
        ];
    }
    public static function getFuncionalidad($id)
    {
        $sql = "select f.*, m.titulo as modulo from funcionalidades f
                    inner join modulos m on m.id =f.modulo_id 
                    where f.eliminado =0 and f.id=$id";
        $funcionalidades = DB::select($sql);
        if (count($funcionalidades)>0) {
            return $funcionalidades[0];
        } else {
            return null;
        }
    }

    public function obtenerFuncionalidadesActivas($modulo_id)
    {
        $sql = "select id,titulo from funcionalidades f where f.activo =1 and f.eliminado =0 and modulo_id=$modulo_id order by f.orden asc";
        $funcionalidades = DB::select($sql);
        return $funcionalidades;
    }
    
    public function obtenerFuncionalidadesActivasEnPerfil($modulo_id,$perfil_id)
    {
        $sql = "select f.id,f.titulo, p.perfil_id 
                from funcionalidades f 
                left join permisos p on p.funcionalidad_id = f.id and p.perfil_id =$perfil_id
                where f.activo =1 and f.eliminado =0 and f.modulo_id =$modulo_id order by f.orden asc";
        $funcionalidades = DB::select($sql);
        
        return $funcionalidades;
    }

}

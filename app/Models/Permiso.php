<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permiso extends Model
{
    use HasFactory;
    protected $table="permisos";

    public function obtenerUsuario($login,$password,$tipo){
        if($tipo=='adm'){
            $sql = "select concat(coalesce(p.primer_apellido,''),' ',coalesce(p.segundo_apellido,''),' ',p.nombres) as nombre_completo ,u.login,u.perfil_id,u.id,u.tipo
                        from usuarios u 
                        inner join personas p on p.id = u.id
                        where u.login = ? AND pass = ?
                        and u.activo = 1 AND u.eliminado=0";
            $usuarios = DB::select($sql, [$login,$password]);
            if(count($usuarios)>0){
                return $usuarios[0];
            }else{
                return null;
            }
        }else if ($tipo=='est'){ // buscar estudiante
        }else if ($tipo=='doc'){ // buscar en docente
        }else {
            return null;
        }
    }
    public function obtenerPermisosUsuario($perfil_id,$usuTipo){
        $permisos=[];
        if($usuTipo=='adm'){
            $modulos = DB::select("select * from modulos m where activo =1 and eliminado =0 order by orden asc");
            foreach($modulos as $modulo){
                $funcionalidades = DB::select("select * from funcionalidades f where f.visible_menu=1 and f.activo =1 and f.eliminado =0 and f.modulo_id=? order by orden asc",[$modulo->id]);
                
                $_funcionalidades=[];
                foreach ($funcionalidades as $funcionalidad){
                    $_funcionalidad=[
                        'id'=>$funcionalidad->id,
                        'titulo'=>$funcionalidad->titulo,
                        'ruta'=>$funcionalidad->ruta,
                        'accion'=>$funcionalidad->accion,
                    ];
                    $_funcionalidades[]=$_funcionalidad;
                }
                $_modulo =[
                'id' => $modulo->id,
                'titulo' => $modulo->titulo,
                'icono' => $modulo->icono,
                'codigo' => $modulo->codigo,
                'funcionalidades'=>$_funcionalidades
                ];
                $permisos[]=$_modulo;
            }
            return $permisos;
        }else{
            $modulos = DB::select("select * from modulos m where activo =1 and eliminado =0 order by orden asc");
            foreach($modulos as $modulo){
                $sql = "select f.id,f.titulo,f.ruta, f.accion, p.perfil_id 
                        from funcionalidades f 
                        inner join permisos p on p.funcionalidad_id = f.id and p.perfil_id =$perfil_id
                        where f.activo =1 and f.eliminado =0 and f.modulo_id =$modulo->id order by f.orden asc";
                
                $funcionalidades = DB::select($sql);
                
                $_funcionalidades=[];
                foreach ($funcionalidades as $funcionalidad){
                    $_funcionalidad=[
                        'id'=>$funcionalidad->id,
                        'titulo'=>$funcionalidad->titulo,
                        'ruta'=>$funcionalidad->ruta,
                        'accion'=>$funcionalidad->accion,
                    ];
                    $_funcionalidades[]=$_funcionalidad;
                }
                $_modulo =[
                'id' => $modulo->id,
                'titulo' => $modulo->titulo,
                'icono' => $modulo->icono,
                'codigo' => $modulo->codigo,
                'funcionalidades'=>$_funcionalidades
                ];
                $permisos[]=$_modulo;
            }
            return $permisos;
        }

    }

    public function obtenerUsuarioSession($session_id,$proyecto_id){
        $sql = "select pe.nombres , pe.primer_apellido , pe.segundo_apellido, pe.ci, pe.ci_exp 
                ,pr.id as proyecto_id, pr.nombre as proyecto, pr.modelos, pu.es_propietario , u.login as username, st.usuario_id 
                from session_token st 
                inner join personas pe on pe.id=st.usuario_id 
                inner join proyectos_usuarios pu on pu.usuario_id =pe.id
                inner join usuarios u on u.id=pe.id
                inner join proyectos pr on pr.id=pu.proyecto_id 
                where st.id='$session_id' and pr.id=$proyecto_id";
        $usuarios = DB::select($sql);
        if(count($usuarios)>0){
            return $usuarios[0];
        }else{
            return null;
        }
    } 
    
    public function obtenerusuarioproys($usuario_id){
        $sql = "select st.id as session_id, pu.proyecto_id  
        from session_token st 
        inner join personas pe on pe.id=st.usuario_id 
        inner join proyectos_usuarios pu on pu.usuario_id =pe.id
        inner join usuarios u on u.id=pe.id
        inner join proyectos pr on pr.id=pu.proyecto_id 
        where u.id=$usuario_id";
        $usuarios = DB::select($sql);
        if(count($usuarios)>0){
            return $usuarios[0];
        }else{
            return null;
        }
    }
    
}


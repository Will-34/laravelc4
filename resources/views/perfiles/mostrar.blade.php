@extends('layouts.master')
@section('titulo', $parControl['titulo'])

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Mostrar Perfil</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <a class="btn btn-primary" href="{{route('perfiles.index')}}">Listado</a>
                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                    </div>
                    <div class="ibox-content">
                        <form >
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10"><input type="text" class="form-control" value="{{$perfil->nombre}}" disabled=""></div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Activo</label>
                                <div class="col-sm-10">
                                    @if ($perfil->activo) 
                                        <span class="label label-primary">SI</span> 
                                    @else 
                                        <span class="label label-warning">NO</span> 
                                    @endif    
                                </div>
                            </div>

                            <div class="form-group row"><label class="col-sm-2 col-form-label">Permisos </label>

                                <div class="col-sm-10">
                                    @foreach ($modulos as $modulo)
                                        <div class="i-checks"><label><strong>{{$modulo->titulo}}</strong></label></div>
                                        @foreach($modulo->funcionalidades as $funcionalidad)
                                            <div class="i-checks">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <label> <input type="checkbox" disabled=""  @if($funcionalidad->perfil_id) checked="" @endif> <i></i>{{$funcionalidad->titulo}}</label>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Creado</label>
                                <div class="col-sm-10"><input type="text" class="form-control" value="{{fecha_latina($perfil->created_at) }}" disabled=""></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@stop

@extends('layouts.master')
@section('titulo', $parControl['titulo'])

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Agregar Persona</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <a class="btn btn-primary" href="{{route('personas.index')}}">Listado</a>
                        <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                    </div>
                    <div class="ibox-content">
                        <form action="{{route("personas.insertar")}}" method="post">
                            @csrf
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nombres:<i class="text-danger">*</i></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombres" value="{{old('nombres')}}" required="">
                                </div>
                            </div>
                            @error('nombres')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror
                            {{-- comienzo --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Primer Apellido:<i class="text-danger">*</i></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="primer_apellido" value="{{old('primer_apellido')}}" required="">
                                </div>
                            </div>
                            @error('primer_apellido')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror
                            {{-- fin --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Segundo Apellido:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="segundo_apellido" value="{{old('segundo_apellido')}}" >
                                </div>
                            </div>
                            @error('segundo_apellido')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Genero:<i class="text-danger">*</i></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="genero"  id="genero">
                                        <option value="" @if(old('')=='') selected="" @endif></option>
                                        <option value="M" @if(old('genero')=='M') selected="" @endif>Masculino</option>
                                        <option value="F" @if(old('genero')=='F') selected="" @endif>Femenino</option>
                                        <option value="O" @if(old('ci_exp')=='O') selected="" @endif>Otros</option>
                                        
                                    </select>
                                </div>
                            </div>
                            @error('genero')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Carnet de identidad:<i class="text-danger">*</i></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ci" value="{{old('ci')}}" required="">
                                </div>
                            </div>
                            @error('ci')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror
                        
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Expedido:<i class="text-danger">*</i></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="ci_exp"  id="ci_exp">
                                        <option value="" @if(old('')=='') selected="" @endif></option>
                                        <option value="CH" @if(old('ci_exp')=='CH') selected="" @endif>Chuquisaca</option>
                                        <option value="LP" @if(old('ci_exp')=='LP') selected="" @endif>La Paz</option>
                                        <option value="CB" @if(old('ci_exp')=='CB') selected="" @endif>Cochabamba</option>
                                        <option value="OR" @if(old('ci_exp')=='OR') selected="" @endif>Oruro</option>
                                        <option value="PT" @if(old('ci_exp')=='PT') selected="" @endif>Potosi</option>
                                        <option value="TJ" @if(old('ci_exp')=='TJ') selected="" @endif>Tarija</option>
                                        <option value="SC" @if(old('ci_exp')=='SC') selected="" @endif>Santa Cruz</option>
                                        <option value="BE" @if(old('ci_exp')=='BE') selected="" @endif>Beni</option>
                                        <option value="PD" @if(old('ci_exp')=='PD') selected="" @endif>Pando</option>
                                        
                                    </select>
                                </div>
                            </div>
                            @error('ci_exp')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fecha de nacimiento:<i class="text-danger">*</i></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" required="">
                                </div>
                            </div>
                            @error('fecha_nacimiento')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror
                        
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Celular:<i class="text-danger">*</i></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="celular" value="{{old('celular')}}" required="">
                                </div>
                            </div>
                            @error('celular')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror
                        
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Telefono:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telefono" value="{{old('telefono')}}" >
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Direccion:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="direccion" value="{{old('direccion')}}" >
                                </div>
                            </div>
                            @error('direccion')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Correo:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="correo" value="{{old('correo')}}">
                                </div>
                            </div>
                            @error('correo')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Activo</label>
                                <div class="col-sm-10">
                                    <div class="i-checks">
                                        <label> <input type="radio" value="1" name="activo" @if(old('activo')=='1') checked="" @endif> <i></i>SI</label>&nbsp;&nbsp;
                                        <label> <input type="radio" value="0" name="activo" @if(old('activo')=='0') checked="" @endif> <i></i>NO</label>
                                    </div>
                                </div>
                            </div>
                            @error('activo')
                                <div class="alert alert-danger alert-dismissable">{{$message}}<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>
                            @enderror
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-success " type="submit">Guardar</button>
                                    <button class="btn btn-danger " type="button" onclick="location.href='{{route('personas.index')}}'">Cancelar</button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@stop

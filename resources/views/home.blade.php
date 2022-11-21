@extends('layouts.master')
@section('titulo', $parControl['titulo'])

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <h2>Bienvenid@ {{ session('nombre') }} </h2>
    </div>
    <td><a style="background-color: #1FA41E" target="_blank" href="http://localhost:3000/?session_id={{ session('sesionid')}}&p=2" class="btn btn-success">proyecto &gt;Click&lt;</a></td>
@stop

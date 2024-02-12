@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.monedas.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.monedas.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de tipos monedas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Taza de Cambio</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monedas as $moneda)
                        <tr>
                            <td>{{$moneda->id}}</td>
                            <td>{{$moneda->name}}</td>
                            <td>{{$moneda->tasa_cambio}}</td>
                            <td width="10px">
                                @can('admin.monedas.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.monedas.edit',$moneda)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

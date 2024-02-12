@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.cuentas.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.cuentas.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de cuentas</h1>
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
                        <th>Cuenta de Gasto</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuentas as $cuenta)
                        <tr>
                            <td>{{$cuenta->id}}</td>
                            <td>{{$cuenta->name}}</td>
                            <td width="10px">
                                @can('admin.cuentas.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.cuentas.edit',$cuenta)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

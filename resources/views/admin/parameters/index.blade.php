@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.parameters.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.parameters.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de Parametros</h1>
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
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parameters as $parameter)
                        <tr>
                            <td>{{$parameter->id}}</td>
                            <td>{{$parameter->name}}</td>
                            <td>{{$parameter->value}}</td>
                            <td width="10px">
                                @can('admin.parameters.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.parameters.edit',$parameter)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

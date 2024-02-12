@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.valueTypes.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.valueTypes.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de tipos de valor</h1>
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
                    @foreach ($valueTypes as $tipo)
                        <tr>
                            <td>{{$tipo->id}}</td>
                            <td>{{$tipo->name}}</td>
                            <td width="10px">
                                @can('admin.valueTypes.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.valueTypes.edit',$tipo)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

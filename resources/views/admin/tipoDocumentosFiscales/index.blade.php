@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.tipoDocumentosFiscales.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.tipoDocumentosFiscales.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de tipos de documentos fiscales</h1>
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
                    @foreach ($docsFiscalesTipos as $tipo)
                        <tr>
                            <td>{{$tipo->id}}</td>
                            <td>{{$tipo->name}}</td>
                            <td width="10px">
                                @can('admin.tipoDocumentosFiscales.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.tipoDocumentosFiscales.edit',$tipo)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

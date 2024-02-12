@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.roles.create')}}">Nuevo rol</a>
    <h1>Listado de roles</h1>
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
                        <th>Role</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{$rol->id}}</td>
                            <td>{{$rol->name}}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('admin.roles.edit',$rol)}}">Editar</a>
                                @can('admin.roles.edit')
                                @endcan
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

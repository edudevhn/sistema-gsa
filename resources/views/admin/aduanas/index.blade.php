@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.aduanas.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.aduanas.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de Aduanas</h1>
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
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($aduanas as $aduana)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$aduana->name}}</td>
                                @if ($aduana->status==1)
                                    <td>BAJA</td>        
                                @else
                                    <td>ALTA</td>        
                                @endif
                            <td width="10px">
                                @can('admin.aduanas.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.aduanas.edit',$aduana)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

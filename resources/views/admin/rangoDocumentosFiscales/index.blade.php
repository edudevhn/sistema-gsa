@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.rangoDocumentosFiscales.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.rangoDocumentosFiscales.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de rangos de documentos fiscales</h1>
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
                        <th>Tipo Documento</th>
                        <th>Numero Inicial</th>
                        <th>Numero Final</th>
                        <th>Cantidad Otorgada</th>
                        <th>Cantidad Emitidas</th>
                        <th>Fecha limite de emision</th>
                        <th>Numero CAI</th>
                        <th>Estado</th>
                        <th>Fecha Cierre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index=1;
                    @endphp
                    @foreach ($docsFiscalesRangos as $rango)
                        <tr>
                            <td>{{$index}}</td>
                            <td>{{$rango->documentoTipo->name}}</td>
                            <td>{{$rango->numero_inicial}}</td>
                            <td>{{$rango->numero_final}}</td>
                            <td>{{$rango->cantidad_otorgada}}</td>
                            <td>{{$rango->cantidad_emitidas}}</td>
                            <td>{{$rango->fecha_limite_emision}}</td>
                            <td>{{$rango->numero_cai}}</td>
                            <td>{{$rango->status}}</td>
                            <td>{{$rango->fecha_cierre}}</td>
                            <td width="10px">
                                @can('admin.rangoDocumentosFiscales.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.rangoDocumentosFiscales.edit',$rango)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

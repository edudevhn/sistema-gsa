@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.facturas.create')}}">Nuevo Documento</a>
    <h1>Listado de Documentos Ficales</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.facturas-index')



    @livewire('admin.notas-debito-index')
@stop

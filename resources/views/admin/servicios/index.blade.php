@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.servicios.create')}}">Nuevo Servicio</a>
    <h1>Listado de Servicios</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.servicios-index')
@stop

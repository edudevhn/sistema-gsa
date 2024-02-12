@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.cotizaciones.create')}}">Nueva Cotizacion</a>
    <h1>Listado de Cotizaciones</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.cotizaciones-index')
@stop

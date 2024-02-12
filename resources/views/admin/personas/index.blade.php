@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.personas.create')}}">Nueva Persona</a>
    <h1>Listado de Personas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.personas-index')
@stop

@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.pagos.create')}}">Nuevo Pago</a> --}}
    <h1>Listado de Pagos a Documentos Fiscales</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.pagos-index')



@stop

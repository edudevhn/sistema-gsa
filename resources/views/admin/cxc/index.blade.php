@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.costos.create')}}">Nuevo Costo/ Gasto</a> --}}
    <h1>Estado de Cuentas Por Cobrar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.cxc.generarPDF', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal' ,'target'=>"_blank"]) !!} 
        <div class="row">
            <div class="form-group col-md-12">
                @livewire('admin.persona-select',['idEdit' =>  null])
            </div>
            {{-- <div class="form-group col-md-4">
                {!! Form::label('fechaInicio', 'Desde Fecha') !!}
                {!! Form::date('fechaInicio',null, ['wire:model'=>"fechaInicio",'class'=>'form-control','placeholder'=>'Tipo de Costo de Embarque']) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('fechaFin', 'Hasta Fecha') !!}
                {!! Form::date('fechaFin',null, ['class'=>'form-control','placeholder'=>'Tipo de Costo de Embarque']) !!}
            </div> --}}
            {{-- <a class="btn btn-danger btn-sm float-right" href="{{route('admin.proformas.generarPDF',$documento)}}" target="_blank">PDF</a>                                  --}}
            {!! Form::submit('Generar Reporte', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
    {{-- @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.cuentas-x-cobrar-index')
 --}}


@stop

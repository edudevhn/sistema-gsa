@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Nueva Tipo de Persona</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.tipoPersonas.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre del Persona']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {!! Form::submit('Crear Persona', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Nuevo Parametro</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.parameters.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre del parametro']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('value', 'Nombre') !!}
                    {!! Form::text('value', null, ['class'=>'form-control','placeholder'=>'Ingrese el valor del parametro']) !!}

                    @error('value')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {!! Form::submit('Crear parametro', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

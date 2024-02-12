
@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Nueva cuenta de Gasto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.cuentas.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Cuenta de Gasto') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre del cuenta']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {!! Form::submit('Crear Cuenta de Gasto', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

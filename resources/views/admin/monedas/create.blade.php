@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Nueva moneda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.monedas.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese las siglas de la moneda']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('tasa_cambio', 'Valor de la taza de cambio en HNL') !!}
                    {!! Form::text('tasa_cambio', null, ['class'=>'form-control','placeholder'=>'Ingrese de la taza de cambio HNL']) !!}
                
                    @error('tasa_cambio')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {!! Form::submit('Crear moneda', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

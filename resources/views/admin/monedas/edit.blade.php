@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Modificar moneda</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($moneda,['route'=>['admin.monedas.update',$moneda],'method'=>'put']) !!}
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
                {!! Form::submit('Actualizar moneda', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

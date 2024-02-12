@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Modificar Cuenta de Gasto</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($cuenta,['route'=>['admin.cuentas.update',$cuenta],'method'=>'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Cuenta de Gasto') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre de la cuenta']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('value_type_id', 'Tipo de Cuenta') !!}
                    {!! Form::select('value_type_id', $valueTypes, null, ['class'=>'form-control']) !!}                
                    @error('value_type_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {!! Form::submit('Actualizar Cuenta de Gasto', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

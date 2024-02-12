@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Modificar Tipo de persona</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($tipoPersona,['route'=>['admin.tipoPersonas.update',$tipoPersona],'method'=>'put']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre de tipo de Persona']) !!}

                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
                {!! Form::submit('Actualizar tipo de persona', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

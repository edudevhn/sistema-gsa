@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Nueva Aduana</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.aduanas.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre de Aduana') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el Nombre de la Aduana']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">Estado</p>
                    <label >
                        {!! Form::radio('status', 1) !!}
                        Baja
                    </label>
                
                    <label >
                        {!! Form::radio('status', 2,true) !!}
                        Alta
                    </label>
                    @error('status')
                        <br>
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {!! Form::submit('Crear aduana', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

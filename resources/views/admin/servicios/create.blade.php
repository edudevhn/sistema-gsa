@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear servicio </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.servicios.store', 'autocomplete'=>'off','files'=>true]) !!}
                @include('admin.servicios.partials.form')
                {!! Form::submit('Crear servicio', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop
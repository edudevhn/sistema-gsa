@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Costo / Gasto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.costos.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!} 
                @include('admin.costos.partials.form')
                {!! Form::submit('Crear Costo', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop


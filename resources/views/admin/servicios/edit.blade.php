@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Editar servicio</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>

    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($servicio,['route'=>['admin.servicios.update',$servicio], 'autocomplete'=>'off','files'=>true,'method'=>'PUT']) !!}
                
                @include('admin.servicios.partials.form')
                {!! Form::submit('Actualizar servicio', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop


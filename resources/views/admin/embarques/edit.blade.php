@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Editar Embarque</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>

    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($data,['route'=>['admin.embarques.update',$data], 'autocomplete'=>'off','files'=>true,'method'=>'PUT']) !!}
                
                @include('admin.embarques.partials.form')
                {!! Form::submit('Actualizar Embarque', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop


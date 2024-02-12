@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Editar Factura</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>

    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($factura,['route'=>['admin.documentosFiscales.update',$factura], 'autocomplete'=>'off','files'=>true,'method'=>'PUT']) !!}
                
                @include('admin.documentosFiscales.partials.form')
                {!! Form::submit('Actualizar Factura', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

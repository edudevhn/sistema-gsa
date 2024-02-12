@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Factura </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{$embarque}}
            {!! Form::model($embarque,['route'=>['admin.documentosFiscales.store',$embarque], 'autocomplete'=>'off','files'=>true,'method'=>'POST']) !!}
                
            {{-- {!! Form::open(['route'=>'admin.facturas.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!} --}}
                @include('admin.documentosFiscales.partials.form')
                {!! Form::submit('Crear Factura', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
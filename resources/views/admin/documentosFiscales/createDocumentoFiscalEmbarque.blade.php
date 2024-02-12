@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Factura </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- {{$data}} --}}
            {!! Form::open(['route'=>'admin.documentosFiscales.storeDocumentoFiscalEmbarque', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!}
                @include('admin.documentosFiscales.partials.form')
                {!! Form::submit('Crear Factura', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop
@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Agregar Pago </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- {{$data}} --}}
            {!! Form::open(['route'=>'admin.pagos.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!}
                @include('admin.pagos.partials.form')
                {!! Form::submit('Agregar Pago', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop
@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Costo / Gasto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- {!! Form::open(['route'=>'admin.costos.storePago', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!}  --}}
            {!! Form::model($costo,['route'=>['admin.costos.storePago',$costo], 'autocomplete'=>'off','files'=>true,'method'=>'PUT']) !!}
                {!! Form::hidden('costo_id',isset($costo) ? $costo->id : null, ['class'=>'form-control','readonly']) !!}
                @include('admin.costos.partials.form-pa')
                {!! Form::submit('Guardar Pago', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop


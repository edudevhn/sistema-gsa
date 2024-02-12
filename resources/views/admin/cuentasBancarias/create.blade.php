@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Nueva Cuenta Bancaria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.cuentasBancarias.store']) !!}
                <div class="form-group">
                    {!! Form::label('num', 'Nombre') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre de la Cuenta Bancaria']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('num_cuenta', 'Numero de Cuenta') !!}
                    {!! Form::text('num_cuenta', null, ['class'=>'form-control','placeholder'=>'Ingrese Numero de Cuenta']) !!}

                    @error('num_cuenta')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>                
                <div class="form-group">
                    {!! Form::label('beneficiario', 'Nombre de Beneficiario') !!}
                    {!! Form::text('beneficiario', null, ['class'=>'form-control','placeholder'=>'Ingrese Numero de Cuenta']) !!}

                    @error('beneficiario')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>                
                <div class="form-group">
                    {!! Form::label('rtn', 'RTN ') !!}
                    {!! Form::text('rtn', null, ['class'=>'form-control','placeholder'=>'Ingrese Numero de Cuenta']) !!}

                    @error('rtn')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>                
                <div class="form-group">
                    @livewire('admin.select-bancos',['idEdit' =>  null])
                </div>
                <div class="form-group">
                    @livewire('admin.select-tipo-cuentas',['idEdit' =>  null])
                </div>
                <div class="form-group">
                    {!! Form::label('moneda_id', 'Moneda') !!}
                    {!! Form::select('moneda_id', $monedas, null, ['class'=>'form-control']) !!}                
                    @error('moneda_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">Predeterminada</p>
                    <label >
                        {!! Form::radio('predeterminada', 1) !!}
                        NO
                    </label>
                
                    <label >
                        {!! Form::radio('predeterminada', 2,true) !!}
                        SI
                    </label>
                    @error('predeterminada')
                        <br>
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
                {!! Form::submit('Crear Cuenta Bancaria', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

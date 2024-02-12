@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Modificar Cuenta Bancaria</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($cuentasBancaria,['route'=>['admin.cuentasBancarias.update',$cuentasBancaria],'method'=>'put']) !!}
                <div class="form-group">
                    {!! Form::label('num', 'Nombre') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre de la Cuenta Bancaria']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('num_cuenta', 'Numero de Cuenta ') !!}
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
                    @livewire('admin.select-bancos',['idEdit' => isset($cuentasBancaria) ? $cuentasBancaria->banco_id : null])
                    @error('banco_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    @livewire('admin.select-tipo-cuentas',['idEdit' => isset($cuentasBancaria) ? $cuentasBancaria->tipo_cuenta_id : null])
                    @error('tipo_cuenta_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
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
                {!! Form::submit('Actualizar Cuenta Bancaria', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

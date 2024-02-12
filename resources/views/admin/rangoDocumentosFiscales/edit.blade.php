@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Modificar Rango de Documento Fiscal</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($rangoDocumentosFiscale,['route'=>['admin.rangoDocumentosFiscales.update',$rangoDocumentosFiscale],'method'=>'put']) !!}
                <div class="form-group">
                    {!! Form::label('numero_inicial', 'Numero Inicial') !!}
                    {!! Form::text('numero_inicial', null, ['class'=>'form-control','placeholder'=>'Ingrese el Numero Inicial del documento fiscal']) !!}

                    @error('numero_inicial')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('numero_final', 'Numero Final') !!}
                    {!! Form::text('numero_final', null, ['class'=>'form-control','placeholder'=>'Ingrese el Numero Final del documento fiscal']) !!}

                    @error('numero_final')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('cantidad_otorgada', 'Cantidad Otorgada') !!}
                    {!! Form::text('cantidad_otorgada', null, ['class'=>'form-control','placeholder'=>'Ingrese el Cantidad Otorgada del documento fiscal']) !!}

                    @error('cantidad_otorgada')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    {!! Form::label('cantidad_emitidas', 'Cantidad Emitidas') !!}
                    {!! Form::text('cantidad_emitidas', null, ['class'=>'form-control','placeholder'=>'Ingrese el Cantidad Emitidas del documento fiscal']) !!}

                    @error('cantidad_emitidas')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div> --}}
                <div class="form-group">
                    {!! Form::label('fecha_limite_emision', 'Fecha Limite de emision') !!}
                    {!! Form::date('fecha_limite_emision', null, ['class'=>'form-control']) !!}

                    @error('fecha_limite_emision')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('numero_cai', 'CAI') !!}
                    {!! Form::text('numero_cai', null, ['class'=>'form-control','placeholder'=>'Ingrese el CAI del documento fiscal']) !!}

                    @error('numero_cai')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    {!! Form::label('status', 'Estado') !!}
                    {!! Form::text('status', null, ['class'=>'form-control','placeholder'=>'Ingrese el Estado del documento fiscal']) !!}

                    @error('status')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('fecha_cierre', 'Fecha de Cierre') !!}
                    {!! Form::text('fecha_cierre', null, ['class'=>'form-control','placeholder'=>'Ingrese el Fecha de Cierre del documento fiscal']) !!}

                    @error('fecha_cierre')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div> --}}
                <div class="form-group">
                    {!! Form::label('documento_tipo_id', 'Tipo de Documento') !!}
                    {!! Form::select('documento_tipo_id', $tipoDocumento, null, ['class'=>'form-control']) !!}                
                    @error('documento_tipo_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {!! Form::submit('Actualizar rango documento fiscal', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

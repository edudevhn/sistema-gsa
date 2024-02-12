<div class="row">
    <div class="form-group col-md-12">
        {!! Form::hidden('documento_fiscal_id',isset($documentoFiscal) ? $documentoFiscal->id : null, ['class'=>'form-control','readonly']) !!}
    
        @error('documento_fiscal_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        {!! Form::hidden('pago_id', isset($pago) ? $pago->id : null , ['class'=>'form-control','readonly']) !!}
    
        @error('pago_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        {!! Form::label('num_documento', '#Recibo') !!}
        {!! Form::text('num_documento', null, ['class'=>'form-control','placeholder'=>'Numero de Recibo','readonly']) !!}
    
        @error('num_documento')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        
        {!! Form::label('id_persona', 'Pago Realizado Por') !!}
        @livewire('admin.persona-select',['idEdit' => isset($documentoFiscal) ? $documentoFiscal->embarque->persona_id : null])
       
    </div>

    <div class="form-group col-md-4">
       
        <div class="form-group">
            {!! Form::label('cliente', 'Cliente') !!}
            {!! Form::text('cliente', isset($documentoFiscal) ? $documentoFiscal->embarque->persona->name : null, ['class'=>'form-control','placeholder'=>'Metodo de Pago','disabled'=>true]) !!}

            @error('metodo_pago')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        @livewire('admin.select-metodo-pago')
        <div class="form-group">
            {!! Form::label('referencia_pago', 'Referencia de Pago') !!}
            {!! Form::text('referencia_pago', null, ['class'=>'form-control','placeholder'=>'Referencia de Pago']) !!}

            @error('referencia_pago')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        @livewire('admin.select-bancos',['idEdit' => isset($pago) ? $pago->banco_id : null])

    </div>
    
    <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('fecha_pago', 'Fecha de Pago') !!}
            {!! Form::date('fecha_pago', null, ['class'=>'form-control','placeholder'=>'Fecha de Pago']) !!}
            @error('fechaVencimiento')
                <span class="fecha_pago-danger">{{$message}}</span>
            @enderror
        </div>
        {{-- <div class="form-group">
            {!! Form::label('descripcion', 'descripcion') !!}
            {!! Form::text('descripcion', null, ['class'=>'form-control','placeholder'=>'Ingrese descripcion']) !!}

            @error('descripcion')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div> --}}
        <div class="form-group">
            {!! Form::label('num_constancia_referencia', 'Constancia de Rentencion No.:') !!}
            {!! Form::text('num_constancia_referencia', null, ['class'=>'form-control','placeholder'=>'Ingrese Constancia de Rentencion No.:']) !!}

            @error('num_constancia_referencia')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @livewire('admin.select-cuenta-bancaria',['idEdit' => isset($pago) ? $pago->cuenta_bancaria_id : null])
        {{-- <div class="form-group">
            <div class="form-group">
                {!! Form::label('moneda_id', 'Moneda') !!}
                {!! Form::select('moneda_id', $monedas->sortBy('id')->pluck('name', 'id'), isset($pago) ? $pago->monedad_id : null, ['class'=>'form-control']) !!}                
                @error('moneda_id')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('valor_facturado', 'Valor Facturado:') !!}
            {!! Form::text('valor_facturado', isset($documentoFiscal) ? $documentoFiscal->total : null, ['class'=>'form-control','placeholder'=>'Valor Facturado:','readonly']) !!}

            @error('valor_facturado')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('pago_recibido', 'Pago Recibido:') !!}
            {!! Form::text('pago_recibido',  null, ['class'=>'form-control','placeholder'=>'Pago Recibido:']) !!}

            @error('pago_recibido')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('num_constancia_referencia', 'Constancia de Rentencion No.:') !!}
            {!! Form::text('num_constancia_referencia', null, ['class'=>'form-control','placeholder'=>'Ingrese Constancia de Rentencion No.:']) !!}

            @error('num_constancia_referencia')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div> --}}
    </div>
    <div class="form-group col-md-12">
        @livewire('admin.calculo-pago',['documentoFiscal' => isset($documentoFiscal) ? $documentoFiscal : null])
    </div>
    
    <div class="form-group col-md-6">
        <div class="form-group">
            {!! Form::label('observaciones', 'Observaciones:') !!}  
            {!! Form::textarea('observaciones', null, ['class'=>'form-control','rows'=>3]) !!}
            
            @error('observaciones')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>

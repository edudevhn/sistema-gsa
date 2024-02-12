<div class="row">
    <div class="form-group col-md-2 offset-md-2">
        {!! Form::label('valor_facturado', 'Valor Facturado:') !!}
        {!! Form::text('valor_facturado', isset($documentoFiscal) ? $documentoFiscal->total : null, [ 'class'=>'form-control','placeholder'=>'Valor Facturado:','readonly','wire:model.defer'=>"valor_facturado"]) !!}

        @error('valor_facturado')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('pago_recibido', 'Pagos Recibido:') !!}
        {!! Form::text('pago_recibido',  null, ['class'=>'form-control','placeholder'=>'Total Pago:','wire:model.defer'=>"pago_recibido",'readonly']) !!}

        @error('pago_recibido')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('saldo_actual', 'Saldo Actual:') !!}
        {!! Form::text('saldo_actual',  null, ['class'=>'form-control','placeholder'=>'Total Pago:','wire:model.defer'=>"saldo_actual",'readonly']) !!}

        @error('saldo_actual')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('total_pago_aplicado', 'Total Pago Aplicado:') !!}
        {!! Form::text('total_pago_aplicado',  null, ['class'=>'form-control','placeholder'=>'Saldo:','wire:model.defer'=>"total_pago_aplicado",'readonly']) !!}

        @error('total_pago_aplicado')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('saldo', 'Saldo:') !!}
        {!! Form::text('saldo',  null, ['class'=>'form-control','placeholder'=>'Saldo:','wire:model.defer'=>"saldo",'readonly']) !!}

        @error('saldo')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-2 offset-md-6">
        {!! Form::label('moneda_id', 'Moneda') !!}
        {!! Form::select('moneda_id', $monedas->sortBy('id')->pluck('name', 'id'), isset($pago) ? $pago->monedad_id : null, ['class'=>'form-control']) !!}                
        @error('moneda_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('pago_actual', 'Pago Actual:') !!}
        {!! Form::text('pago_actual',  null, ['class'=>'form-control','placeholder'=>'Pago Recibido:','wire:model.defer'=>"pago_actual", 'wire:change'=>"calcularPago"]) !!}

        @error('pago_actual')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('valor_retencion', 'Valor Retención:') !!}
        {!! Form::text('valor_retencion',  null, ['class'=>'form-control','placeholder'=>'Valor Retención:','wire:model.defer'=>"valor_retencion", 'wire:change'=>"calcularPago"]) !!}

        @error('valor_retencion')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>

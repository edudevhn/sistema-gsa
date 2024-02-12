<div class="row">
    <div class="form-group col-md-12">
        {!! Form::hidden('embarque_id', $embarque->id, ['class'=>'form-control','readonly']) !!}
    
        @error('embarque_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        {!! Form::label('num_documento', '#Proforma') !!}
        {!! Form::text('num_documento', null, ['class'=>'form-control','placeholder'=>'Numero de Proforma','readonly']) !!}
    
        @error('num_documento')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        @livewire('admin.persona-select',['idEdit' => isset($embarque) ? $embarque->persona_id : null,'showSearchChange' => isset($embarque) ? false : true])
        <div class="form-group">
            {!! Form::label('no_sag', 'Nº identificativo del registro de la SAG:') !!}
            {!! Form::text('no_sag', null, ['class'=>'form-control','placeholder'=>'Ingrese Nº identificativo del registro de la SAG:']) !!}

            @error('no_sag')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('no_compra_externa', 'Nº Correlativo de Orden de Compra Exenta:') !!}
            {!! Form::text('no_compra_externa', isset($embarque) ? $embarque->no_compra_externa : null, ['class'=>'form-control','placeholder'=>'Ingrese Nº Correlativo de Orden de Compra Exenta:']) !!}

            @error('no_compra_externa:')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="form-group col-md-4">
        {{-- <div class="form-group">
            {!! Form::label('fechaEmision', 'Fecha de Emision') !!}
            {!! Form::date('fechaEmision', isset($embarque) ? $embarque->fecha_emision : null, ['class'=>'form-control','placeholder'=>'Fecha Emision']) !!}

            @error('fechaEmision')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('fechaVencimiento', 'Fecha de Vencimiento') !!}
            {!! Form::date('fechaVencimiento', isset($embarque) ? $embarque->no_compra_externa : null, ['class'=>'form-control','placeholder'=>'Ingrese Fecha de Vencimiento']) !!}

            @error('fechaVencimiento')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
         --}}
        @livewire('admin.fecha-vencimineto',['fechaEmision' => isset($embarque) ? $embarque->fecha_emision : null,'fechaVencimiento' => isset($embarque) ? $embarque->fecha_vencimiento : null,'diasCredito' => isset($embarque) ? $embarque->persona->dias_pago : null])        
        @livewire('admin.select-aduanas',['idEdit' => isset($embarque) ? $embarque->aduana_id : null])        
        @livewire('admin.select-lugar-entrega',['idEdit' => isset($embarque) ? $embarque->lugar_entrega_id : null])
        <div class="form-group">
            {!! Form::label('peso', 'Detalle de Carga:') !!}
            {!! Form::text('peso', null, ['class'=>'form-control','placeholder'=>'Ingrese Detalle de Carga:']) !!}

            @error('peso')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('equipo', 'No. Equipo:') !!}
            {!! Form::text('equipo', null, ['class'=>'form-control','placeholder'=>'Ingrese Equipo:']) !!}

            @error('equipo')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        {{-- <div class="form-group">
            {!! Form::label('num_referencia', 'Referencia Interna:') !!}
            {!! Form::text('num_referencia', null, ['class'=>'form-control','placeholder'=>'Ingrese Referencia Interna:']) !!}

            @error('num_referencia')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div> --}}
        <div class="form-group">
            {!! Form::label('num_embarque', 'No Embarque:') !!}
            {!! Form::text('num_embarque', isset($embarque) ? $embarque->num_embarque : null, ['class'=>'form-control','placeholder'=>'No. Embarque:','readonly']) !!}

            @error('noEmbarque')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('embarcador', 'Embarcador') !!}
            {!! Form::text('embarcador', null, ['class'=>'form-control','placeholder'=>'Ingrese Embarcador']) !!}

            @error('embarcador')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('consignatario', 'Consignatario') !!}
            {!! Form::text('consignatario', null, ['class'=>'form-control','placeholder'=>'Ingrese consignatario']) !!}

            @error('consignatario')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @livewire('admin.select-lugar-embarque',['idEdit' => isset($embarque) ? $embarque->lugar_embarque_id : null])
        @livewire('admin.select-lugar-entrega',['idEdit' => isset($embarque) ? $embarque->lugar_entrega_id : null])
        <div class="form-group">
            {!! Form::label('no_booking', 'No Booking:') !!}
            {!! Form::text('no_booking', null, ['class'=>'form-control','placeholder'=>'Ingrese No. Booking / Master Doc::']) !!}

            @error('no_booking')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('no_documento_transporte', 'No. Documento Transporte:') !!}
            {!! Form::text('no_documento_transporte', null, ['class'=>'form-control','placeholder'=>'Ingrese No. Documento Transporte:']) !!}

            @error('no_documento_transporte')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @livewire('admin.select-aduanas',['idEdit' => isset($embarque) ? $embarque->aduana_id : null])
        <div class="form-group">
            {!! Form::label('duca', 'No DUCA:') !!}
            {!! Form::text('duca', null, ['class'=>'form-control','placeholder'=>'No. DUCA:']) !!}

            @error('duca')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    {{-- <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('pieza', 'Pieza:') !!}
            {!! Form::text('pieza', null, ['class'=>'form-control','placeholder'=>'Ingrese Pieza:']) !!}

            @error('pieza')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('peso', 'Peso:') !!}
            {!! Form::text('peso', null, ['class'=>'form-control','placeholder'=>'Ingrese Peso:']) !!}

            @error('peso')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('equipo', 'No. Equipo:') !!}
            {!! Form::text('equipo', null, ['class'=>'form-control','placeholder'=>'Ingrese Equipo:']) !!}

            @error('equipo')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @livewire('admin.select-aduanas',['idEdit' => isset($embarque) ? $embarque->aduana_id : null])
        <div class="form-group">
            {!! Form::label('destinofinal', 'Destino Final:') !!}
            {!! Form::text('destinofinal', null, ['class'=>'form-control','placeholder'=>'Ingrese Destino Final:']) !!}

            @error('destinofinal')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('referenciaInterna', 'Referencia Interna:') !!}
            {!! Form::text('referenciaInterna', null, ['class'=>'form-control','placeholder'=>'Ingrese Referencia Interna:']) !!}

            @error('referenciaInterna')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('duca', 'DUCA:') !!}
            {!! Form::text('duca', null, ['class'=>'form-control','placeholder'=>'Ingrese No.DUCA:']) !!}

            @error('duca')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div> --}}
    <!-- Otros elementos de la factura -->
    @livewire('admin.add-servicio',['moneda_id' => isset($embarque) ? $embarque->moneda_id : null])
    
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

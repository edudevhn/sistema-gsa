<div class="row">
    @isset($embarque)
    {{$embarque}}
        
    @endisset
    <div class="form-group col-md-12">
        {!! Form::label('num_embarque', '#Embarque') !!}
        {!! Form::text('num_embarque', null, ['class'=>'form-control','placeholder'=>'Numero de Embarque','readonly']) !!}
    
        @error('num_embarque')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        @livewire('admin.persona-select',['idEdit' => isset($data) ? $data->persona_id : null,'showSearchChange' => isset($data) ? false : true])
    </div>

    <div class="form-group col-md-4">
        @livewire('admin.mercancia-select',['idEdit' => isset($data) ? $data->mercancia_id : null])
        @livewire('admin.select-servicios',['idEdit' => isset($data) ? $data->tipo_servicio_id : null])
        @livewire('admin.select-aduanas',['idEdit' => isset($data) ? $data->aduana_id : null])
        @livewire('admin.select-termino-pago',['idEdit' => isset($data) ? $data->termino_pago_id : null])
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
        {{-- @livewire('admin.select-pol',['idEdit' => isset($data) ? $data->pol_id : null])
        @livewire('admin.select-pod',['idEdit' => isset($data) ? $data->pod_id : null]) --}}
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
    </div>
    <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('fecha_valida', 'Fecha valida') !!}
            {!! Form::date('fecha_valida',  isset($data) ? $data->fecha_valida : null, ['class'=>'form-control','placeholder'=>'Fecha valida']) !!}

            @error('fecha_valida')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @livewire('admin.select-incoterms',['idEdit' => isset($data) ? $data->incoterm_id : null])
        @livewire('admin.select-lugar-embarque',['idEdit' => isset($data) ? $data->lugar_embarque_id : null])
        @livewire('admin.select-lugar-entrega',['idEdit' => isset($data) ? $data->lugar_entrega_id : null])
        @livewire('admin.select-modalidad-transporte',['idEdit' => isset($data) ? $data->modalidad_id : null])
        <div class="form-group">
            {!! Form::label('peso', 'Detalle de Carga:') !!}
            {!! Form::text('peso', null, ['class'=>'form-control','placeholder'=>'Ingrese Detalle de Carga:']) !!}

            @error('peso')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('equipo', 'Detalle de Equipo:') !!}
            {!! Form::text('equipo', null, ['class'=>'form-control','placeholder'=>'Ingrese Detalle de Equipo:']) !!}

            @error('equipo')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <div class="form-group">
                {!! Form::label('moneda_id', 'Moneda') !!}
                {!! Form::select('moneda_id', $monedas->sortBy('id')->pluck('name', 'id'), isset($data) ? $data->moneda_id : null, ['class'=>'form-control','wire:model.defer'=>"moneda_id", 'wire:change'=>"onMonedaChange"]) !!}                
                @error('moneda_id')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
    
    <div class="form-group col-md-6">
        <div class="form-group">
            {!! Form::label('no_sag', 'Nº identificativo del registro de la SAG:') !!}
            {!! Form::text('no_sag', null, ['class'=>'form-control','placeholder'=>'Ingrese Nº identificativo del registro de la SAG:']) !!}

            @error('no_sag')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('no_compra_externa', 'Nº Correlativo de Orden de Compra Exenta:') !!}
            {!! Form::text('no_compra_externa', null, ['class'=>'form-control','placeholder'=>'Ingrese Nº Correlativo de Orden de Compra Exenta:']) !!}

            @error('no_compra_externa:')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-6">
        <div class="form-group">
            {!! Form::label('notas', 'Notas:') !!}  
            {!! Form::textarea('notas', null, ['class'=>'form-control','rows'=>3]) !!}
            
            @error('notas')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>

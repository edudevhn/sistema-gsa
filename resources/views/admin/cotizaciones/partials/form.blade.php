<div class="row">
    <div class="form-group col-md-12">
        {!! Form::label('num_documento', '#Propuesta') !!}
        {!! Form::text('num_documento', null, ['class'=>'form-control','placeholder'=>'Numero de Propuesta','readonly']) !!}
    
        @error('num_documento')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        @livewire('admin.persona-select',['idEdit' => isset($cotizacione) ? $cotizacione->persona_id : null,'showSearchChange' => isset($cotizacione) ? false : true])
    </div>

    <div class="form-group col-md-4">
        @livewire('admin.mercancia-select',['idEdit' => isset($cotizacione) ? $cotizacione->mercancia_id : null])
        @livewire('admin.select-servicios',['idEdit' => isset($cotizacione) ? $cotizacione->tipo_servicio_id : null])
        @livewire('admin.select-aduanas',['idEdit' => isset($cotizacione) ? $cotizacione->aduana_id : null])
        @livewire('admin.select-termino-pago',['idEdit' => isset($cotizacione) ? $cotizacione->termino_pago_id : null])
    </div>
    <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('fecha_valida', 'Fecha valida') !!}
            {!! Form::date('fecha_valida', null, ['class'=>'form-control','placeholder'=>'Fecha validaa']) !!}

            @error('fecha_valida')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @livewire('admin.select-incoterms',['idEdit' => isset($cotizacione) ? $cotizacione->incoterm_id : null])
        @livewire('admin.select-lugar-embarque',['idEdit' => isset($cotizacione) ? $cotizacione->lugar_embarque_id : null])
        @livewire('admin.select-lugar-entrega',['idEdit' => isset($cotizacione) ? $cotizacione->lugar_entrega_id : null])
        @livewire('admin.select-modalidad-transporte',['idEdit' => isset($cotizacione) ? $cotizacione->modalidad_id : null])
    </div>
    
     <div class="form-group col-md-6">
        <div class="form-group">
            {!! Form::label('num_referencia', 'Referencia No') !!}
            {!! Form::text('num_referencia', null, ['class'=>'form-control','placeholder'=>'Referencia No']) !!}
        
            @error('modalidad_transporte')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>


<div>
    
    <!-- Otros elementos de la factura -->
    {{-- {{$listaServicios}} --}}
    @livewire('admin.agregar-servicio-create',['moneda_id' => isset($cotizacione) ? $cotizacione->moneda_id : null])
</div>

 
<div class="form-group col-md-12">
    <div class="form-group">
        {!! Form::label('notas', 'Notas:') !!}  
        {!! Form::textarea('notas', null, ['class'=>'form-control','rows'=>5]) !!}
        
        @error('notas')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
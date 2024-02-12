<div class="row">
    <div class="form-group col-md-12">
        {!! Form::hidden('costo_id',isset($costo) ? $costo->id : null, ['class'=>'form-control','readonly']) !!}
    
        @error('costo_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        @livewire('admin.persona-select',['idEdit' => isset($costo) ? $costo->proveedor_id : null])
       
    </div>
    <div class="form-group col-md-4">
        
        <div class="form-group">
            {!! Form::label('fecha_factura', 'Fecha de Factura') !!}
            {!! Form::date('fecha_factura', null, ['class'=>'form-control','placeholder'=>'Fecha de Factura','readonly']) !!}

            @error('fecha_factura')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('tipo_costo_id', 'Tipo de Gasto') !!}
            {!! Form::select('tipo_costo_id', $tipoCosto->sortBy('id')->pluck('name', 'id'), isset($costo) ? $costo->tipo_costo_id : null, ['class'=>'form-control','readonly']) !!}                
            @error('tipo_costo_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('documento_cobro', 'Documento Cobro') !!}
            {!! Form::text('documento_cobro', null, ['class'=>'form-control','placeholder'=>'Documento de Cobro','readonly']) !!}

            @error('documento_cobro')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @foreach ($costo->embarque as $item)
            @livewire('admin.select-embarque',['idEdit' => isset($item) ? $item->id : null])
        @endforeach
        @livewire('admin.select-cuenta-bancaria',['idEdit' => isset($costo) ? $costo->banco_id : null])
    </div>

    <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('servicio_id', 'Costo / Gasto') !!}
            {!! Form::select('servicio_id', $servicios->sortBy('id')->pluck('name', 'id'), isset($costo) ? $costo->servicio_id : null, ['class'=>'form-control','readonly']) !!}                
            @error('servicio_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripción:') !!}  
            {!! Form::textarea('descripcion', null, ['class'=>'form-control','rows'=>3,'readonly']) !!}
            
            @error('descripcion')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        @livewire('admin.calculo-isv-costo', ['costo' => isset($costo) ? $costo : null])
        <div class="form-group">
            {!! Form::label('moneda_id', 'Moneda') !!}
            {!! Form::select('moneda_id', $moneda->sortBy('id')->pluck('name', 'id'), isset($costo) ? $costo->moneda_id : null, ['class'=>'form-control']) !!}                
            @error('moneda_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('total_pago', 'Pago Parcial') !!}
            {!! Form::text('total_pago', null, ['class'=>'form-control','placeholder'=>'Ingrese Pago Parcial']) !!}

            @error('total_pago')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    
    <div class="form-group col-md-6">
        <div class="form-group">
            {!! Form::label('observaciones', 'Observaciones:') !!}  
            {!! Form::textarea('observaciones', null, ['class'=>'form-control','rows'=>3,'readonly']) !!}
            
            @error('observaciones')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>

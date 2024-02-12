<div>
    <div class="form-group">
        {!! Form::label('fechaEmision', 'Fecha de Emision') !!}
        {!! Form::date('fechaEmision', null, ['class'=>'form-control','placeholder'=>'Fecha Emision','wire:model.defer'=>"fechaEmision" ,'wire:change'=>"onFechaCange"]) !!}
        {{-- {!! Form::date('fechaEmision', isset($embarque) ? $embarque->fecha_emision : null, ['class'=>'form-control','placeholder'=>'Fecha Emision']) !!} --}}

        @error('fechaEmision')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('fechaVencimiento', 'Fecha de Vencimiento') !!}
        {!! Form::date('fechaVencimiento', null, ['class'=>'form-control','placeholder'=>'Ingrese Fecha de Vencimiento','wire:model.defer'=>"fechaVencimiento",'readonly'=>false]) !!}
        {{-- {!! Form::date('fechaVencimiento', isset($embarque) ? $embarque->no_compra_externa : null, ['class'=>'form-control','placeholder'=>'Ingrese Fecha de Vencimiento']) !!} --}}

        @error('fechaVencimiento')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    {{-- <div class="form-group">
        {!! Form::label('diasCredito', 'Fecha de Vencimiento') !!}
        {!! Form::text('diasCredito', null, ['wire:model.defer'=>"diasCredito",'readonly'=>true]) !!}

        @error('diasCredito')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div> --}}
</div>

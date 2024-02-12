<div>
    <div class="form-group">
        {!! Form::label('valor_neto_factura', 'Valor Neto de Factura:') !!}
        {!! Form::text('valor_neto_factura',  null, ['class'=>'form-control','placeholder'=>'Valor Neto de Factura:','wire:model'=>"valorNetoFactura" ,"value"=>"0", "min"=>"1" ,"step"=>"1", "pattern"=>"\d+",'wire:change'=>"onChange"]) !!}
        @error('valor_neto_factura')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('isv', 'ISV:') !!}
        {!! Form::text('isv',  null, ['class'=>'form-control','placeholder'=>'ISV:','wire:model'=>"isv" ,"value"=>"0", "min"=>"1" ,"step"=>"1", "pattern"=>"\d+",'wire:change'=>"changeiSV"]) !!}

        @error('isv')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('total', 'Total') !!}
        {!! Form::text('total', null, ['class'=>'form-control','placeholder'=>'Ingrese Total de Factura:','readonly','wire:model'=>"total" ,"value"=>"0", "min"=>"1" ,"step"=>"1", "pattern"=>"\d+",'wire:change'=>"onChange"]) !!}

        @error('total')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>

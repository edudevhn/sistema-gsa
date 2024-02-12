<div>
    <div class="card">
        <div class="card-header">
            {{-- <input wire:model="search" type="text" class="form-control" placeholder="Buscar Costo / Gasto"> --}}
        </div>
        <div class="card-body">
            <div class="form-group col-md-4">
                @livewire('admin.persona-select',['wire:model'=>"cliente_id",'idEdit' =>  null])
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('fechaInicio', 'Desde Fecha') !!}
                {!! Form::date('fechaInicio',null, ['wire:model'=>"fechaInicio",'class'=>'form-control','placeholder'=>'Tipo de Costo de Embarque']) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('fechaFin', 'Hasta Fecha') !!}
                {!! Form::date('fechaFin',null, ['wire:model'=>"fechaInicio",'class'=>'form-control','placeholder'=>'Tipo de Costo de Embarque']) !!}
            </div>
        </div>

        <div class="card-footer">
            {{-- {{$gastos->links()}} --}}
        </div>
        
    </div>
        
    <div class="row">
        
        {{-- @if ($costoSelect->embarque->count())
            @foreach ($costoSelect->embarque as $item)
                <div class="form-group col-md-4">
                    {!! Form::label('num_documento', '#Embarque') !!}
                    {!! Form::text('num_documento', $item->num_embarque, ['class'=>'form-control','placeholder'=>'Numero de Embarque','readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('clienteEmbarque', 'Cliente') !!}
                    {!! Form::text('clienteEmbarque', $item->persona->name, ['class'=>'form-control','placeholder'=>'Cliente','readonly']) !!}
                </div> 
            @endforeach
        @else
            <div class="form-group col-md-4">
                {!! Form::label('tipoCosto', '#Tipo de Costo') !!}
                {!! Form::text('tipoCosto', $costoSelect->tipoCosto->name, ['class'=>'form-control','placeholder'=>'Tipo de Costo de Embarque','readonly']) !!}
            </div>
        @endif
        <div class="form-group col-md-4">                        
            {!! Form::label('servicio', 'Servicio') !!}
            {!! Form::text('servicio', $costoSelect->servicio->name, ['class'=>'form-control','placeholder'=>'Servicio','readonly']) !!}
        </div>
        <div class="form-group col-md-4">    
            {!! Form::label('proveedor', 'Proveedor') !!}
            {!! Form::text('proveedor', $costoSelect->proveedor->name, ['class'=>'form-control','placeholder'=>'Proveedor','readonly']) !!}
        </div>
        <div class="form-group col-md-4">    
            {!! Form::label('total', 'Total Factura') !!}
            {!! Form::text('total', $costoSelect->total, ['class'=>'form-control','placeholder'=>'Total Factura','readonly']) !!}
        </div>
    </div> --}}
</div>

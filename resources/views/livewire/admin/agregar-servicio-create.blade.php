<div class="row">
    <input type="hidden" name="serviciosArray" value="{{json_encode($serviciosArray)}}">
    {!! Form::hidden('tc_hnd', null, ['class'=>'form-control','wire:model'=>"tc_hnd",]) !!}
    {!! Form::hidden('tc_usd', null, ['class'=>'form-control','wire:model'=>"tc_usd",]) !!}
    <div class="form-group col-md-12">
        <div class="form-group">
            {!! Form::label('moneda_id', 'Moneda') !!}
            {!! Form::select('moneda_id', $monedas->sortBy('id')->pluck('name', 'id'), isset($cotizacione) ? $cotizacione->monedad_id : null, ['class'=>'form-control','wire:model.defer'=>"moneda_id", 'wire:change'=>"onMonedaChange"]) !!}                
            @error('moneda_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <!-- Formulario para agregar servicio -->
    <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('servicio_id', 'Servicios') !!}
            {!! Form::select('servicio_id',  ['' => 'Seleccione...'] + $listaServicios->sortBy('name')->pluck('name','id')->toArray(), null, ['class'=>'form-control','wire:model'=>"servicio_id", 'wire:change'=>"onServicioChange"]) !!}                
            @error('servicio_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-2">
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripcion:') !!}  
            {!! Form::textarea('descripcion', null, ['class'=>'form-control','wire:model'=>"descripcion",'rows'=>3]) !!}
            
            @error('descripcion')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-2">
        <div class="form-group">
            {!! Form::label('um', 'Medida') !!}
            {!! Form::text('um', null, ['class'=>'form-control','wire:model'=>"um"]) !!}
        
            @error('um')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-2">
        <div class="form-group">
            {!! Form::label('cantidad', 'Cantidad') !!}
            {!! Form::number('cantidad', null, ['class'=>'form-control','wire:model'=>"cantidad","value"=>"0", "min"=>"1" ,"step"=>"1", "pattern"=>"\d+"]) !!}
        
            @error('cantidad')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-2">
        <div class="form-group">
            {!! Form::label('precio', 'Precio') !!}
            {!! Form::number('precio', null, ['class'=>'form-control','wire:model'=>"precio","value"=>"1", "min"=>"1", "step"=>"1", "pattern"=>"\d+"]) !!}
        
            @error('precio')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    {{-- <label for="precio">Precio:</label>
    <input type="number" id="precio" wire:model="precio" /> --}}
    <div class="form-group col-md-2">
        <br>
        {!! Form::button('Agregar', ['class'=>'btn btn-lg btn-primary',"wire:click"=>"agregarServicio"]) !!}
    </div>
    {{-- <button type="button" wire:click="agregarServicio">Agregar</button> --}}
    <div class="form-group col-md-12">
        @if ($serviciosArray )
        {{-- {{$serviciosArray}} --}}
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripcion / Concepto</th>
                            <th>Cantidad</th>
                            <th>Precio </th>
                            <th>15% ISV </th>
                            <th>Total</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1
                        @endphp
                        @foreach ($serviciosArray as $servicio)
                            <tr>
                                <td>{{$index}}</td>
                                @if ($servicio['descripcion'])
                                    <td>{{"{$servicio['nombre']} ({$servicio['descripcion']})"}}</td>
                                @else
                                    <td>{{$servicio['nombre']}}</td>
                                @endif
                                <td>{{$servicio['cantidad']}}</td>
                                {{-- <td>{{$servicio['um']}}</td> --}}
                                <td>{{$servicio['precio']}}</td>
                                <td>{{$servicio['isv']}}</td>
                                <td>{{$servicio['total']}}</td>
                                <td width="10px">
                                    <button type="button" class="btn btn-primary btn-sm"  wire:click="agregarServicio">
                                        <i class="fas fa-fw fa-edit"></i></a></button>
                                </td>
                                <td width="10px">
                                    <button type="button" class="btn btn-danger btn-sm"  wire:click="deletServicio({{$servicio['servicio_id']}})">
                                        <i class="fas fa-fw fa-trash"></i></a></button>
                                    {{-- <form method="POST"  action="{{route('admin.servicios.destroy',$persona)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form> --}}
                                </td>
                            </tr>
                            @php
                                $index += 1
                            @endphp
                        @endforeach
                    </tbody>
                    
                </table>
                
            </div>
                
        @else
            <div class="card-body">
                <strong>No hay ningun registro...</strong>
            </div>
        @endif
    </div>
    {{-- @if ($serviciosArray ) --}}
      
        <div class="form-group col-md-6 offset-md-6">
            <div class="form-group">
                {!! Form::label('total', 'TOTAL COTIZACIÓN') !!}
                {!! Form::number('total', null, ['class'=>'form-control','wire:model.defer'=>"total","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
            
                @error('total')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    {{-- @endif --}}
</div>
{{-- <div>
    <input type="hidden" name="serviciosArray" value="{{json_encode($serviciosArray)}}">
    {!! Form::hidden('tc_hnd', null, ['class'=>'form-control','wire:model'=>"tc_hnd",]) !!}
    {!! Form::hidden('tc_usd', null, ['class'=>'form-control','wire:model'=>"tc_usd",]) !!}
    <div class="form-group">
        {!! Form::label('moneda_id', 'Moneda') !!}
        {!! Form::select('moneda_id', $monedas->sortBy('id')->pluck('name', 'id'), null, ['class'=>'form-control','wire:model'=>"moneda_id", 'wire:change'=>"onMonedaChange"]) !!}                
        @error('moneda_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <!-- Formulario para agregar servicio -->
    {!! Form::label('servicio_id', 'Servicios') !!}
    {!! Form::select('servicio_id', $listaServicios->sortBy('id')->pluck('name','id'), null, ['class'=>'form-control','wire:model'=>"servicio_id", 'wire:change'=>"onServicioChange"]) !!}                
    @error('servicio_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
    
    <div class="form-group">
        {!! Form::label('cantidad', 'Cantidad') !!}
        {!! Form::number('cantidad', null, ['class'=>'form-control','wire:model'=>"cantidad","value"=>"0", "min"=>"1" ,"step"=>"1", "pattern"=>"\d+"]) !!}
    
        @error('cantidad')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('precio', 'Precio') !!}
        {!! Form::number('precio', null, ['class'=>'form-control','wire:model'=>"precio","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+"]) !!}
    
        @error('precio')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    {!! Form::button('Agregar', ['class'=>'btn btn-primary',"wire:click"=>"agregarServicio"]) !!}
    
    @if ($serviciosArray )
                
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Cantidad</th>
                        <th>Precio </th>
                        <th>Total</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviciosArray as $servicio)
                    <tr>
                        <td></td>
                        <td>{{$servicio['nombre']}}</td>
                            <td>{{$servicio['cantidad']}}</td>
                            <td>{{$servicio['precio']}}</td>
                            <td>{{$servicio['total']}}</td>
                            <td width="10px">
                                <button type="button" class="btn btn-primary btn-sm"  wire:click="agregarServicio">Editar</button>
                            </td>
                            <td width="10px">
                                <button type="button" class="btn btn-danger btn-sm"  wire:click="agregarServicio">Borrar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                
            </div>
            
    @else
        <div class="card-body">
            <strong>No hay ningun registro...</strong>
        </div>
    @endif
    <div class="form-group">
        {!! Form::label('totalCotizacion', 'Total Cotizacion') !!}
        {!! Form::number('totalCotizacion', null, ['class'=>'form-control','wire:model'=>"totalCotizacion","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
    
        @error('totalCotizacion')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div> --}}
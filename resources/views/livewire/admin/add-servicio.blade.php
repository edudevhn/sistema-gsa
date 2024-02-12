<div class="row">
    <input type="hidden" name="serviciosArray" value="{{json_encode($serviciosArray)}}">
    {!! Form::hidden('tc_hnd', null, ['class'=>'form-control','wire:model'=>"tc_hnd",]) !!}
    {!! Form::hidden('tc_usd', null, ['class'=>'form-control','wire:model'=>"tc_usd",]) !!}
    <div class="form-group col-md-12">
        <div class="form-group">
            {!! Form::label('moneda_id', 'Moneda') !!}
            {!! Form::select('moneda_id', $monedas->sortBy('id')->pluck('name', 'id'), null, ['class'=>'form-control','wire:model.defer'=>"moneda_id", 'wire:change'=>"onMonedaChange"]) !!}                
            @error('moneda_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <!-- Formulario para agregar servicio -->
    <div class="form-group col-md-4">
        <div class="form-group">
            {!! Form::label('servicio_id', 'Servicios') !!}
            {!! Form::select('servicio_id', ['' => 'Seleccione...'] + $listaServicios->sortBy('name')->pluck('name','id')->toArray(), null, ['class'=>'form-control','wire:model'=>"servicio_id", 'wire:change'=>"onServicioChange"]) !!}                
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
                            <th>CONCEPTO / DESCRIPCIÓN</th>
                            <th>MEDIDA</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO UNITARIO </th>
                            <th>VALOR TOTAL</th>
                            <th>ISV</th>
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
                                <td>{{$servicio['um']}}</td>
                                <td>{{$servicio['cantidad']}}</td>
                                <td>{{$servicio['precio']}}</td>
                                <td>{{$servicio['total']}}</td>
                                <td>{{$servicio['isv']}}</td>
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
        <div class="form-group col-md-3 offset-md-6">
            <div class="form-group">
                {!! Form::label('importeGravado', 'IMPORTE GRAVADO 15%') !!}
                {!! Form::number('importeGravado', null, ['class'=>'form-control','wire:model.defer'=>"importeGravado","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
            
                @error('importeGravado')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('importeExonerado', 'IMPORTE EXONERADO') !!}
                {!! Form::number('importeExonerado', null, ['class'=>'form-control','wire:model.defer'=>"importeExonerado","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
            
                @error('importeExonerado')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('subTotal', 'SUB TOTAL') !!}
                {!! Form::number('subTotal', null, ['class'=>'form-control','wire:model.defer'=>"subTotal","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
            
                @error('subTotal')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="form-group">
                {!! Form::label('importeExento', 'IMPORTE EXENTO') !!}
                {!! Form::number('importeExento', null, ['class'=>'form-control','wire:model.defer'=>"importeExento","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
            
                @error('importeExento')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('descuento', 'DESCUENTOS') !!}
                {!! Form::number('descuento', null, ['class'=>'form-control','wire:model.defer'=>"descuento","value"=>"0", "min"=>"0", "step"=>"0", "pattern"=>"\d+", 'wire:change'=>"onDescuentoChange"]) !!}
            
                @error('descuento')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('isv', 'I.S.V. 15%') !!}
                {!! Form::number('isv', null, ['class'=>'form-control','wire:model.defer'=>"isv","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
            
                @error('isv')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-6 offset-md-6">
            <div class="form-group">
                {!! Form::label('total', 'TOTAL A PAGAR') !!}
                {{-- {{number_format($total, 2, '.', ',')}} --}}
                {!! Form::number('total', number_format($total, 2, '.', ','), ['class'=>'form-control','wire:model.defer'=>"total","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+","readonly"=>true]) !!}
            
                @error('total')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    {{-- @endif --}}
</div>
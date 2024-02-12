<div class="row">

    <div class="form-group col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['wire:model.defer'=>"name", 'class'=>'form-control','placeholder'=>'Ingrese el nombre de la persona']) !!}

            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>        
        <div class="form-group">
            {!! Form::label('entidad_id', 'Entidad') !!}
            {!! Form::select('entidad_id', $entidades->sortBy('id')->pluck('name','id'), null, ['wire:model.defer'=>"entidad_id",'class'=>'form-control']) !!}                
            @error('entidad_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('rtn', 'RTN') !!}
            {!! Form::text('rtn', null, ['wire:model.defer'=>"rtn",'class'=>'form-control','placeholder'=>'Ingrese RTN']) !!}

            @error('rtn')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('telefono', 'Telefono') !!}
            {!! Form::text('telefono', null, ['wire:model.defer'=>"telefono",'class'=>'form-control','placeholder'=>'Ingrese telefono']) !!}

            @error('telefono')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        <div class="form-group">
            @livewire('admin.select-termino-pago',['idEdit' => isset($persona) ? $persona->termino_pago_id : null])
        </div>
        <div class="form-group">
            <p class="font-weight-bold">Exoneracion</p>
            <label >
                {!! Form::radio('exonerado', 1, true,['wire:model.defer'=>"exonerado",'id'=>'exonerado']) !!}
                NO
            </label>

            <label >
                {!! Form::radio('exonerado', 2,false,['wire:model.defer'=>"exonerado",'id'=>'exonerado2']) !!}
                SI
            </label>
            @error('exonerado')
                <br>
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-6">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['wire:model.defer'=>"email",'class'=>'form-control','placeholder'=>'Ingrese email']) !!}

            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('tipo_persona_id', 'Tipo') !!}
            {!! Form::select('tipo_persona_id', $tipoPersonas->sortBy('id')->pluck('name','id'), null, ['wire:model.defer'=>"tipo_persona_id",'class'=>'form-control']) !!}                
            @error('tipo_persona_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('direccion_fiscal', 'Direccion fiscal:') !!}  
            {!! Form::textarea('direccion_fiscal', null, ['wire:model.defer'=>"direccion_fiscal",'class'=>'form-control' ,'rows'=>4]) !!}
            
            @error('direccion_fiscal')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('dias_pago', 'Dias de pago') !!}
            {!! Form::text('dias_pago', null, ['wire:model.defer'=>"dias_pago",'class'=>'form-control','placeholder'=>'Ingrese dias de pago']) !!}

            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    @if(!isset($persona->id))
        <div class="form-group col-md-6 miDiv d-none">
            <div class="form-group">
                {!! Form::label('registroExonerado', 'Registro Exonerado') !!}
                {!! Form::text('registroExonerado', null, ['wire:model.defer'=>"registroExonerado",'class'=>'form-control','placeholder'=>'Ingrese Registro Exonerado']) !!}

                @error('registroExonerado')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Estado Registro Exoneracion</p>
                <label >
                    {!! Form::radio('statusExonerado', 1, true,['wire:model.defer'=>"statusExonerado"]) !!}
                    Baja
                </label>

                <label >
                    {!! Form::radio('statusExonerado', 2,['wire:model.defer'=>"statusExonerado"]) !!}
                    Alta
                </label>
                @error('statusExonerado')
                    <br>
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-6 miDiv d-none">
            <div class="form-group">
                {!! Form::label('fechaVencimientoExoneracion', 'Fecha de Vencimiento Exoneracion') !!}
                {!! Form::date('fechaVencimientoExoneracion', null, ['wire:model.defer'=>"fechaVencimientoExoneracion",'class'=>'form-control','placeholder'=>'Fecha de Vencimiento Exoneracion']) !!}

                @error('fechaVencimientoExoneracion')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    @endif



</div>


<div class="form-group">
    {!! Form::label('name', 'Concepto del Servicio') !!}
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el Concepto del Servicio del servico']) !!}

    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('name_interno', 'Concepto del Servicio (Uso Interno)') !!}
    {!! Form::text('name_interno', null, ['class'=>'form-control','placeholder'=>'Ingrese el Concepto del Servicio del servico (Uso Interno)']) !!}

    @error('name_interno')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('cuenta_id', 'Cuenta de Gasto') !!}
    {!! Form::select('cuenta_id', $cuentas, null, ['class'=>'form-control']) !!}                
    @error('cuenta_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('value_type_id', 'Tipo de Valor') !!}
    {!! Form::select('value_type_id', $valueTypes, null, ['class'=>'form-control']) !!}                
    @error('value_type_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label >
        {!! Form::radio('status', 1, true) !!}
        Baja
    </label>

    <label >
        {!! Form::radio('status', 2) !!}
        Alta
    </label>
    @error('status')
        <br>
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion:') !!}  
    {!! Form::textarea('descripcion', null, ['class'=>'form-control']) !!}
    
    @error('descripcion')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div>
    <div class="form-group">
        <label for="cliente">Seleccionar Fondo Bancario:</label>
        <div class="input-group">
            {!! Form::hidden('cuenta_bancaria_id', null, ['wire:model.defer'=>"item_id",'readonly'=>true]) !!}
            {!! Form::text('cuentaBancaria', null, ['wire:model.defer'=>"name",'class'=>'form-control','placeholder'=>'Nombre Fondo Bancario','readonly'=>true]) !!}
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-primary" wire:click="toggleVariable">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    @if($showList)
        <input type="text" class="form-control mt-2" id="buscarCuentaBancaria" placeholder="Buscar Fondo Bancario..." wire:model="search" wire:keydown="onChange">
        <ul class="list-group list-group-flush" style="max-height: 200px; overflow-y: scroll;">
            @foreach ($listaItem as $item)
                <li class="list-group-item" wire:click="onSelect({{$item['id']}})">
                    <span class="badge badge-primary badge-pill">
                            {{$item['name'][0]}}
                    </span>
                    {{$item['name']}}<br>
                    {{$item['num_cuenta']}}-{{$item['nombre_banco']}}
                </li>
            @endforeach
        </ul>
        {{-- <ul class="list-unstyled cursor-pointer" style="max-height: 200px;">
            <li class="d-flex align-items-center justify-content-center list-group-item-primary " wire:click="addItem()">
              <span class="fas fa-university-plus fa-fw "></span>
              Agregar Fondo Bancario
            </li>
        </ul> --}}
    @endif
    @if($showModal)
        <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro de Fondo Bancario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form wire:submit.prevent="saveItem">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name', 'Nombre') !!}
                                    {!! Form::text('name', null, ['wire:model.defer'=>"name", 'class'=>'form-control','placeholder'=>'Ingrese el nombre de Fondo Bancario']) !!}
                        
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('num_cuenta', 'Numero de Cuenta') !!}
                                {!! Form::text('num_cuenta', null, ['wire:model.defer'=>"numCuenta",'class'=>'form-control','placeholder'=>'Ingrese Numero de Cuenta']) !!}
            
                                @error('num_cuenta')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>                
                            <div class="form-group">
                                {!! Form::label('beneficiario', 'Nombre de Beneficiario') !!}
                                {!! Form::text('beneficiario', null, ['wire:model.defer'=>"beneficiario",'class'=>'form-control','placeholder'=>'Ingrese Numero de Cuenta']) !!}
            
                                @error('beneficiario')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>                
                            <div class="form-group">
                                {!! Form::label('rtn', 'RTN ') !!}
                                {!! Form::text('rtn', null, ['wire:model.defer'=>"rtn",'class'=>'form-control','placeholder'=>'Ingrese Numero de Cuenta']) !!}
            
                                @error('rtn')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>                
                            <div class="form-group">
                                @livewire('admin.select-bancos',['idEdit' =>  null])
                            </div>
                            <div class="form-group">
                                @livewire('admin.select-tipo-cuentas',['idEdit' =>  null])
                            </div>
                            <div class="form-group">
                                {!! Form::label('moneda_id', 'Moneda') !!}
                                {!! Form::select('moneda_id', $monedas, null, ['wire:model.defer'=>"moneda_id",'class'=>'form-control']) !!}                
                                @error('moneda_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p class="font-weight-bold">Predeterminada</p>
                                <label >
                                    {!! Form::radio('predeterminada', 1,['wire:model.defer'=>"predeterminada"]) !!}
                                    NO
                                </label>
                            
                                <label >
                                    {!! Form::radio('predeterminada', 2,true,['wire:model.defer'=>"predeterminada"]) !!}
                                    SI
                                </label>
                                @error('predeterminada')
                                    <br>
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p class="font-weight-bold">Estado</p>
                                <label >
                                    {!! Form::radio('status', 1,['wire:model.defer'=>"status"]) !!}
                                    Baja
                                </label>
                            
                                <label >
                                    {!! Form::radio('status', 2,true,['wire:model.defer'=>"status"]) !!}
                                    Alta
                                </label>
                                @error('status')
                                    <br>
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            {!! Form::submit('Crear Fondo Bancario', ['class'=>'btn btn-primary']) !!}
                        </form>
                    </div>
                    <!-- Agrega otros campos del formulario según tus necesidades -->
                    <div class="modal-footer">
                        <button type="button"  class="btn  btn-warning pull-left" data-dismiss="modal" wire:click="closeModal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

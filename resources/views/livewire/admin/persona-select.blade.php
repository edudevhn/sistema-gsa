<div>
    <div class="form-group">
        <label for="cliente">Seleccionar cliente:</label>
        @if ($showSearchChange)
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary" wire:click="toggleVariable">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        @endif
    </div>
    @if($showListPerson)
        <input type="text" class="form-control mt-2" id="buscarPersona" placeholder="Buscar cliente..." wire:model="searchPerson" wire:keydown="onPersonaChange">
        <ul class="list-group list-group-flush" style="max-height: 200px; overflow-y: scroll;">
            @foreach ($listaPersonas as $item)
                <li class="list-group-item" wire:click="onPersonaSelect({{$item['id']}})">
                    <span class="badge badge-secondary badge-pill">
                            {{$item['name'][0]}}
                    </span>
                    {{$item['name']}}<br>
                    RTN: {{$item['rtn']}} *** Telefono:{{$item['telefono']}}
                </li>
            @endforeach
        </ul>
        <ul class="list-unstyled cursor-pointer" style="max-height: 200px;">
            <li class="d-flex align-items-center justify-content-center list-group-item-primary " wire:click="addItem()">
              <span class="fas fa-user-plus fa-fw "></span>
              Agregar Persona
            </li>
        </ul>
    @endif
   

    @if ($persona_id)
        <div class="form-group">
            {!! Form::hidden('persona_id', null, ['wire:model.defer'=>"persona_id",'readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('namePersona', 'Nombre') !!}
            {!! Form::text('namePersona', null, ['wire:model.defer'=>"name",'class'=>'form-control','placeholder'=>'Nombre Persona','readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('rtn', 'RTN') !!}
            {!! Form::text('rtn', null, ['wire:model.defer'=>"rtn",'class'=>'form-control','placeholder'=>'RTN','readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('telefono', 'Teléfono') !!}
            {!! Form::text('telefono', null, ['wire:model.defer'=>"telefono",'class'=>'form-control','placeholder'=>'Teléfono','readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('direccion', 'Direccion:') !!}  
            {!! Form::textarea('direccion', null, ['wire:model.defer'=>"direccion",'class'=>'form-control' ,'readonly'=>true,'rows'=>3] ) !!}
            
            @error('direccion')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div> 
        @if ($registroSag)
            <div class="form-group">
                {!! Form::label('registroSag', 'Registro SAG') !!}
                {!! Form::text('registroSag', null, ['wire:model.defer'=>"registroSag",'class'=>'form-control','placeholder'=>'Registro SAG','readonly'=>true]) !!}
            </div>
        @endif
        <div class="form-group">
            {!! Form::label('diasCredito', 'Dias de Pago') !!}
            {!! Form::text('diasCredito', null, ['wire:model.defer'=>"diasCredito",'class'=>'form-control','placeholder'=>'Dias de Pago','readonly'=>true]) !!}
        </div>
    @endif
    


    @if($showModal)
        <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro de Persona</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <form wire:submit.prevent="savePerson">
                        {{-- {!! Form::open(['route'=>'admin.personas.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!} --}}
                            @include('admin.personas.partials.form')
                            {!! Form::submit('Crear persona', ['class'=>'btn btn-primary']) !!}
                        </form>
                    </div>
                    <!-- Agrega otros campos del formulario según tus necesidades -->
                    <div class="modal-footer">
                        <button type="button"  class="btn  btn-warning pull-left" data-dismiss="modal" wire:click="closeModal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

   
</div>

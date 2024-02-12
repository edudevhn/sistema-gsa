<div>
    <div class="form-group">
        <label for="cliente">Seleccionar Banco:</label>
        <div class="input-group">
            {!! Form::hidden('banco_id', null, ['wire:model.defer'=>"item_id",'readonly'=>true]) !!}
            {!! Form::text('banco', null, ['wire:model.defer'=>"name",'class'=>'form-control','placeholder'=>'Nombre Banco','readonly'=>true]) !!}
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-primary" wire:click="toggleVariable">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    @if($showList)
        <input type="text" class="form-control mt-2" id="buscarBanco" placeholder="Buscar Banco..." wire:model="search" wire:keydown="onChange">
        <ul class="list-group list-group-flush" style="max-height: 200px; overflow-y: scroll;">
            @foreach ($listaItem as $item)
                <li class="list-group-item" wire:click="onSelect({{$item['id']}})">
                    <span class="badge badge-primary badge-pill">
                            {{$item['name'][0]}}
                    </span>
                    {{$item['name']}}<br>
                </li>
            @endforeach
        </ul>
        <ul class="list-unstyled cursor-pointer" style="max-height: 200px;">
            <li class="d-flex align-items-center justify-content-center list-group-item-primary " wire:click="addItem()">
              <span class="fas fa-university-plus fa-fw "></span>
              Agregar Banco
            </li>
        </ul>
    @endif
    @if($showModal)
        <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro de Banco</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form wire:submit.prevent="saveItem">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name', 'Nombre') !!}
                                    {!! Form::text('name', null, ['wire:model.defer'=>"name", 'class'=>'form-control','placeholder'=>'Ingrese el nombre de Aduana']) !!}
                        
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            {!! Form::submit('Crear Banco', ['class'=>'btn btn-primary']) !!}
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

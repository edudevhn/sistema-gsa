<div>
    <div class="form-group">
        <label for="cliente">Seleccionar Embarque:</label>
        <div class="input-group">
            {!! Form::hidden('embarque_id', null, ['wire:model.defer'=>"item_id",'readonly'=>true]) !!}
            {!! Form::text('embarque', null, ['wire:model.defer'=>"name",'class'=>'form-control','placeholder'=>'Numero de Embarque','readonly'=>true]) !!}
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-primary" wire:click="toggleVariable">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    @if($showList)
        <input type="text" class="form-control mt-2" id="buscarEmbarque" placeholder="Buscar Numero Embarque..." wire:model="search" wire:keydown="onChange">
        <ul class="list-group list-group-flush" style="max-height: 200px; overflow-y: scroll;">
            @foreach ($listaItem as $item)
                <li class="list-group-item" wire:click="onSelect({{$item['id']}})">
                    <span class="badge badge-primary badge-pill">
                            {{$item['num_embarque'][0]}}
                    </span>
                    <b>#:</b> {{$item['num_embarque']}}<br>
                    <b>Fecha:</b> {{$item['fecha']}}   <b>Total:</b> {{$item['total']}}
                </li>
            @endforeach
        </ul>
    @endif
</div>

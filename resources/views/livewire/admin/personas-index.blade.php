<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscar persona">
        </div>
        @if ($personas->count() )
            
            <div class="card-body  table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>RTN</th>
                            <th>Name</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Entidad</th>
                            <th>Reg Exonerado</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        @php
                            $index = 1
                        @endphp
                        @foreach ($personas as $persona)
                            <tr>
                                <td>{{$index}}</td>
                                <td>{{$persona->rtn}}</td>
                                <td>{{$persona->name}}</td>
                                <td>{{$persona->telefono}}</td>
                                <td>{{$persona->email}}</td>
                                <td>{{$persona->tipoPersona->name}}</td>
                                <td>{{$persona->entidad->name}}</td>
                                <td>
                                    @if ($persona->exonerado==2)
                                        <a wire:click="selectExoneracion({{ $persona }})" class=' btn btn-success'><i class='fa fa-address-card fa-lg'></i></a>                                        
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.personas.edit',$persona)}}" class=' btn btn-info'><i class='fa fa-edit fa-lg'></i></a>
                                </td>
                            </tr>
                            @php
                                $index += 1
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                {{$personas->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay ningun registro...</strong>
            </div>
        @endif
    </div>
    
    @if($showModal)
        <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro de Exoneracion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            @if ($showForm)
                                
                    
                                <form wire:submit.prevent="updateExoneracion">
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('registro', 'Registro Exonerado') !!}
                                            {{-- {!! Form::text('registro', null, ['class'=>'form-control','wire:model'=>"exoneracion.registro","value"=>"0", "min"=>"1", "step"=>"1", "pattern"=>"\d+"]) !!} --}}
                                            {!! Form::text('registro', null, ['class'=>'form-control','placeholder'=>'Ingrese Registro Exonerado', "wire:model"=>"exoneracion.registro"]) !!}
                            
                                            @error('registro')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <p class="font-weight-bold">Estado Registro Exoneracion</p>
                                            <label >
                                                {!! Form::radio('statusExonerado', 1, true,[ "wire:model"=>"exoneracion.status"]) !!}
                                                Baja
                                            </label>
                            
                                            <label >
                                                {!! Form::radio('statusExonerado', 2,[ "wire:model"=>"exoneracion.status"]) !!}
                                                Alta
                                            </label>
                                            @error('statusExonerado')
                                                <br>
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('fecha_vencimiento', 'Fecha de Vencimiento Exoneracion') !!}
                                            {!! Form::date('fecha_vencimiento', null, ['class'=>'form-control','placeholder'=>'Fecha de Vencimiento Exoneracion', "wire:model"=>"exoneracion.fecha_vencimiento"]) !!}

                                            @error('fecha_vencimiento')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar</button>      
                                    </div>
                                </form>
                                {{-- <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="registro" wire:model="exoneracion->registro">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="fecha_vencimiento" wire:model="exoneracion->fecha_vencimiento">
                                </div> --}}
                            @endif
                            @if ($showAdd)
                                <button type="button"  wire:click="addExoneracion()" class="btn btn-primary">Nuevo Registro</button>     
                            @endif
                            @if ($personExoneracion->count() )
                
                                <div class="card-body  table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Registro Exonerado</th>
                                                <th>Fecha Vencimiento</th>
                                                <th>Estado</th>
                                                <th>Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>                        
                                            @php
                                                $index = 1;
                                            @endphp
                                            @foreach ($personExoneracion as $exoneracion)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$exoneracion->registro}}</td>
                                                    <td>{{$exoneracion->fecha_vencimiento}}</td>
                                                    <td>{{$exoneracion->status}}</td>
                                                    <td>
                                                        @if ($exoneracion->status==2)
                                                            <a wire:click="editExoneracion({{ $exoneracion->id }})" class=' btn btn-success'><i class='fa fa-edit fa-lg'></i></a>                                        
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $index += 1
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{$personExoneracion->links()}} --}}
                                </div>
                            @else
                                <div class="card-body">
                                    <strong>No hay ningun registro...</strong>
                                </div>
                            @endif
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

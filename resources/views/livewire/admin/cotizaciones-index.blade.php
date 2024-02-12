<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscar cotizacion">
        </div>
        @if ($cotizaciones->count() )
            
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Numero de Documento</th>
                            <th>Cliente</th>
                            <th>Referencia No.</th>
                            <th>Fecha</th>
                            <th>Mercancia</th>
                            <th>Termino de pago</th>
                            <th>Fecha Validez</th>
                            <th>Aduana</th>
                            <th>Estado</th>
                            <th colspan="5"></th>
                        </tr>
                    </thead>
                    <tbody>                 
                        @php
                            $index = 1
                        @endphp
                        @foreach ($cotizaciones as $cotizacion)
                            <tr>
                                <td>{{$index}}</td>
                                <td>{{$cotizacion->num_documento}}</td>
                                <td>{{$cotizacion->persona->name}}</td>
                                <td>{{$cotizacion->num_referencia}}</td>
                                <td>{{$cotizacion->fecha}}</td>
                                <td>{{$cotizacion->mercancia->name}}</td>
                                <td>{{$cotizacion->terminoPago->name}}</td>
                                <td>{{$cotizacion->fecha_valida}}</td>
                                <td>{{$cotizacion->aduana->name}}</td>
                                <td>{{$cotizacion->estado_actual}}</td>
                                <td width="10px">
                                    <a class="btn btn-warning btn-sm"  wire:click="showStatus({{ $cotizacion }})" class=' btn btn-success'><i class='fa fa-history fa-lg'></i></a>   
                                </td>
                                <td width="10px">
                                    @if ($cotizacion->estado_actual=='ELABORADO')
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.cotizaciones.edit',$cotizacion)}}">
                                        <i class="fas fa-fw fa-edit"></i></a>
                                    @endif
                                </td>
                                <td width="10px">
                                    @if ($cotizacion->estado_actual=='ELABORADO')
                                        <a class="btn btn-success btn-sm float-right" href="{{route('admin.embarques.createEmbarqueCotizacione',$cotizacion)}}">
                                            <i class="fas fa-fw fa-thumbs-up"></i></a>  
                                    @endif
                                </td>
                                <td width="10px">
                                    @if ($cotizacion->estado_actual=='ELABORADO')
                                        <a class="btn btn-danger btn-sm float-right"  wire:click="cancelCotizacione({{ $cotizacion }})" class=' btn btn-success'>
                                            <i class="fas fa-fw fa-thumbs-down"></i></a>
                                    @endif
                                </td>
                                <td width="10px">
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-fw fa-file-pdf"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @foreach ($monedas as $item)
                                                <a class="dropdown-item" href="{{ route('admin.cotizaciones.generarPDF', ['cotizacione' => $cotizacion, 'moneda' => $item->id]) }}" target="_blank">{{ $item->name }}</a>

                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $index += 1
                            @endphp
                        @endforeach
                    </tbody>

                </table>
                
            </div>

            <div class="card-footer">
                {{$cotizaciones->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay ningun registro...</strong>
            </div>
        @endif
    </div>

    @if($showModalStatus)
        <div class="modal fade show modal-dialog-scrollable" tabindex="-1" role="dialog" style="display: block;" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seguimiento de Estados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            
                            <div class="card">
                                <div class="card-body  table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Usuario</th>
                                                <th>Estado</th>
                                                <th>Observacion</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $index = 1;
                                            @endphp
                                            @foreach ($statusList as $estado)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>
                                                        {{$estado->usuario->name}}
                                                    </td>
                                                    <td>{{$estado->estado}}</td>
                                                    <td>{{$estado->observacion}}</td>
                                                    <td>{{$estado->created_at}}</td>
                                                </tr>
                                                @php
                                                    $index += 1;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

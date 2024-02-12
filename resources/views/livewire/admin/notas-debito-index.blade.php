<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscar nota de debito">
        </div>
        @if ($notasDebito->count() )
            
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>                            
                            <th>ID</th>
                            <th>Numero de Documento</th>
                            <th>Cliente</th>
                            <th>RTN</th>
                            <th>No. Embarque</th>
                            <th>DUCA</th>
                            <th>Fecha de Emision</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Aduana</th>
                            <th>Moneda</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1
                        @endphp
                        @foreach ($notasDebito as $notaDebito)
                            <tr>
                                <td>{{$index}}</td>
                                <td>
                                    {{$notaDebito->numero_documento}}
                                    {{-- @foreach ($notaDebito->documentosRangos as $documento)
                                        @if ($documento->documentoTipo->valueType->id==2)
                                            {{$documento->pivot->numero_documento}}
                                            
                                        @endif
                                        
                                    @endforeach --}}
                                </td>
                                <td>{{$notaDebito->embarque->persona->name}}</td>
                                <td>{{$notaDebito->embarque->persona->rtn}}</td>
                                <td>{{$notaDebito->embarque->num_embarque}}</td>
                                <td>{{$notaDebito->documentoFiscalDetalles->duca}}</td>
                                <td>{{$notaDebito->documentoFiscalDetalles->fecha_emision}}</td>
                                <td>{{$notaDebito->documentoFiscalDetalles->fecha_vencimiento}}</td>
                                <td>{{$notaDebito->embarque->aduana->name}}</td>
                                <td>{{$notaDebito->documentoFiscalDetalles->moneda->name}}</td>
                                {{-- <td width="10px">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.documentosFiscales.edit',$notaDebito)}}">Editar</a>
                                </td> --}}
                                <td width="10px">
                                    <a class="btn btn-warning btn-sm"  wire:click="showStatus({{ $notaDebito }})" ><i class='fa fa-history fa-lg'></i></a>   
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false">
                                        PDF
                                        </button>
                                        <div class="dropdown-menu">
                                            @foreach ($monedas as $item)
                                              <a class="dropdown-item" href="{{ route('admin.documentosFiscales.generarPDF', ['documentoFiscal' => $notaDebito, 'moneda' => $item->id]) }}" target="_blank">{{ $item->name }}</a>

                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                {{-- <td width="10px">
                                    <form method="POST"  action="{{route('admin.notasDebito.destroy',$persona)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td> --}}
                            </tr>
                                {{-- @foreach ($factura->documentosRangos as $documento)
                                
                                    
                                @endforeach --}}
                            @php
                                $index += 1
                            @endphp
                        @endforeach
                    </tbody>

                </table>
                
            </div>

            <div class="card-footer">
                {{$notasDebito->links()}}
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

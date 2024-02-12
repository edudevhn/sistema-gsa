<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscar cotizacion">
        </div>
        @if ($embarques->count() )
            
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Numero de Documento</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Mercancia</th>
                            <th>Termino de pago</th>
                            <th>Fecha Validez</th>
                            <th>Aduana</th>
                            <th colspan=""></th>
                        </tr>
                    </thead>
                    <tbody>                    
                        @php
                            $index = 1
                        @endphp
                        @foreach ($embarques as $embarque)
                            <tr>
                                <td>{{$index}}</td>
                                <td>{{$embarque->num_embarque}}</td>
                                <td>{{$embarque->persona->name}}</td>
                                <td>{{$embarque->fecha}}</td>
                                <td>{{$embarque->mercancia->name}}</td>
                                <td>{{$embarque->terminoPago->name}}</td>
                                <td>{{$embarque->fecha_valida}}</td>
                                <td>{{$embarque->aduana->name}}</td>
                                <td width="10px">
                                    <a class="btn btn-warning btn-sm"  wire:click="showStatus({{ $embarque }})" ><i class='fa fa-history fa-lg'></i></a>   
                                </td>
                                <td width="10px">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.embarques.edit',$embarque)}}">
                                        <i class="fas fa-fw fa-edit"></i></a>
                                </td>
                                <td width="10px">
                                    <a wire:click="showDocumentos({{ $embarque->id }})"class=' btn btn-success'><i class='fa fa-address-card fa-lg'></i></a>   
                                </td>
                                <td width="10px">
                                    <a class="btn btn-info btn-sm"  wire:click="openModalChangeStatus({{ $embarque }})"><i class="fa fa-check fa-lg"></i></a>   
                                </td>
                                {{-- <td width="10px">
                                    <form method="POST"  action="{{route('admin.cotizaciones.destroy',$persona)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td> --}}
                            </tr>
                            
                            @php
                                $index += 1
                            @endphp
                        @endforeach
                    </tbody>

                </table>
                
            </div>

            <div class="card-footer">
                {{$embarques->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay ningun registro...</strong>
            </div>
        @endif
    </div>


    
    @if($showModal)
        <div class="modal fade show modal-dialog-scrollable" tabindex="-1" role="dialog" style="display: block;" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lista de Documentos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {!! Form::label('num_documento', '#Embarque') !!}
                                    {!! Form::text('num_documento', $embarqueSelect->num_embarque, ['class'=>'form-control','placeholder'=>'Numero de Embarque','readonly']) !!}
                            
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('clienteEmbarque', 'Cliente') !!}
                                        {!! Form::text('clienteEmbarque', $embarqueSelect->persona->name, ['class'=>'form-control','placeholder'=>'Cliente','readonly']) !!}
                                
                                    </div>    
                                </div>
                                <div class="form-group col-md-4">                        
                                    <div class="form-group">
                                        {!! Form::label('aduanaEmbarque', 'Aduana') !!}
                                        {!! Form::text('aduanaEmbarque', $embarqueSelect->aduana->name, ['class'=>'form-control','placeholder'=>'Aduana','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                            {{-- @if ($listaDocumentos->count() ) --}}
                            <div class="card">
                                <div class="card-header">
                                    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.proformas.createProformaEmbarque',$embarqueSelect)}}">Nueva Proforma</a>
                                    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.documentosFiscales.createDocumentoFiscalEmbarque',$embarqueSelect)}}">Nueva Factura</a>
                                    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.embarques.createSubEmbarque',$embarqueSelect)}}">Nueva SubEmbarque</a>
                                </div>
                                <div class="card-body  table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tipo de Documento</th>
                                                <th>Num Documento</th>
                                                <th>Monto</th>
                                                <th>Fecha Vencimiento</th>
                                                {{-- <th>Ver</th>
                                                <th>Editar</th> --}}
                                                <th colspan="3"></th>
                                            </tr>
                                        </thead>
                                        <tbody>                        
                                            @php
                                                $index = 1;
                                            @endphp
                                            {{-- {{$embarqueSelect->embarqueCotizacion->cotizacion}} --}}
                                            {{-- {{-- @foreach ($embarqueSelect->cotizaciones as $documento) --}}
                                            @if ($embarqueSelect->embarqueCotizacion->cotizacion ?? false)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>COTIZACION</td>
                                                    <td>{{$embarqueSelect->embarqueCotizacion->cotizacion->num_documento}}</td>
                                                    <td>{{$embarqueSelect->embarqueCotizacion->cotizacion->total}}</td>
                                                    <td>{{$embarqueSelect->embarqueCotizacion->cotizacion->fecha_valida}}</td>
                                                    {{-- <td>
                                                        <a wire:click="editdocumento({{ $embarqueSelect->embarqueCotizacion->cotizacion->id }})" class=' btn btn-success'><i class='fa fa-edit fa-lg'></i></a>               
                                                    </td>
                                                    <td>
                                                         <a wire:click="editdocumento({{ $embarqueSelect->embarqueCotizacion->cotizacion->id }})" class=' btn btn-success'><i class='fa fa-edit fa-lg'></i></a>                                        
                                                    </td> --}}
                                                    <td width="10px">
                                                        <a class="btn btn-warning btn-sm"  wire:click="showStatusCotizacion({{ $embarqueSelect->embarqueCotizacion->cotizacion }})" ><i class='fa fa-history fa-lg'></i></a>   
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-danger dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false">
                                                            PDF
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @foreach ($monedas as $item)
                                                                    <a class="dropdown-item" href="{{ route('admin.cotizaciones.generarPDF', ['cotizacione' => $embarqueSelect->embarqueCotizacion->cotizacion, 'moneda' => $item->id]) }}" target="_blank">{{ $item->name }}</a>
                    
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $index += 1
                                                @endphp
                                            @endif
                                            {{-- @endforeach --}} 
                                            @foreach ($embarqueSelect->proformas as $documento)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>PROFORMA</td>
                                                    <td>{{$documento->num_documento}}</td>
                                                    <td>{{$documento->total}}</td>
                                                    <td>{{$documento->fecha_vencimiento}}</td>
                                                    {{-- <td>
                                                        <a wire:click="editdocumento({{ $documento->id }})" class=' btn btn-success'><i class='fa fa-edit fa-lg'></i></a>    
                                                    </td>
                                                    <td>
                                                        <a wire:click="editdocumento({{ $documento->id }})" class=' btn btn-success'><i class='fa fa-edit fa-lg'></i></a>                                        
                                                    </td> --}}
                                                    <td width="10px">
                                                        <a class="btn btn-warning btn-sm"  wire:click="showStatusProforma({{ $documento }})" ><i class='fa fa-history fa-lg'></i></a>   
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-danger dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false">
                                                            PDF
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @foreach ($monedas as $item)
                                                                    <a class="dropdown-item" href="{{ route('admin.proformas.generarPDF', ['proforma' => $documento, 'moneda' => $item->id]) }}" target="_blank">{{ $item->name }}</a>
                    
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $index += 1
                                                @endphp
                                            @endforeach
                                            @foreach ($embarqueSelect->documentosFiscales as $documento)
                                                {{-- @foreach ($documento->documentosRangos as $sbDocumento) --}}
                                                    <tr>
                                                        <td>{{$index}}</td>
                                                        <td>{{$documento->documentoTipo->name}}</td>
                                                        <td>{{$documento->numero_documento}}</td>
                                                        <td>{{$documento->total}}</td>
                                                        <td>{{$documento->documentoFiscalDetalles->fecha_vencimiento}}</td>
                                                        {{-- <td>
                                                            <a wire:click="editdocumento({{ $documento->id }})" class=' btn btn-success'><i class='fa fa-edit fa-lg'></i></a>    
                                                        </td>
                                                        <td>
                                                            <a wire:click="editdocumento({{ $documento->id }})" class=' btn btn-success'><i class='fa fa-edit fa-lg'></i></a>                                        
                                                        </td> --}}
                                                        <td width="10px">
                                                            <a class="btn btn-warning btn-sm"  wire:click="showStatusDocumentoFiscal({{ $documento }})" ><i class='fa fa-history fa-lg'></i></a>   
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-danger dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false">
                                                                PDF
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    @foreach ($monedas as $item)
                                                                      <a class="dropdown-item" href="{{ route('admin.documentosFiscales.generarPDF', ['documentoFiscal' => $documento, 'moneda' => $item->id]) }}" target="_blank">{{ $item->name }}</a>
                        
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $index += 1
                                                    @endphp
                                                {{-- @endforeach           --}}
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{$personExoneracion->links()}} --}}
                                </div>
                            </div>
                            {{-- @else
                                <div class="card-body">
                                    <strong>No hay ningun registro...</strong>
                                </div>
                            @endif --}}
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

    @if($showModalStatus)
        <div class="modal fade show modal-dialog-scrollable" tabindex="-1" role="dialog" style="display: block;" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seguimiento de Estados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModalStatus">
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
                            <button type="button"  class="btn  btn-warning pull-left" data-dismiss="modal" wire:click="closeModalStatus">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
    @if($showModalChangeStatus)
        <div class="modal fade show modal-dialog-scrollable" tabindex="-1" role="dialog" style="display: block;" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cambiar Estado de Embarque</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModalChangeStatus">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {!! Form::label('newStatus', 'Nuevo Estado') !!}
                                    {!! Form::select('moneda_id', $listEstados, null, ['class'=>'form-control','wire:model.defer'=>"estadoSelect",]) !!}
                                </div>
                                <div class="form-group col-md-8">
                                    {!! Form::label('obserStatus', 'Observación:') !!}  
                                    {!! Form::textarea('obserStatus', null, ['class'=>'form-control','rows'=>2,'wire:model.defer'=>"obserStatus"]) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <button type="button" class="btn  btn-primary pull-left" wire:click="savetatus">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <!-- Agrega otros campos del formulario según tus necesidades -->
                        <div class="modal-footer">
                            <button type="button"  class="btn  btn-warning pull-left" data-dismiss="modal" wire:click="closeModalChangeStatus">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>


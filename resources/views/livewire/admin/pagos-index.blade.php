
<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscar factura">
        </div>
        @if ($documentosFiscales->count() )
            
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Numero de Embarque</th>
                            <th>Numero de Documento</th>
                            <th>Cliente</th>
                            <th>RTN.</th>
                            <th>Fecha de Emision</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Moneda</th>
                            <th>Monto</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1
                        @endphp
                        @foreach ($documentosFiscales as $documentoFiscal)
                            <tr>
                                <td>{{$index}}</td>
                                <td>{{$documentoFiscal->embarque->num_embarque}}</td>
                                <td>
                                    {{$documentoFiscal->documentoTipo->slug}}: {{$documentoFiscal->numero_documento}}
                                    {{-- @foreach ($documentoFiscal->documentosRangos as $documento)
                                        <br>
                                    @endforeach --}}
                                </td>
                                <td>{{$documentoFiscal->embarque->persona->name}}</td>
                                <td>{{$documentoFiscal->embarque->persona->rtn}}</td>
                                <td>{{$documentoFiscal->documentoFiscalDetalles->fecha_emision}}</td>
                                <td>{{$documentoFiscal->documentoFiscalDetalles->fecha_vencimiento}}</td>
                                <td>{{$documentoFiscal->total}}</td>
                                <td>{{$documentoFiscal->documentoFiscalDetalles->moneda->name}}</td>               
                                <td width="10px">
                                    <a class="btn btn-warning btn-sm"  wire:click="showStatus({{ $documentoFiscal }})" ><i class='fa fa-history fa-lg'></i></a>   
                                </td>
                                <td width="10px">
                                    {{-- <a class="btn btn-primary btn-sm" href="{{route('admin.pagos.edit',$factura)}}">Pagos</a> --}}
                                    <a class="btn btn-primary btn-sm"  wire:click="showDocumentos({{ $documentoFiscal }})" class=' btn btn-success'><i class='fa fa-address-card fa-lg'></i></a>   
                                </td>
                                <td width="10px">
                                    {{-- <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false">
                                        PDF
                                        </button>
                                        <div class="dropdown-menu">
                                            @foreach ($monedas as $item)
                                                <a class="dropdown-item" href="{{ route('admin.pagos.generarPDF', ['documentoFiscal' => $documentoFiscal, 'moneda' => $item->id]) }}" target="_blank">{{ $item->name }}</a>

                                            @endforeach
                                        </div>
                                    </div> --}}
                                    {{-- <a class="btn btn-danger btn-sm" href="{{route('admin.pagos.generarPDF',$documentoFiscal)}}">PDF</a> --}}
                                </td>
                                {{-- <td width="10px">
                                    <form method="POST"  action="{{route('admin.facturas.destroy',$persona)}}">
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
                {{$documentosFiscales->links()}}
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
                        <h5 class="modal-title">Lista de Pagos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {!! Form::label('num_documento', '#Embarque') !!}
                                    {!! Form::text('num_documento', $documentoFiscalSelect->embarque->num_embarque, ['class'=>'form-control','placeholder'=>'Numero de Embarque','readonly']) !!}
                            
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('clienteEmbarque', 'Cliente') !!}
                                        {!! Form::text('clienteEmbarque', $documentoFiscalSelect->embarque->persona->name, ['class'=>'form-control','placeholder'=>'Cliente','readonly']) !!}
                                
                                    </div>    
                                </div>
                                <div class="form-group col-md-4">                        
                                    <div class="form-group">
                                        {!! Form::label('documento', $documentoFiscalSelect->documentoTipo->name) !!}
                                        {!! Form::text('documento',$documentoFiscalSelect->numero_documento, ['class'=>'form-control','placeholder'=>'Documento','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    @if ($ultimoEStado->estado=='ELABORADO' || $ultimoEStado->estado=='PAGO RECIBIDO' )
                                        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.pagos.createDocumentoFiscalPago',$documentoFiscalSelect)}}">Agregar Pago</a>
                                    @endif
                                </div>
                                <div class="card-body  table-responsive">
                                    @php
                                        $index = 1;
                                        $totalPago=0;
                                        $saldo=$documentoFiscalSelect->total;
                                        $pagoActual=0;
                                    @endphp
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Numero de Recibo</th>
                                                <th>Fecha</th>
                                                <th>Metodo Pago</th>
                                                <th>Banco</th>
                                                <th>Fecha de Pago</th>
                                                <th>Monto Recibido</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if ($documentoFiscalSelect->pagos->count())
                                            @foreach ($documentoFiscalSelect->pagos as $pago)
                                                @php
                                                    $pagoActual=$pago->pago_actual+$pago->retencion;
                                                @endphp
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>
                                                        {{$pago->num_documento}}
                                                    </td>
                                                    <td>{{$pago->fecha}}</td>
                                                    <td>{{$pago->metodoPago->name}}</td>
                                                    <td>{{$pago->banco->name}}</td>
                                                    <td>{{$pago->fecha_pago}}</td>
                                                    <td>{{$pago->moneda->name}} {{$pagoActual}}</td>
                                                    {{-- <td width="10px">
                                                        <a class="btn btn-primary btn-sm" href="{{route('admin.pagos.edit',$pago)}}">Editar</a>
                                                    </td> --}}
                                                    <td width="10px">
                                                        <button type="button" class="btn btn-danger dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false">
                                                            PDF
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @foreach ($monedas as $item)
                                                                    <a class="dropdown-item" href="{{ route('admin.pagos.generarPDF', ['pago' => $pago, 'moneda' => $item->id]) }}" target="_blank">{{ $item->name }}</a>
                    
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $totalPago+=$pagoActual;
                                                    $saldo-=$pagoActual;
                                                    $index += 1;
                                                @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td>--</td>
                                                <td>--</td>
                                                <td>--</td>
                                                <td>--</td>
                                                <td>--</td>
                                                <td>--</td>
                                                <td width="10px"></td>
                                            </tr>
                                         @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>Monto:</td>
                                                <td>{{$documentoFiscalSelect->documentoFiscalDetalles->moneda->name}}</td>
                                                <td>{{$documentoFiscalSelect->total}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>Total pago Recibido:</td>
                                                <td>{{$documentoFiscalSelect->documentoFiscalDetalles->moneda->name}}</td>
                                                <td>{{$totalPago}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>Saldo:</td>
                                                <td>{{$documentoFiscalSelect->documentoFiscalDetalles->moneda->name}}</td>
                                                <td>{{$saldo}}</td>
                                            </tr>
                                        </tfoot>
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
</div>

<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscar Costo / Gasto">
        </div>
        @if ($gastos->count() )
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Numero de Embarque</th>
                            <th>Cliente</th>
                            <th>Partida de Gasto</th>
                            <th>Descripcon de Gasto.</th>
                            <th>Proveedor</th>
                            <th>Documento</th>
                            <th>Moneda</th>
                            <th>Total Factura</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1
                        @endphp
                        @foreach ($gastos as $gasto)
                            <tr>
                                <td>{{$index}}</td>
                                @if ($gasto->embarque->count())
                                    @foreach ($gasto->embarque as $item)
                                        <td>{{$item->num_embarque}}</td>
                                        <td>{{$item->persona->name}}</td>
                                    @endforeach
                                @else
                                    <td>{{$gasto->tipoCosto->name}}</td>
                                    <td></td>
                                @endif
                                <td>{{$gasto->servicio->name}}</td>
                                <td>{{$gasto->descripcion}}</td>
                                <td>{{$gasto->proveedor->name}}</td>
                                <td>{{$gasto->documento_cobro}}</td>
                                <td>{{$gasto->moneda->name}}</td>
                                <td>{{$gasto->valor_neto_factura}}</td>
                                <td width="10px">
                                    <a class="btn btn-warning btn-sm"  wire:click="showStatus({{ $gasto }})" class=' btn btn-success'><i class='fa fa-history fa-lg'></i></a>   
                                </td>
                                <td width="10px">
                                    {{-- <a class="btn btn-primary btn-sm" href="{{route('admin.pagos.edit',$factura)}}">Pagos</a> --}}
                                    <a class="btn btn-primary btn-sm"  wire:click="showDocumentos({{ $gasto->id }})" class=' btn btn-success'><i class='fa fa-address-card fa-lg'></i></a>   
                                </td>
                                {{-- <td width="10px">
                                    <a class="btn btn-danger btn-sm" href="{{route('admin.pagos.generarPDF',$gasto)}}">PDF</a>
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
                {{$gastos->links()}}
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
                        <h5 class="modal-title">Lista de Pagos Gastos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                                @if ($costoSelect->embarque->count())
                                    @foreach ($costoSelect->embarque as $item)
                                        <div class="form-group col-md-4">
                                            {!! Form::label('num_documento', '#Embarque') !!}
                                            {!! Form::text('num_documento', $item->num_embarque, ['class'=>'form-control','placeholder'=>'Numero de Embarque','readonly']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('clienteEmbarque', 'Cliente') !!}
                                            {!! Form::text('clienteEmbarque', $item->persona->name, ['class'=>'form-control','placeholder'=>'Cliente','readonly']) !!}
                                        </div> 
                                    @endforeach
                                @else
                                    <div class="form-group col-md-4">
                                        {!! Form::label('tipoCosto', '#Tipo de Costo') !!}
                                        {!! Form::text('tipoCosto', $costoSelect->tipoCosto->name, ['class'=>'form-control','placeholder'=>'Tipo de Costo de Embarque','readonly']) !!}
                                    </div>
                                @endif
                                <div class="form-group col-md-4">                        
                                    {!! Form::label('servicio', 'Servicio') !!}
                                    {!! Form::text('servicio', $costoSelect->servicio->name, ['class'=>'form-control','placeholder'=>'Servicio','readonly']) !!}
                                </div>
                                <div class="form-group col-md-4">    
                                    {!! Form::label('proveedor', 'Proveedor') !!}
                                    {!! Form::text('proveedor', $costoSelect->proveedor->name, ['class'=>'form-control','placeholder'=>'Proveedor','readonly']) !!}
                                </div>
                                <div class="form-group col-md-4">    
                                    {!! Form::label('total', 'Total Factura') !!}
                                    {!! Form::text('total', $costoSelect->total, ['class'=>'form-control','placeholder'=>'Total Factura','readonly']) !!}
                                </div>
                            </div>
                            {{-- @if ($listaDocumentos->count() ) --}}
                            <div class="card">
                                <div class="card-header">
                                    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.costos.createEmbarquePago',$costoSelect)}}">Agregar Pago</a>
                                </div>
                                <div class="card-body  table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fondo Bancario</th>
                                                <th>Fecha de Pago</th>
                                                <th>Monto Recibido</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $index = 1
                                            @endphp
                                            @foreach ($costoSelect->pagos as $pago)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$pago->cuentaBancaria->name}}</td>
                                                    <td>{{$pago->created_at}}</td>
                                                    <td>{{$pago->total_pago}}</td>
                                                    <td width="10px">
                                                        <a class="btn btn-primary btn-sm" href="{{route('admin.pagos.edit',$pago)}}">Editar</a>
                                                    </td>
                                                    {{-- <td width="10px">
                                                        <a class="btn btn-danger btn-sm" href="{{route('admin.pagos.generarPDF',$pago)}}">PDF</a>
                                                    </td> --}}
                                                </tr>
                                                
                                                @php
                                                    $index += 1
                                                @endphp
                                            @endforeach
                                        </tbody>
                    
                                    </table>
                                    {{-- {{$personExoneracion->links()}} --}}
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

<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscar servicio">
        </div>
        @if ($servicios->count() )
            
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Concepto de Servicio</th>
                            <th>Cuenta de Gasto</th>
                            <th>Tipo de Valor</th>
                            <th>Estado</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                            <tr>
                                <td>{{$servicio->id}}</td>
                                <td>{{$servicio->name}}</td>
                                <td>{{$servicio->cuenta->name}}</td>
                                <td>{{$servicio->valueType->name}}</td>
                                <td>{{$servicio->status}}</td>
                                <td width="10px">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.servicios.edit',$servicio)}}">Editar</a>
                                </td>
                                {{-- <td width="10px">
                                    <form method="POST"  action="{{route('admin.servicios.destroy',$persona)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                
            </div>

            <div class="card-footer">
                {{$servicios->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay ningun registro...</strong>
            </div>
        @endif
    </div>
</div>

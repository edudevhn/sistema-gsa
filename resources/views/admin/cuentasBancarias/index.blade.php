@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    @can('admin.cuentasBancarias.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.cuentasBancarias.create')}}">Nuevo Registro</a>
    @endcan
    <h1>Lista de Cuentas Bancarias</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Numero Cuenta</th>
                        <th>Banco</th>
                        <th>Tipo</th>
                        <th>Moneda</th>
                        <th>Defecto</th>
                        <th>Estado</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuentasBancarias as $cuentaBancaria)
                        <tr>
                            <td>{{$cuentaBancaria->id}}</td>
                            <td>{{$cuentaBancaria->name}}</td>
                            <td>{{$cuentaBancaria->num_cuenta}}</td>
                            <td>{{$cuentaBancaria->banco->name}}</td>
                            <td>{{$cuentaBancaria->tipoCuenta->name}}</td>
                            <td>{{$cuentaBancaria->moneda->name}}</td>
                            <td>{{$cuentaBancaria->predeterminado}}</td>
                                @if ($cuentaBancaria->status==1)
                                <td>BAJA</td>        
                                @else
                                    <td>ALTA</td>        
                                @endif
                            <td width="10px">
                                @can('admin.cuentasBancarias.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.cuentasBancarias.edit',$cuentaBancaria)}}">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    </div>
@stop

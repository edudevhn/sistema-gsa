@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Proforma </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.proformas.storeProformaEmbarque', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!}
            {{-- {!! Form::model($embarque,['route'=>['admin.proformas.storeProformaEmbarque',$embarque], 'autocomplete'=>'off','files'=>true,'method'=>'POST']) !!} --}}
                
            {{-- {!! Form::open(['route'=>'admin.facturas.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!} --}}
                @include('admin.proformas.partials.form')
                {!! Form::submit('Crear Proforma', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop


@section('js')
 
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Seleccionar cliente",
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }
            });
        });
    </script>
@endsection

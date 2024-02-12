@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Embarque </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.embarques.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!}
                @include('admin.embarques.partials.form')
                {!! Form::submit('Crear Embarque', ['class'=>'btn btn-primary']) !!}
                

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

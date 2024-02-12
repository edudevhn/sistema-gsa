@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear Cotizacion </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.cotizaciones.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!}
                @include('admin.cotizaciones.partials.form')
                {!! Form::submit('Crear Cotizacion', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop


@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
        .create( document.querySelector( '#notas' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endsection
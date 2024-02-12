@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Editar Cotizacion</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>

    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($cotizacione,['route'=>['admin.cotizaciones.update',$cotizacione], 'autocomplete'=>'off','files'=>true,'method'=>'PUT']) !!}
                
                @include('admin.cotizaciones.partials.form')
                {!! Form::submit('Actualizar Cotizacion', ['class'=>'btn btn-primary']) !!}
                

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
@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Crear persona </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.personas.store', 'autocomplete'=>'off','files'=>true,'class'=>'form-horizontal']) !!}
                @include('admin.personas.partials.form')
                {!! Form::submit('Crear persona', ['class'=>'btn btn-primary']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Obtener referencia al radio button y al div
            var radio = $('#exonerado');
            var radio2 = $('#exonerado2');
            var div = $('.miDiv');

            // Controlar la visibilidad del div al cambiar el estado del radio button
            radio.change(function() {
            if (radio.is(':checked')) {
                div.addClass('d-none'); // Ocultar el div
            }
            });
            radio2.change(function() {
            console.log(radio2);
            if (radio2.is(':checked')) {
                div.removeClass('d-none'); // Mostrar el div
            } 
            });
        });
    </script>
@endsection
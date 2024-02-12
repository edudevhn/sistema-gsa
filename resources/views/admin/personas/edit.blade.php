@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Editar persona</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>

    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($persona,['route'=>['admin.personas.update',$persona], 'autocomplete'=>'off','files'=>true,'method'=>'PUT']) !!}
                
                @include('admin.personas.partials.form')
                {!! Form::submit('Actualizar persona', ['class'=>'btn btn-primary']) !!}
                

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
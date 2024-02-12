@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Asignar un Rol</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre:</p>
            <p class="form-control">{{$user->name}}</p>

            <h2 class="h5">Listado de Roles</h2>
            {!! Form::model($user,['route'=>['admin.users.update',$user],'method'=>'put']) !!}
                @foreach ($roles as $rol)
                    <div>

                        <label >
                            {!! Form::checkbox('roles[]', $rol->id, null,['class'=>'mr-1']) !!}     
                            {{$rol->name}}       
                        </label>
                        @endforeach
                    </div>
                {!! Form::submit('Asignar Rol', ['class'=>'btn btn-primary mt-2']) !!}
                

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@endsection
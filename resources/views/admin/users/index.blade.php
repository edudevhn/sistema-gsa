@extends('adminlte::page')

@section('title', 'GSA')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
    @endif
    @livewire('admin.users-index')
@stop

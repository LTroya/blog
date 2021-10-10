@extends('adminlte::page')

@section('title', 'Blog - Coders Free')

@section('content_header')

    <a class="btn btn-secondary -btn-sm float-right" href="{{route('admin.posts.create')}}">Nuevo post</a>

    <h1>Listado de post</h1>
@stop

@section('content')
    {{-- Alerta de realizado con exito con bootstrap --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.posts-index')
@stop

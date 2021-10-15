@extends('adminlte::page')

@section('title', 'Blog - Coders Free')

@section('content_header')

    {{-- Crear boton de agregar categoria --}}
    @can('admin.categories.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.categories.create')}}">Agregar categoria</a>
    @endcan

    <h1>Lista de categorias</h1>
@stop

{{-- contenido --}}
@section('content')
    {{-- Alerta de realizado con exito con bootstrap --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    {{-- crear una tarjeta -> ESTILOS BOOSTSTRAP --}}
    <div class="card">

        {{-- insertar datos de categoria en la tarjeta--}}
        <div class="card-body">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            {{-- boton editar --}}
                            <td width='10px'>
                                @can('admin.categories.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.categories.edit', $category)}}">Editar</a>
                                @endcan
                            </td>
                            {{-- boton eliminar --}}
                            <td width='10px'>
                                @can('admin.categories.destroy')
                                    <form action="{{route('admin.categories.destroy', $category)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" >Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

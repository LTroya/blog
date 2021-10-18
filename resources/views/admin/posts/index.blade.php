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

@section('js')
    <script src="{{asset('js/app.js')}}"></script>
    
    <script>
        $('.form-delete').submit(function(e){
            e.preventDefault();

        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡La etiqueta se eliminara definitivamente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
            })//swal
        });

    </script>
@endsection
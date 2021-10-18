@extends('adminlte::page')

@section('title', 'Blog - Coders Free')

@section('content_header')

    @can('admin.tags.create')
        <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.tags.create')}}">Nueva etiqueta</a>
    @endcan

    <h1>Mostrar listado de etiquetas</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-stripped">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td width="10px">
                                @can('admin.tags.edit')
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.tags.edit', $tag)}}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.tags.destroy')
                                    <form class="form-delete" action="{{route('admin.tags.destroy', $tag)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
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
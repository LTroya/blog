@extends('adminlte::page')

@section('title', 'Blog - Coders Free')

@section('content_header')
<a class="btn btn-secondary -btn-sm float-right" href="{{route('admin.roles.create')}}">Nuevo rol</a>
    <h1>Lista de roles</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif

    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td width="10px">
                            <a href="{{route('admin.roles.edit', $role)}}" class="btn btn-sm btn-primary">Editar</a>
                        </td>
                        <td width="10px">
                            <form class="form-delete" action="{{route('admin.roles.destroy', $role)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

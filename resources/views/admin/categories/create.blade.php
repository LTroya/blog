@extends('adminlte::page')

@section('title', 'Blog - Coders Free')

@section('content_header')
    <h1>Crear nueva categoria</h1>
@stop

@section('content')
    {{-- Alerta de realizado con exito con bootstrap --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    {{-- tarjeta --}}
    <div class="card">
        {{-- cuerpo de tarjeta --}}
        <div class="card-body">
            {{-- formulario con laravel collectivce --}}
            {!!Form::open(['route'=> 'admin.categories.store'])!!}
                {{-- nombre --}}    
                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {!! Form::text('name', null, /* atributos adicionales */['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria']) !!}
                    
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror

                    </div>
                {{-- Slug --}}
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la categoria', 'readonly']) !!}
                    
                        @error('slug')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                   
                    {!! Form::submit('Crear categoria', ['class' => 'btn btn-primary']) !!}

            {!!Form::close()!!}
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
@extends('adminlte::page')

@section('title', 'Blog - Coders Free')

@section('content_header')
    <h1>Crear nueva categoria</h1>
@stop

@section('content')
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
                    </div>
                {{-- Slug --}}
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la categoria']) !!}
                    </div>
                   
                    {!! Form::submit('Crear categoria', ['class' => 'btn btn-primary']) !!}

            {!!Form::close()!!}
        </div>
    </div>
@stop

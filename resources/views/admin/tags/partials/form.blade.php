<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la etiqueta...']) !!}

    @error('name')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('slug', 'slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la etiqueta...', 'readonly']) !!}

    @error('slug')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>
{{-- seleccion de colores pero con HTML --}}
{{-- <div class="form-group">
    <label for="">Color</label>
    <select class="form-control" name="color" >
        <option class="bg-red" value="red">Rojo</option>
        <option class="bg-green" value="green">Verde</option>
        <option class="bg-blue" value="blue" selected>Azul</option>
        
    </select>
</div>  --}}

{{-- Seleccion de colores pero con laravel collective --}}

<div class="form-group">

    {!! Form::label('color', 'Color') !!}
    {!! Form::select('color', $colors/* array de colores */, null/* seleccionado por defecto */, ['class' => 'form-control']) !!}

    @error('color')
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>
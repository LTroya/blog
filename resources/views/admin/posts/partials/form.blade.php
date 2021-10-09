<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}

    @error('name')
        <small class="text-danger">{{$message}}</small> 
    @enderror

</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug del post', 'readonly']) !!}

    @error('slug')
        <small class="text-danger">{{$message}}</small> 
    @enderror
</div>

<div class="form-group">
    {!! Form::label('category_id','Categoria') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

    @error('category_id')
        <small class="text-danger">{{$message}}</small> 
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>

    @foreach ($tags as $tag)
        <label class="mr-2">
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{$tag->name}}
        </label>
    @endforeach

    @error('tags')
        <br>
        <small class="text-danger">{{$message}}</small> 
    @enderror

</div>

<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label>
        {!! Form::radio('status', 1, true) !!}
        Borrador
    </label>
    <label>
        {!! Form::radio('status', 2, false) !!}
        publicado
    </label>

    @error('status')
        <br>
        <small class="text-danger">{{$message}}</small> 
    @enderror
</div>

{{-- grid con bootstrap --}}
<div class="row mb-3">
    {{-- imagen por defecto --}}
    <div class="col">
        <div class="image-wrapper">
            @isset ($post->image)
                <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2020/11/26/07/41/maine-coon-5778153__340.jpg" alt="">
            @endisset
            
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'imagen que se mostrara en el post') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
        
            @error('file')
                <span class="text-danger">{{$message}}</span> 
            @enderror

        </div>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus iste reiciendis id beatae voluptatem autem quaerat, nesciunt veniam quo aut consectetur ullam veritatis iure neque. Reiciendis culpa laborum obcaecati dolor.</p>

    </div>
</div>
{{-- fin grid --}}
<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

    @error('extract')
        <small class="text-danger">{{$message}}</small> 
    @enderror

</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo del post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

    @error('body')
        <small class="text-danger">{{$message}}</small> 
    @enderror
</div>
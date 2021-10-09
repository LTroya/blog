<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   /* pluck retorna un array y con dos parametros el array es atributo valor
        tomando el segundo parametro como llave */
        /* coleccion de categorias */
        $categories = Category::pluck('name', 'id');
        /* coleccion de etiquetas */
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        
        $post = Post::create($request->all());
        /* verificar si se cargo o no una imagen
        y en caso de cargar una moverla a la carpeta storage */
        if($request->file('file')){
            $url = Storage::put('public/posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);

        }/* if imagen */

        /* la condicion valida si alguna etiqueta/tag fue seleccionada
        y la guarda en la tabla post-tag
        el metodo attach recibe un array
        el array es la seleccion de los tags asignados 
        al crear un post */
        if($request->tags){
            $post->tags()->attach($request->tags);
        }/* if tags */

        return redirect()->route('admin.posts.edit', $post);
    }/* store */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        if($request->file('file')){
            $url = Storage::put('public/posts', $request->file('file'));
            //if eliminar imagen anterior
            if($post->image){
                Storage::delete($post->image->url);
                
                $post->image->update([
                    'url' => $url
                ]);
            }
            else{

                $post->image()->create([
                    'url' => $url
                ]);

            }//if eliminar imagen anterior 

            if($request->tags){
                $post->tags()->attach($request->tags);
            }/* if tags */
       
        }//if verificar si hay imagen cargada
        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizo con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

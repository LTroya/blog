<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct(){

        //para proteger las rutas con los permisos
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {   /* pluck retorna un array y con dos parametros el array es atributo valor
        tomando el segundo parametro como llave */
        /* coleccion de categorias */
        $categories = Category::pluck('name', 'id');
        /* coleccion de etiquetas */
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

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

        Cache::flush();

        /* la condicion valida si alguna etiqueta/tag fue seleccionada
        y la guarda en la tabla post-tag
        el metodo sync recibe un array
        el array es la seleccion de los tags asignados 
        al crear un post y los sincroniza en la tabla*/
        if($request->tags){
            $post->tags()->attach($request->tags);
        }/* if tags */

        return redirect()->route('admin.posts.edit', $post);
    }/* store */

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {   
        
        $this->authorize('author', $post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, Post $post)
    {   
        $this->authorize('author', $post);

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
                $post->tags()->sync($request->tags);
            }/* if tags */
       
        }//if verificar si hay imagen cargada

        Cache::flush();

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizo con exito!');
    }

    public function destroy(Post $post)
    {   
        $this->authorize('author', $post);
        
        $post->delete();

        Cache::flush();
        
        return redirect()->route('admin.posts.index')->with('info', 'El post se elimino con exito!');
    }
}

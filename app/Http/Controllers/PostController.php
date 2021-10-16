<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

/* trabajar con cache */
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(){

        if(request()->page){
            $key = 'posts' . request()->page;
        }else{
            $key = 'posts';
        }

        //consulta con cache
        if(Cache::has($key)){
            $posts = Cache::get($key);
        }else{
            $posts = Post::where('status', 2)->latest('id')->paginate(8);
            //cache primer parametro donde se va a guardar
            //segundo parametro que se va a guardar
            //tercer parametro cuanto tiempo se va a guardar
            Cache::put($key, $posts);
        }//fin if cache

        $posts = Post::where('status', 2)->latest('id')->paginate(8);

        return view('posts.index', compact('posts'));
    }//index

    public function show(Post $post, Category $category){

        $this->authorize('published', $post);

        $similares = Post::where('category_id', $post->category_id)
        ->where('status', 2)
        ->where('id','!=', $post->id)
        ->latest('id')
        ->take(4)
        ->get();
        
        return view('posts.show', compact('post', 'similares'));
    }//show

    public function category(Category $category){
        $posts = Post::where('category_id', $category->id)
        ->where('status',2)
        ->latest('id')
        ->paginate(4);

        return view('posts.category',compact('posts', 'category'));
    }//category

    public function tag(Tag $tag){
        $posts = $tag->posts()->where('status',2)->latest('id')->paginate(4);

        return view('posts.tag', compact('posts','tag'));
    }
}

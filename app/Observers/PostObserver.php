<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{

    /* creating es antes de crear */
    public function creating(Post $post)
    {
        if(! \App::runningInConsole()){
            $post->user_id = auth()->user()->id;
        }
        
    }


    /* deleting es antes de eliminar */
    public function deleting(Post $post)
    {
        if($post->image){
            Storage::delete($post->image->url);
        }
    }
}

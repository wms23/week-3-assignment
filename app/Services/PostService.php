<?php 
namespace App\Services;
use App\Post;
use \Cache;
use \Mail;
use App\Mail\PostCreate;
use App\Mail\PostUpdate;

class PostService{

    public function make($data){
        
        $data['author_id'] = \Auth::user()->id;
        $post = Post::create($data);

        Cache::forever('post.' . $post->id, $post);

        Mail::to('th.ucsy@gmail.com')->send(
            new PostCreate($post)
        );

        return $post;
    }
   
} 
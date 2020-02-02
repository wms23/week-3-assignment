<?php
namespace App\Repositories;
use App\Post;
use \Cache;


class PostRepository
{

    public function find($id)
    {
        if (Cache::get('post.' . $id)) {
            $post = Cache::get('post.' . $id);
        } else {
            $post = Post::find($id);
            Cache::forever('post.' . $id, $post);
        }
        return $post;
    }

    public function all()
    {

    }

}

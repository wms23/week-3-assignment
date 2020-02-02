<?php
namespace App\Repositories;

use App\Post;
use \Cache;

class PostRepository
{

    public function find($id)
    {
        return Cache::rememberForever('post.' . $id,
            function () use ($id) {
                return Post::findOrFail($id);
            });
        // if (Cache::has('post.' . $id)) {
        //     $post = Cache::get('post.' . $id);
        // } else {
        //     $post = Post::find($id);
        //     Cache::forever('post.' . $id, $post);
        // }
        // return $post;
    }

    public function all()
    {
        return Cache::rememberForever('posts',
            function () {
                return Post::all();
            });

    }

    public function guestPost()
    {
        return Post::published()
            ->defaultOrder()
            ->paginate(5);
    }

    public function memberPost()
    {
        // $user_id = auth()->user()->id;
        // $posts = Post::published()
        //     ->orWhere(function ($query) use ($user_id) {
        //         $query->postOwner($user_id);
        //     })
        //     ->get();
        $posts = Post::published()
            ->orWhere
            ->postOwner()
            ->defaultOrder()
            ->paginate(5);

        return $posts;
    }

}

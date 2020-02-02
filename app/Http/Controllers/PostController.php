<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSaveRequest;
use App\Mail\PostUpdate;
use App\Post;
use App\Traits\Notify;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use Notify;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guest()) {
            $posts = Post::published()->paginate(5);
        } else {
            $user_id = auth()->user()->id;
            // $posts = Post::published()
            //     ->orWhere(function ($query) use ($user_id) {
            //         $query->postOwner($user_id);
            //     })
            //     ->get();
            $posts = Post::published()
                ->orWhere
                ->postOwner($user_id)
                ->paginate(5);
        }

        return view('post.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', POST::class);
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostSaveRequest $request)
    {
        $this->authorize('create', POST::class);

        $data = $request->validated();
        $data['author_id'] = \Auth::user()->id;
        $post = Post::create($data);

        \Cache::forever('post.' . $post->id,$post);

        return redirect(route('post.show', $post->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post_id = $post;

        if (\Cache::get('post.' . $post_id)) {
            $post = \Cache::get('post.' . $post_id);
        } else {
            $post = Post::find($post_id);
            \Cache::forever('post.' . $post->id, $post);
        }

        $this->authorize('view', $post);              

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $this->authorize('view', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function update(PostSaveRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->validated());
        \Mail::to('th.ucsy@gmail.com')->send(
            new PostUpdate($post)
        );

        // $this->notifyAdminViaSlack("This message will send to admin");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

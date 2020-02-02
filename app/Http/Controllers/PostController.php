<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSaveRequest;
use App\Repositories\PostRepository;
use App\Services\PostService;
use App\Traits\Notify;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use Notify;

    public function __construct(
        PostRepository $repository,
        PostService $service) {

        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guest()) {
            $posts = $this->repository->guestPost();
        } else {
            $posts = $this->repository->memberPost();
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
        $this->authorize('create', \App\Post::class);
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
        $this->authorize('create', \App\Post::class);

        $post = $this->service->make($request->validated());

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
        $post = $this->repository->find($post);

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

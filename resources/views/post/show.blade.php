@extends('layouts.app')

@section('content')
    
    <div>
        <h2>{{$post->title}}</h2>
        <p>Written by : <strong>{{$post->author->name}}</strong> </p>
        <p>Created by : <strong>{{$post->created_at}}</strong></p>
        <p>Is Published Post : <strong>{{$post->is_published ? 'Yes' : 'No' }}</strong></p>
        @if(!$post->is_published)
        <form action="{{route('post.update',$post->id)}}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="is_published" value="1"/>
            <button class='btn btn-primary'>Publish the post</button>
        </form>
        @endif
        <p>{!! nl2br($post->content) !!}</p>
    </div>
    <a href="{{route('post.index')}}">Back to list</a>


    @endsection
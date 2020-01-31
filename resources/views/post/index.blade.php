@extends('layouts.app')

@section('content')

@foreach($posts as $post)
    <div>
        <h2><a href="{{route('post.show',$post->id)}}">{{$post->title}}</a></h2>
        <p>Written by : <strong>{{$post->author->name}}</strong> </p>
        <p>Created by : <strong>{{$post->created_at}}</strong></p>
        <p>Is Published Post : <strong>{{$post->is_published ? 'Yes' : 'No' }}</strong></p>
        <p>{{$post->excerpt}}</p>
    </div>
@endforeach

{{ $posts->links() }}

@endsection

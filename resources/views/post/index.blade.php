@foreach($posts as $post)
    <div>
        <h2>{{$post->title}}</h2>
        <p>Written by : <strong>{{$post->author->name}}</strong> </p>
        <p>Created by : <strong>{{$post->created_at}}</strong></p>
        <p>{{$post->content}}</p>
    </div>
@endforeach

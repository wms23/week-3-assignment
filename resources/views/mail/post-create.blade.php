@component('mail::message')
# New Post is created

<h1> {{$post->title}} </h1>
{{ $post->content }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{$post->author->name}}
@endcomponent

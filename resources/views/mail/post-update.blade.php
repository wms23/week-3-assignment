@component('mail::message')
# Introduction 

This is for {{$post->title}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

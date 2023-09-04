@extends('base')
@section('title', isset($title) ? $title : $post->title)
@section('content')

<article>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
</article>

@endsection

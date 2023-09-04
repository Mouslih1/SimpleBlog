@extends('base')
@section('title', isset($title) ? $title : 'Acceuil Blog')
@section('content')
    <h1>My Blog</h1>
    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>
            <p class="small">
                @if ($post->category)
                    Category : {{ $post->category?->name }}
                    @if (!$post->tags->isEmpty())
                        ,
                    @endif
                @endif

                @if (!$post->tags->isEmpty())
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                @endif

            </p>
            @if ($post->image)
                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" width="500" height="250">
            @endif
            <p>{{ $post->content }}</p>
            <p><a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire
                    la suite</a></p>
        </article>
    @endforeach

    {{ $posts->Links() }}
@endsection

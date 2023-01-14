@extends('layout')
@section('content')
    <h1>
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}">
            {{ $post->title }}
        </a>
    </h1>
    <p>{{ $post->content }}</p>

    <h3>Comments:</h3>
    @forelse ($post->comments as $comment)
        <div class="bg-secondary text-white d-flex">
            <p class="p-2 m-2">{{ $comment->content }}</p>
            <div class="ms-auto m-2 p-2">
                <p class="">Added: <span class="badge bg-primary">{{ $comment->created_at->diffForHumans() }}</span>
                </p>
            </div>
        </div>
        <hr class="m-2 border-5">
    @empty
        <p class="p-2 m-2">No Comments Found.</p>
    @endforelse

    <p>Post Added: <span class="badge bg-primary">{{ $post->created_at->diffForHumans() }}</span></p>
@endsection

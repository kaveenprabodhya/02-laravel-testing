@extends('layout')
@section('content')
    <h3>Edit Post</h3>
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" />
        <label for="content">Content</label>
        <input type="text" name="content" id="content" value="{{ old('content', $post->content) }}" />
        <input type="submit" value="create!">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        @include('posts._form')
    </form>
@endsection

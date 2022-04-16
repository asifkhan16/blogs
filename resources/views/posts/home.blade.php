@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1>Posts</h1>
    @include('include.message')
     @if (count($posts) > 0)
        @foreach($posts as $post)
        <a href="/posts/{{ $post->id }}">
        <div class="d-post row p-3 mb-3 rounded">
                <div class="col-md-3">
                    <img width="100%" src="storage/cover_image/{{ $post->cover_image }}" alt="">
                </div>
                <div class="col-md-9">
                    <h1>{{ $post->title }}</h1>
                    <small>Written in {{ $post->created_at }} by {{ $post->user->name }}</small>
                </div>
            </div>
        </a>
        @endforeach
    @else 
        <p>post not found</p>
    @endif
        
        {{ $posts->links() }}
</div>
@endsection
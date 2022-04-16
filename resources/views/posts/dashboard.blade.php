@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1>Posts</h1>
    @include('include.message')
        @forelse($posts as $post)
            <div class="d-post row p-3 mb-3 rounded">
                <div class="col-md-3">
                    <img width="100%" src="storage/cover_image/{{ $post->cover_image }}" alt="">
                </div>
                <div class="col-md-6">
                    <h1>{{ $post->title }}</h1>
                    <small>{{ $post->created_at }}</small>
                </div>
                <div class="col-md-3">
                    <a href="/posts/destroy/{{ $post->id }}" class="btn btn-danger">Delete</a>
                    <a href="/posts/{{$post->id}}/edit"  class="btn btn-primary">Edit</a>
                </div>
                
            </div>
        @empty
            <p>no post found</p>
        @endforelse
        
        </div>
        {{-- {{ $posts->links() }} --}}
</div>
@endsection
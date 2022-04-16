@extends('layouts.app')
@section('content')
<div class="container mb-5 px-5">
    <div>
        <a href="/posts" class="btn btn-light">Go back</a>
        <div class="w-75">
            <img width="100%" src="{{ asset('storage/cover_image/'.$post->cover_image)}}" alt="image not found">
        </div>
        <div class="mt-4">
            <h1 class="mb-3">{{ $post->title }}</h1> 
            <p style="word-wrap: break-word"> <?php echo $post->body ?> </p>
        </div>
    </div>
    
</div>
@endsection
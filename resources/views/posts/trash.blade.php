@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1>Trash Posts</h1>
    @include('include.message')
        @forelse($trashposts as $trashpost)
            <div class="d-post row p-3 mb-3 rounded">
                <div class="col-md-3">
                    <img width="100%" src="storage/cover_image/{{ $trashpost->cover_image }}" alt="image not found">
                </div>
                <div class="col-md-6">
                    <h1>{{ $trashpost->title }}</h1>
                    <small>{{ $trashpost->created_at }}</small>
                </div>
                <div class="col-md-3">
                    <a href="/trash/delete/{{ $trashpost->id }}" class="btn btn-danger">Delete</a>
                    <a href="/trash/restore/{{$trashpost->id}}"  class="btn btn-primary">Restore</a>
                </div>
                
            </div>
        @empty
            <p>no post found</p>
        @endforelse
        
        </div>
        {{-- {{ $trashposts->links() }} --}}
</div>
@endsection
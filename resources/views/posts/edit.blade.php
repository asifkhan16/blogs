@extends('layouts.app')
@section('content')
<div class="w-75 mx-auto p-4 mt-5 rounded d-form">
    @include('include.message')
    <a href="/posts" class="btn btn-light">go back</a>
    <h2>Edit Post</h2>
    {{ Form::open(['route' => ['posts.update' , $post->id] , 'method'=>'PUT', 'enctype'=>'multipart/form-data']) }}
        <div class="form-group">
            {{ Form::label('title' , 'Title') }}
            {{ Form::text('title',$post->title,['class'=>'form-control','placholder'=>'Title']) }}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('body','Body') }}
            {{ Form::textarea('body',$post->body,['class'=>'form-control','placholder'=>'Body Text', 'id'=>'summary-ckeditor']) }}
            
        </div>
        <div class="form-group mb-3">
            {{ Form::file('cover_image',)}}
            
        </div>
        {{ Form::hidden('_method','PUT') }}
        {{ Form::submit('Post', ['class'=>'btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection
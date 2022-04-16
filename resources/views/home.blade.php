@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome To My First Project') }}</div>
                
                <div class="card-body">
                    @Auth
                        <h2 class="text-center">The User <strong> {{ Auth::user()->name }} </strong> is login</h2>
                    @endAuth
                    @guest
                        <div class="w-75 mx-auto text-center">
                            <h5>In this Project you can Create your own Post and also you can Read other Post</h5>
                            <a href="{{ route('login') }}" class="btn btn-primary me-3">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-light">Register</a>
                        </div>
                    @endguest
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts/main-layout')

@section('content')
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $post->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-secondary">{{ $post->category->name }} | {{ $post->user->name }}</h6>
                        <p class="card-text">{{ $post->body }}</p>
                    </div>
                </div>
            </div>
    </div>

@endsection


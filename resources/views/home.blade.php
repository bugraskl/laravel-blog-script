@extends('layouts/main-layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary">Welcome to my blog</h5>
                    <h6 class="card-subtitle mb-2 text-secondary">Here you can read some of my posts</h6>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, quod.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary">Subscribe to my blog</h5>
                    <form action="/subscribe" method="POST">
                        @csrf
                        <div class="d-flex gap-2 mb-1">
                            <input class="form-control" type="email" name="email" placeholder="Enter your email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach ($posts as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-center gap-2 mb-3">
                            @if($post->thumb)
                                @if (filter_var($post->thumb, FILTER_VALIDATE_URL))
                                    <!-- Eğer thumb bir URL ise -->
                                    <img src="{{ $post->thumb }}" alt="{{ $post->title }}" class="img-thumbnail thumb-img">
                                @else
                                    <!-- Eğer thumb yerel bir dosya ise -->
                                    <img src="{{ asset('storage/' . $post->thumb) }}" alt="{{ $post->title }}" class="img-thumbnail thumb-img">
                                @endif
                            @endif
                            <div>
                                <a href="{{ 'posts/' . $post->id }}"><h5 class="card-title text-primary">{{ Str::limit($post->title, 50) }}</h5></a>
                                <h6 class="card-subtitle mb-2 text-secondary">{{ $post->category->name }} | {{ $post->user->name }}</h6>
                            </div>
                        </div>
                        <p class="card-text">{{ Str::limit($post->body, 120) }}</p>
                        <a href="/posts/{{ $post->id }}" class="btn btn-primary w-100">Read more</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sayfalama -->
    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endsection

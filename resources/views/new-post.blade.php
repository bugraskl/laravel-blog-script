@extends('layouts/main-layout')

@section('content')

    <div class="card post-card d-flex p-3 justify-content-center">
        <h1>Create a New Post</h1>

        <form class="w-100 px-3" action="/new-post" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Post Title</label>
                <input class="form-control mt-1" type="text" name="title" id="title" required>
            </div>
            <div class="mt-2">
                <label for="category">Post Category</label>
                <select name="category" class="form-select" id="category">
                    <option value="">Select a category</option>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label for="thumb">Post Thumbnail</label>
                <input type="file" name="thumb" id="thumb" class="form-control">
            </div>
            <div class="mt-2">
                <label for="post-detail">Post</label>
                <textarea class="form-control mt-1" name="post" id="post-detail" cols="30" rows="10" required></textarea>
            </div>
            <div>
                <button class="btn btn-primary w-100 mt-3 mb-3" type="submit">Save Post</button>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger py-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection


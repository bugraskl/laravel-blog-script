@extends('layouts/main-layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">

        @foreach (\App\Models\Category::orderBy('id', 'desc')->get() as $category)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <a href="/?category={{ $category->id }}"><h5 class="card-title text-primary">{{ $category->name }}</h5></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection


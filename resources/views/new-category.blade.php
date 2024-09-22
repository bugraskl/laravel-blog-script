@extends('layouts/main-layout')

@section('content')

    <div class="card login-card d-flex p-3 justify-content-center">
        <h2>Create a New Category</h2>

        <form class="w-100 px-3" action="/new-category" method="POST">
            @csrf
            <div>
                <label for="title">Category Title</label>
                <input class="form-control mt-1" type="text" name="title" id="title" required>
            </div>
            <div>
                <button class="btn btn-primary w-100 mt-3 mb-3" type="submit">Save Category</button>
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


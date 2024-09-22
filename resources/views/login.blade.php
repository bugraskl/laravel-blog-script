@extends('layouts/main-layout')

@section('content')

    <div class="card login-card d-flex p-3 justify-content-center">
        <h1>Login</h1>

        <form class="w-100 px-3" action="/login" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input class="form-control mt-1" type="email" name="email" id="email" required>
            </div>
            <div class="mt-2">
                <label for="password">Password</label>
                <input class="form-control mt-1" type="password" name="password" id="password" required>
            </div>
            <div>
                <button class="btn btn-primary w-100 mt-3 mb-3" type="submit">Login</button>
            </div>

            <a href="/register">If you don't have an account click here</a>
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


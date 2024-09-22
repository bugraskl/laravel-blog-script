@extends('layouts/main-layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">

        @foreach (\App\Models\User::all() as $writer)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <a href="/?writer={{ $writer->id }}"><h5 class="card-title text-primary">{{ $writer->name }}</h5></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection


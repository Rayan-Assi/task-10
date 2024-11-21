@extends('layouts.app')
@section('title', 'update post')

@section('content')

    <div class="card mb-3" >
        <div class="row g-0">
            <div class="col-md-4">
                <img src="/images/posts/{{ $posts->image }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $posts->title }}</h5>
                    <p class="card-text">{{ $posts->description }}</p>
                </div>
            </div>
        </div>
    </div>


@endsection

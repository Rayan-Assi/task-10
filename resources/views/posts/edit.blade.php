@extends('layouts.app')
@section('title', 'update post')

@section('content')

    <form action="{{ route('posts.update', $posts->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h1>Update Post </h1>
        <div class="mb-3">
            <label for="posttitle" class="form-label">Title</label>
            <input type="text" class="form-control" value="{{ $posts->title }}" name="title" id="posttitle"
                placeholder="title" required>
        </div>
        <div class="mb-3">
            <label for="postdescription" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="postdescription" placeholder="post description" rows="3">{{ old('description', $posts->description) }}</textarea>
        </div>
        <div class="mb-3">
            <div> <p>old image </p>
            <img src="/images/posts/{{ $posts->image }}" alt="last file " width="75px"></div>
            <label for="choosingfile" class="form-label">update image file</label>
            <input class="form-control" type="file" name="image" id="choosingfile" required>
        </div>
        <div class="d-grid gap-2">
            <input type="submit" value="Send" class="btn btn-primary" required>
        </div>
    </form>


@endsection

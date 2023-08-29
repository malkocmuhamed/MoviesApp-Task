@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Review</h1>
    <form method="post" action="{{ route('reviews.update', $review->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="content">Review Content</label>
            <textarea class="form-control" id="content" name="content" rows="3">{{ $review->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" value="{{ $review->rating }}" min="1" max="5">
        </div>
        <button type="submit" class="btn btn-primary">Update Review</button>
    </form>
</div>
@endsection

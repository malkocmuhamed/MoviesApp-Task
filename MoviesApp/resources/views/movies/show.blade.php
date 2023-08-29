
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $movie->title }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h4>Details:</h4>
                                <p><strong>Release Year:</strong> {{ $movie->release_year }}</p>
                                <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                                <p><strong>Director:</strong> {{ $movie->director }}</p>
                                <p><strong>Cast:</strong> {{ $movie->cast }}</p>
                                <p><strong>Description:</strong> {{ $movie->description }}</p>
                            </div>
                        </div>
                        <div class="mt-4" style="display:flex; justify-content:center">
                            <a href="{{ $movie->trailer_url }}" class="btn btn-primary" target="_blank">Watch Trailer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="movie-reviews">
        <h2>Reviews</h2>
        @if ($movie->reviews->isEmpty())
            <p>No reviews yet.</p>
        @else
            <ul class="review-list">
                @foreach ($movie->reviews as $review)
                    <li class="review">
                        <div class="review-header">
                            <p class="review-rating">Rating: {{ $review->rating }}/5</p>
                            <p class="review-user">By: {{ $review->user->name }}</p>
                        </div>
                        <p class="review-content">{{ $review->content }}</p>
                        @if ($review->user_id === Auth::id())
                        <div class="review-actions">
                            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="add-review">
    <h2>Add Review</h2>
    <form method="post" action="{{ route('reviews.store') }}">
    @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Leave a comment</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-select" id="rating" name="rating" required>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
        </div>
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
@endsection

@push('styles')
<style>
    /* Styles for movie reviews */
    .movie-reviews {
        margin-top: 30px;
        width:80%;
        margin:auto;
    }

    .movie-reviews h2 {
        margin-top: 40px;
    }

    .review-list {
        list-style: none;
        padding: 0;
    }

    .review {
        border: 1px solid #ccc;
        padding: 15px;
        margin: 10px 0;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-rating {
        font-weight: bold;
    }

    .review-user {
        color: #666;
    }

    .review-content {
        color: #333;
    }

    .add-review {
        margin-top: 30px;
        border-top: 1px solid #ccc;
        padding-top: 20px;
        width:60%;
        margin:auto;
    }

    .review-form {
        max-width: 50%;
        margin: auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endpush
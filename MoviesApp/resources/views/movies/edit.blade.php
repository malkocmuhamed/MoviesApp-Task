@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Movie</h1>
        <form method="post" action="{{ route('movies.update', $movie->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" 
                        value="{{ $movie->title }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="release_year" class="form-label">Release Year</label>
                        <input type="number" class="form-control" id="release_year" name="release_year" min="1900" max="{{ date('Y') }}" required
                        value="{{ $movie->release_year }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre</label>
                        <select class="form-control" id="genre" name="genre" required>
                            <option value="{{ $movie->genre}}" selected>{{ $movie->genre}}</option>
                            <option value="Action">Action</option>
                            <option value="Drama">Drama</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Mistery">Mistery</option>
                            <option value="Horror">Horror</option>
                            <option value="War">War</option>
                            <option value="Science Fiction">Science Fiction</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="director" class="form-label">Director</label>
                        <input type="text" class="form-control" id="director" name="director" required
                        value="{{ $movie->director }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cast" class="form-label">Cast</label>
                        <input type="text" class="form-control" id="cast" name="cast"
                        value="{{ $movie->cast }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                        value="{{ $movie->description }}">{{ $movie->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="poster_url" class="form-label">Poster URL</label>
                        <input type="url" class="form-control" id="poster_url" name="poster_url"
                        value="{{ $movie->poster_url }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="trailer_url" class="form-label">Trailer URL</label>
                        <input type="url" class="form-control" id="trailer_url" name="trailer_url"
                        value="{{ $movie->trailer_url }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Movie</button>
        </form>
    </div>
@endsection

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
@endsection

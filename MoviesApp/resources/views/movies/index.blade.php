@extends('layouts.app')

@can('view-movies')
@section('content')
    <div class="container">
        <div class="row">
                <form action="{{ route('movies.index') }}" method="GET"
                    style="width:300px;">
                    <div class="form-group">
                        <label for="genre">Filter by Genre</label>
                        <select name="genre" id="genre" class="form-control" style="margin:10px 0px 10px 0px">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre }}">{{ $genre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-bottom:10px">Filter</button>
                </form>
                <div class="row">
                    @foreach ($movies as $movie)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="card-img-top"
                                    style="height:330px">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $movie->title }}</h5>
                                    <p class="card-text">{{ $movie->genre }}</p>
                                    <a href="{{ route('movies.show', $movie->slug) }}" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        <div class="mt-2 mb-1" style="display:flex; justify-content:center;">
        {{ $movies->links() }}
        </div>
    </div>
@endsection
@endcan

@can('manage-movies')
@section('content')
    <div class="p-5">
    <a href="{{ route('users.index') }}" class="btn btn-primary" style="float:right; margin-right: 10px;">Manage Users</a>
        <h2>Manage Movies</h2>
        <a href="{{ route('movies.create') }}" class="btn btn-primary" style="float:right">Create Movie</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Release Year</th>
                    <th>Genre</th>
                    <th>Director</th>
                    <th>Cast</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->release_year }}</td>
                        <td>{{ $movie->genre}}</td>
                        <td>{{ $movie->director}}</td>
                        <td>{{ $movie->cast}}</td>
                        <td>
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2 mb-1" style="display:flex; justify-content:center;">
        {{ $movies->links() }}
        </div>
    </div>
    @if(session('success'))
    <div id="flash-message" class="alert alert-success" data-auto-dismiss="5000"
        style="width:50%; margin:auto">
        {{ session('success') }}
    </div>
    @endif
@endsection
@endcan


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flashMessage = document.getElementById('flash-message');

        if (flashMessage) {
            const autoDismissTime = flashMessage.getAttribute('data-auto-dismiss');
            setTimeout(function () {
                flashMessage.classList.add('hidden');
            }, autoDismissTime);
        }
    });
</script>

@section('content')
<style>
    .alert {
        transition: opacity 0.5s ease-out;
    }

    .alert.hidden {
        opacity: 0;
        display: none;
    }
</style>
@endsection
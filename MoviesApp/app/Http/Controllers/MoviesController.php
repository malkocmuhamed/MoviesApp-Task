<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json(['movies' => $movies], 200);
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return response()->json(['movie' => $movie], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'genre' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'cast' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
        ]);

        $movie = Movie::create($request->all());
        return response()->json(['message' => 'Movie created successfully.', 'movie' => $movie], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'genre' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'cast' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
        return response()->json(['message' => 'Movie updated successfully.', 'movie' => $movie], 200);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json(['message' => 'Movie deleted successfully.'], 204);
    }
}

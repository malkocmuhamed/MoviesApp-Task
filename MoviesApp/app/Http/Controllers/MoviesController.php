<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Require authentication for all methods
        $this->middleware('can:manage-movies')->only(['index', 'store', 'update', 'destroy']);
    } 

    public function create()
    {
        return view('movies.create'); // Create a 'create.blade.php' view file
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function indexUser(Request $request)
    {
        $genres = Movie::pluck('genre')->unique();

        $query = Movie::query();
    
        if ($request->has('genre')) {
            $genre = $request->input('genre');
            if ($genre !== '') {
                $query->where('genre', $genre);
            }
        }
    
        $movies = $query->paginate(12);
    
        return view('movies.index', compact('movies', 'genres'));
    }


    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
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
        $movieData = $request->except('_token'); // Exclude the CSRF token
        $movie = Movie::create($movieData);
        dd( $request->except('_token'));

        // $movie = Movie::create($request->all());
        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
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
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}

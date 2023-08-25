<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',            // Title of the movie
        'release_year',     // Release year of the movie
        'genre',            // Genre(s) of the movie
        'director',         // Director(s) of the movie
        'cast',             // List of cast members
        'description',      // Brief description of the movie
        'poster_url',       // URL to the movie's poster image
        'trailer_url',      // URL to the movie's trailer
    ];
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->rules = [
            'title' => 'required|max:255',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'genre' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'cast' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
        ];
    }
}

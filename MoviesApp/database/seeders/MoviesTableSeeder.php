<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        Movie::create([
            'title' => 'The Dark Knight',
            'release_year' => 2008,
            'genre' => 'Action',
            'director' => 'Christopher Nolan',
            'cast' => 'Christian Bale, Heath Ledger, Aaron Eckhart',
            'description' => 'Batman faces the Joker in a battle to save Gotham City.',
            'poster_url' => 'https://example.com/the_dark_knight_poster.jpg',
            'trailer_url' => 'https://example.com/the_dark_knight_trailer.mp4',
        ]);
    }
}


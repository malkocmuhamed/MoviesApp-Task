<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'release_year',
        'genre',
        'director',
        'cast',
        'description',
        'poster_url',
        'trailer_url',
        'slug', // Adding 'slug' to the fillable array
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movie) {
            $movie->slug = Str::slug($movie->title);
        });

        static::updating(function ($movie) {
            $movie->slug = Str::slug($movie->title);
        });
    }
}

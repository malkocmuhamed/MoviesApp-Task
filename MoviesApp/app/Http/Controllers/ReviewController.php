<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $review = Review::create([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'movie_id' => $request->input('movie_id'),
            'user_id' => auth()->user()->id, // Assuming you're using authentication
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function edit(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this review.');
        }

        return view('reviews.edit', compact('review'));
    }

public function update(Request $request, Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this review.');
        }
        $review->update([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('movies.show', $review->movie->slug)->with('success', 'Review updated successfully.');
    }
    
    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        return redirect()->route('movies.show', $review->movie->slug)->with('success', 'Review deleted successfully.');
    }
}


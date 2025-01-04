<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function allReviews()
    {
        $query = Review::with('user', 'place');
    
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('place', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
    
        $reviews = $query->paginate(15);
        return view('review.index', compact('reviews'));
    }
    

    public function showReview($id)
    {
        $review = Review::with('user', 'place')->find($id);
        if (!$review) {
            return abort(404, 'Review not found');
        }
        return view('review.show', compact('review'));
    }
    

    public function deleteReview($id)
    {
        $review = Review::find($id);
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Http\Requests\Review\Store;
use Illuminate\Http\Request;

class ReviewController extends Controller
{


    public function store(Store $request)
    {
        $validatedData = $request->validated();
        $review = Review::create($validatedData);
        return response()->json(['review' => $review]);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found']);
        }
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully']);
    }
}



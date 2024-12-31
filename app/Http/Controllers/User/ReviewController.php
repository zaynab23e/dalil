<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Http\Requests\Review\Store;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
//___________________________________________________________________________________________
public function index()
{
    $user=Auth::user();
    $userRating=User::with(['review']);
if(isset($userRating)){
return response()->json(['message' => 'you can not add rating']);
}
    $total = Review::sum('rating');
    //$Reviews = Review::count();
        $rating = $total/2;
        
    return response()->json(['message' => $rating]);
}
//_______________________________________________________________________________________________
    public function store(Store $request)
    {
        $validatedData = $request->validated();
        $review = Review::create($validatedData);
        return response()->json(['review' => $review],201);
    }
//__________________________________________________________________________________________________
    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'],404);
        }
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully']);
    }
//______________________________________________________________________________________________________
    
}



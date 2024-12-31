<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Http\Requests\Review\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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



    public function store(Store $request, $placeId)

    {
        $validatedData = $request->validated();
        $validatedData['place_id'] = $placeId;
        $validatedData['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('reviews'), $imageName);
            $validatedData['image'] = env('APP_URL') . '/public/reviews/' . $imageName;
        }
        $review = Review::create($validatedData);
        return response()->json('تم حفظ التقييم بنجاح', 201);
    }
//__________________________________________________________________________________________________
    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json('التقييم غير موجود', 404);
        }
        $review->delete();
        return response()->json('تم مسح التقييم بنجاح', 200);
    }

}



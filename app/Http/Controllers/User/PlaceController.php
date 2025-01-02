<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
   public function index()
{
    $places = Place::with('images')->withCount('reviews')->paginate(12);
    foreach ($places as $place) {
        $place->updateStatus();
    }

    return response()->json($places, 200);
}


    public function search(Request $request)
    {
        $places = Place::where('name', 'like', '%' . $request->name . '%')->with('images')->withCount('reviews')->paginate(12);
        foreach ($places as $place) {
            $place->updateStatus();
        }
        return response()->json($places, 200);
    }
    public function show($id)
    {
        $place = Place::with(['reviews.user', 'images', 'ratings'])->withCount('reviews')->findOrFail($id);
    
        $place->reviews->each(function ($review) use ($place) {
            $userRating = $place->ratings->firstWhere('user_id', $review->user_id);
            $review->user_rating = $userRating ? $userRating->rating : null;
        });
    
        $place->updateStatus();
    
        return response()->json($place, 200);
    }
    
    
    public function topRated(){
        $places = Place::orderBy('rating', 'desc')->take(5)->with('images')->withCount('reviews')->get();
        foreach ($places as $place) {
            $place->updateStatus();
        }
            return response()->json($places, 200);
    }

    public function newPlaces(){
        $places = Place::orderBy('created_at', 'desc')->take(5)->with('images')->withCount('reviews')->get();
        foreach ($places as $place) {
            $place->updateStatus();
        }
            return response()->json($places, 200);
    }

    public function getNearbyPlaces()
    {
        $user = auth()->user();
        $userLocation = $user->location()->first();
    
        if (!$userLocation) {
            return response()->json(['message' => 'يرجى تحديد موقعك أولاً.'], 400);
        }
    
        $latitude = $userLocation->latitude;
        $longitude = $userLocation->longitude;
    
        $radius = 0.1 * 1000;
    
        $places = Place::selectRaw(
            "*, ROUND(
                6371 * 1000 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )
            ) AS distance",
            [$latitude, $longitude, $latitude]
        )
        ->having('distance', '<=', $radius)
        ->orderBy('rating', 'desc')
        ->withCount('reviews')
        ->get()
        ->map(function ($place) {
            $speed = 1.4;
    
            $place->time_to_arrive = round($place->distance / $speed);
    
            return $place;
        });
    
        $this->updateStatus();
    
        return response()->json($places, 200);
    }
    
    protected function updateStatus()
    {
        $places = Place::all();
        foreach ($places as $place) {
            $place->updateStatus();
        }
    }
    


}

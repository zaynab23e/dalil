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
        $places = Place::where('name', 'like', '%' . $request->name . '%')->with('images')->paginate(12);
        foreach ($places as $place) {
            $place->updateStatus();
        }
        return response()->json($places, 200);
    }
    public function show($id)
    {
        $place = Place::with('reviews','images')->withCount('reviews')->findOrFail($id);
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

}

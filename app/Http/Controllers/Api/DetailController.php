<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Detail; 
use App\Models\User;
use JWTAuth;


class DetailController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'images_id' => 'required|integer',
            'ukuran' => 'required|string',
            'topping' => 'required|string',
            'request_text' => 'required|string',
            'request_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $gambarPath = $request->file('request_image')->store('public/detail');

    
        $cake = Detail::create([
            'images_id' => $validatedData['images_id'],
            'ukuran' => $validatedData['ukuran'],
            'topping' => $validatedData['topping'],
            'request_text' => $validatedData['request_text'],
            'request_image' => $gambarPath,
        ]);


        return response()->json(['Detail' => $cake], 201);
    }

    public function setLocation(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $validatedData = $request->validate([
            'longitude' => 'required|string',
            'latitude' => 'required|string',
        ]);
    
        $detail = User::where('id', $user->id)->first();
    
        if (!$detail) {
            return response()->json(['error' => 'No detail found for the authenticated user'], 404);
        }
    
        $detail->longitude = $validatedData['longitude'];
        $detail->latitude = $validatedData['latitude'];

        $detail->save();
    
        return response()->json(['message' => 'Location updated successfully', 'detail' => $detail], 200);
    }

    public function getLocation(Request $request) {

      
        $user = JWTAuth::parseToken()->authenticate();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $requestLatitude = -8.174396054996336;
        $requestLongitude = 113.65742176815715;

        $detail = User::select('longitude', 'latitude')->where('id', $user->id)->first();
        $distance = $this->haversineDistance($requestLatitude, $requestLongitude, $detail->longitude, $detail->latitude);

        return response()->json([
            'My longitude' => $detail->longitude,
            'My latitude' => $detail->latitude,
            'Distance to vios cake' => $distance . " Km",
        ], 200);
    }

private function haversineDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371) {
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    
    return $angle * $earthRadius; // Distance in km
}
    
}

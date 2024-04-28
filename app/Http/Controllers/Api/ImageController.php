<?php

namespace App\Http\Controllers\Api;
use App\Models\images; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'cake_id' => 'required|integer',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $gambarPath = $request->file('images')->store('public/detail');

    
        $cake = images::create([
            'cake_id' => $validatedData['cake_id'],
            'images' => $gambarPath,
        ]);

        return response()->json(['Image' => $cake], 201);
    }
}

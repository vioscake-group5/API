<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Order; 
use App\Http\Controllers\Controller as Controller;
use JWTAuth;

class OrderController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'id_detail' => 'required|integer', 
            'status_payment' => ['required', Rule::in(['pending', 'paid', 'failed'])],
            'status_order' => ['required', Rule::in(['pending', 'processing', 'completed', 'cancelled'])],
        ]);

        $user = JWTAuth::parseToken()->authenticate();

        $cake = Order::create([
            'id_user' => $user->id,
            'id_detail' => $validatedData['id_detail'],
            'status_payment' => $validatedData['status_payment'],
            'status_order' => $validatedData['status_order'],
        ]);

        return response()->json(['Order' => $cake], 201);
    }

    public function historyOrder(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();

        $query = Order::join('details', 'id_detail', '=', 'details.id')
        ->join('images', 'images_id', '=', 'images.id')
        ->join('cakes', 'cake_id', '=', 'cakes.id')
        ->where('id_user', '=', $user->id)
        ->get();

        return response()->json(['History order' => $query], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function getToken(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Flow:
        // 1. Flutter bakal hit ke API Detail Order
        // 2. Flutter bakal hit ke Endpoint Get Token Midtrans dengan data:
       //  "id_detail": 1
       //  "name": "testingAPIII",
       //  "email": "testing123458@gmail.com",
       // 3. Flutter bakal dapat token dari backend, pakai tokennya buat pembayaran.
       // 4. check pembayaran success atau ga?
       // 5. kalau success kirim ke endpoint /api/order, dengan data:
        // "id_detail": 1
        // "status_payment": "success"
        // "status_order": "success"
    //6 kalau gagal, kirim ke endpoint /api/order, dengan data:
         // "id_detail": 1
        // "status_payment": "failed"
        // "status_order": "failed"

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        $snapResponse = Snap::createTransaction($params);
        return response()->json([
            'token' => $snapResponse->token,
            'redirect_url' => $snapResponse->redirect_url
        ]);
    }
}
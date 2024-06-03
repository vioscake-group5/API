<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (!$request->hasHeader('User')) {
            return response()->json([
                'error' => 'User header not found',
                'information' => 'Gilang tolong kasih spesifikasi Header apkah ini user: Mobile / User: Website'
            ], 400);
        }

        $userHeader = $request->header('User');
        
        if (!in_array($userHeader, ['Mobile', 'Website'])) {
            return response()->json([
                'error' => 'Invalid User header',
                'information' => 'Valid values User: Mobile / User: Website'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 401);
        }

        $user = auth()->guard('api')->user();
        $additionalData = [];

        if ($userHeader === 'Mobile') {
            $additionalData = [
                'app_mobile' => 'Flutter',
                'mobile_specific_data' => 'Gilang Lead Mobile'
            ];
        } else if ($userHeader === 'Website') {
            $additionalData = [
                'app_website' => 'Laravel',
                'website_specific_data' => 'Shila Lead Development'
            ];
        }

        return response()->json(array_merge([
            'success' => true,
            'user'    => $user,
            'token'   => $token
        ], $additionalData), 200);
    }
}
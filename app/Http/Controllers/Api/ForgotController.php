<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ForgotController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found',
            ], 404);
        }

        $resetToken = Str::random(60);
        $user->reset_token = $resetToken;
        $user->save();

        $this->sendResetEmail($user->email, $resetToken);

        return response()->json([
            'success' => true,
            'message' => 'Password reset link sent to your email',
        ], 200);
    }

    private function sendResetEmail($email, $token)
    {
        $resetLink = url("/reset-password?token=$token");

        Mail::raw("Click the following link to reset your password: $resetLink", function ($message) use ($email) {
            $message->to($email)->subject('Reset Password');
        });
    }

    public function change(Request $request)
    {
        $token = $request->query('token');

        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('reset_token', $token)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => 'Password has been changed successfully']);
    }

    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }
}

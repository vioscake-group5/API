<?php

namespace App\Http\Controllers;

use App\Models\Akun;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AkunController extends Controller
{

    public function index() { }

    public function create() { }

    public function store(Request $request) { }

    public function show(Akun $akun) { }

    public function edit(Akun $akun) { }

    public function update(Request $request, Akun $akun) { }

    public function destroy(Akun $akun) { }

    public function loginweb(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('akun')
                    ->where('email', $email)
                    ->where('level_akun', 1)
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            // Pengguna berhasil login
            $remember_token = $this->generateRememberToken();

            // Simpan remember token ke database
            DB::table('akun')
                ->where('email', $email)
                ->update(['remember_token' => $remember_token]);

            $response = [
                'code' => 200,
                'status' => 'sukses',
                'data' => $user,
                'remember_token' => $remember_token
            ];
            return response()->json($response);
        } else {
            try {
                // Pengecualian akan terjadi jika user tidak ditemukan di database
                $user = DB::table('akun')->where('email', $email)->firstOrFail();
                
                // Pengecualian akan terjadi jika password tidak cocok
                if (!Hash::check($password, $user->password)) {
                    throw new \Exception("Password yang dimasukkan salah");
                }
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 401,
                    'status' => 'gagal',
                    'message' => $e->getMessage(),
                ], 401);
            }
        }
    }

    public function loginmobile(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('akun')
                    ->where('email', $email)
                    ->where('level_akun', 2)
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            // Pengguna berhasil login
            $remember_token = $this->generateRememberToken();

            // Simpan remember token ke database
            DB::table('akun')
                ->where('email', $email)
                ->update(['remember_token' => $remember_token]);

            $response = [
                'code' => 200,
                'status' => 'sukses',
                'data' => $user,
                'remember_token' => $remember_token
            ];
            return response()->json($response);
        } else {
            try {
                // Pengecualian akan terjadi jika user tidak ditemukan di database
                $user = DB::table('akun')->where('email', $email)->firstOrFail();
                
                // Pengecualian akan terjadi jika password tidak cocok
                if (!Hash::check($password, $user->password)) {
                    throw new \Exception("Password yang dimasukkan salah");
                }
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 401,
                    'status' => 'gagal',
                    'message' => $e->getMessage(),
                ], 401);
            }
        }
    }

    public function logout(Request $request)
    {
        // Auth::logout();
 
        // $request->session()->invalidate();
     
        // $request->session()->regenerateToken();
     
        // return redirect('/');

        $token = JWTAuth::getToken();
        if ($token) {
            $removeToken = JWTAuth::invalidate($token);
            if ($removeToken) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logout Berhasil',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal',
                ], 500);
            }
            return response()->json([
                'success' => false,
                'message' => 'Token tidak ditemukan',
            ]);
        }
    }

    // Fungsi untuk menghasilkan remember token acak
    private function generateRememberToken()
    {
        return bin2hex(random_bytes(10)); // Menghasilkan 20 karakter acak (dalam bentuk hex)
    }
}

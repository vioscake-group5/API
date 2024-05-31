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

            // Menggunakan Eloquent untuk mendapatkan user
            $user = Akun::where('email', $email)
                        ->where('level_akun', 1)
                        ->first();

            if ($user && Hash::check($password, $user->password)) {
                // Pengguna berhasil login
                $remember_token = $this->generateRememberToken();

                // Simpan remember token ke database menggunakan Eloquent
                $user->remember_token = $remember_token;
                $user->save();

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
                    $user = Akun::where('email', $email)->first();

                    // Pengecualian akan terjadi jika password tidak cocok
                    if (!$user || !Hash::check($password, $user->password)) {
                        throw new \Exception("Email atau password salah");
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

            // Menggunakan Eloquent untuk mendapatkan user
            $user = Akun::where('email', $email)
                        ->where('level_akun', 2)
                        ->first();

            if ($user && Hash::check($password, $user->password)) {
                // Pengguna berhasil login
                $remember_token = $this->generateRememberToken();

                // Simpan remember token ke database menggunakan Eloquent
                $user->remember_token = $remember_token;
                $user->save();

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
                    $user = Akun::where('email', $email)->first();

                    // Pengecualian akan terjadi jika password tidak cocok
                    if (!$user || !Hash::check($password, $user->password)) {
                        throw new \Exception("Email atau password salah");
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

    public function register(Request $request)
    {
        // Perbaikan salah ketik dan tambahkan aturan unik untuk email
        $request->validate([
            'email' => 'required|email|unique:akun,email', // pastikan email unik
            'password' => 'required|confirmed',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Membuat username otomatis dengan format accountXXX
        $latestUser = Akun::latest()->first();
        $latestUsername = $latestUser ? $latestUser->username : null;
        $username = 'account' . sprintf('%03d', intval(substr($latestUsername, 7)) + 1);

        // Membuat nama otomatis dengan format AccountXXX
        $name = 'Account' . substr($username, 7);

        $data = [
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'level_akun' => '2',
        ];

        $user = Akun::create($data);

        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    // Fungsi untuk menghasilkan remember token acak
    private function generateRememberToken()
    {
        return bin2hex(random_bytes(10)); // Menghasilkan 20 karakter acak (dalam bentuk hex)
    }
}

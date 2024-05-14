<?php

namespace App\Http\Controllers;

use App\Models\Akun;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Akun $akun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun)
    {
        //
    }

    public function login(Request $request)
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

    // Fungsi untuk menghasilkan remember token acak
    private function generateRememberToken()
    {
        return bin2hex(random_bytes(10)); // Menghasilkan 20 karakter acak (dalam bentuk hex)
    }
}

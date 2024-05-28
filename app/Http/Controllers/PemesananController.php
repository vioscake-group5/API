<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Base;
use App\Models\Desain;
use App\Models\Ukuran;

class PemesananController extends Controller
{
    public function index() {
        $data = DetailPesanan::all();
        return response()->json($data);
    }

    public function create(Request $request) {
        // validasi
        $request->validate([
            'id_akun' => 'required',
            'id_base' => 'required',
            'id_desain' => 'required',
            'id_ukuran' => 'required',
        ]);

        // ambil data akun
        // $akun = Akun::findOrFail($request->input('id_akun'));
        // $nama_pelanggan = $akun->nama;

        // buat pesanan
        $pesanan = Pesanan::create([
            // 'nama_pelanggan' => $nama_pelanggan,
            'status' => 'menunggu konfirmasi',
            'id_akun' => $request->input('id_akun'),
        ]);

        // buat detail
        $detailPesanan = DetailPesanan::create([
            'id_psn' => $pesanan->id_pesanan,
            'id_base' => $request->input('id_base'),
            'id_desain' => $request->input('id_desain'),
            'id_ukuran' => $request->input('id_ukuran'),
            'id_pesanan' => $pesanan->id_pesanan,
        ]);

        return response()->json(['message' => 'Pesanan berhasil dibuat'], 201);
    }
}

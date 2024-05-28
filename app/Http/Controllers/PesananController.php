<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    
    public function index(){
        // Mengambil semua data pesanan dengan relasi detail_pesanan
        $pesanan = Pesanan::with('detailPesanan')->get();

        return response()->json([
            'success' => true,
            'data' => $pesanan,
        ]);
    }

    public function show($id) {
        // Mengambil data pesanan berdasarkan ID dengan relasi detail_pesanan
        $pesanan = Pesanan::with('detailPesanan')->find($id);

        if (!$pesanan) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pesanan,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{

    public function index (Request $request) {
        $data = Ukuran::all();
        return response()->json($data);
    }
    
}
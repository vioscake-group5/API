<?php

namespace App\Http\Controllers;

use App\Models\Desain;
use Illuminate\Http\Request;

class DesainController extends Controller
{
    
    public function index (Request $request) {
        $data = Desain::all();
        return response()->json($data);
    }

}

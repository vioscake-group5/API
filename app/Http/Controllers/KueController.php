<?php

namespace App\Http\Controllers;

use App\Models\Kue;
use Illuminate\Http\Request;

class KueController extends Controller
{
    public function index() {
        $data = Kue::all();
        return response()->json($data);
    }

    public function hargakue() {
        
    }
}



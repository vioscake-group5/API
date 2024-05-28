<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function index (Request $request) {
        $data = Base::all();
        return response()->json($data);
    }
    
}
<?php

namespace App\Http\Controllers\Api;
use App\Models\Cake; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;
class CakeController extends Controller
{
    
    public function index()
    {
        $cakes = Cake::all();
        return response()->json(['cakes' => $cakes], 200);
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kue' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $gambarPath = $request->file('gambar')->store('public/cakes');

    
        $cake = Cake::create([
            'nama_kue' => $validatedData['nama_kue'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
            'gambar' => $gambarPath,
        ]);

        return response()->json(['cake' => $cake], 201);
    }
    
    public function show($id)
    {
        $cake = Cake::findOrFail($id);
        return response()->json(['cake' => $cake], 200);
    }
    
    public function edit(Request $request, $id)
    {
  
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kue' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $cake = Cake::findOrFail($id);
    
        if ($request->hasFile('gambar')) {
            Storage::delete($cake->gambar);
    
            $gambarPath = $request->file('gambar')->store('public/cakes');
            $validatedData['gambar'] = $gambarPath;
        }
    
        $cake->update($validatedData);
    
        return response()->json(['cake' => $cake], 200);
    }
    
    public function destroy($id)
    {
        $cake = Cake::findOrFail($id);
        Storage::delete($cake->gambar);
        $cake->delete();
    
        return response()->json(['message' => 'Cake deleted successfully'], 200);
    }
}

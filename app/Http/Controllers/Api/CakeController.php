<?php

namespace App\Http\Controllers\Api;
use App\Models\Cake; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;
class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cakes = Cake::all();
        return response()->json(['cakes' => $cakes], 200);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cake = Cake::findOrFail($id);
        return response()->json(['cake' => $cake], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cake = Cake::findOrFail($id);
        Storage::delete($cake->gambar);
        $cake->delete();
    
        return response()->json(['message' => 'Cake deleted successfully'], 200);
    }
}

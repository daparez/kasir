<?php

namespace App\Http\Controllers;


use App\Models\Produk;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
{
    $produks = Produk::with('kategori')->get(); 
    return view('pages.admin.stok.index', compact('produks'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
          $produks = Produk::with('suplier')->findOrFail($id);
    return view('pages.admin.stok.edit', compact('produks'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
       $request->validate([
            'stok_awal' => 'required|integer|min:0',
        ]);

        $produks = Produk::findOrFail($id);
        $produks->stok_awal = $request->stok_awal;
        $produks->save();
        

        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        $data = Kategori::all(); // Ambil semua kategori buku
        return view('pages.admin.kategori.index', compact('data'));
    } catch (\Throwable $th) {
        throw $th;
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('pages.admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'kategori' => 'required|string|max:60',
        ]);

        Kategori::create([
        'kategori' => $request->kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('pages.admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $request->validate([
        'kategori' => 'required|string|max:60'
    ]);

    $kategori = Kategori::findOrFail($id);
    $kategori->update([
        'kategori' => $request->kategori
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $kategori = Kategori::findOrFail($id);
    $kategori->delete();

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
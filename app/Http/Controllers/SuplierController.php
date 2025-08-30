<?php

namespace App\Http\Controllers;
use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Suplier = Suplier::all();
        return view('pages.admin.suplier.index', compact('Suplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.suplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required|string|max:100',
            'kontak' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:150',
        ]);

        Suplier::create($request->all());

        return redirect()->route('suplier.index')->with('success','Supplier berhasil ditambahkan.');
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
         $Suplier = Suplier::findOrFail($id);
        return view('pages.admin.suplier.edit', compact('Suplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suplier $Suplier)
    {
         $request->validate([
        'nama_supplier' => 'required|string|max:255',
        'kontak'        => 'nullable|string|max:100',
        'alamat'        => 'nullable|string',
    ]);

    $Suplier->update([
        'nama_supplier' => $request->nama_supplier,
        'kontak'        => $request->kontak,
        'alamat'        => $request->alamat,
    ]);

    return redirect()->route('suplier.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $Suplier->delete();
        return redirect()->route('suplier.index')->with('success','Supplier berhasil dihapus.');
    }
}

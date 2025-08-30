<?php

namespace App\Http\Controllers;
use App\Models\Suplier;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori','suplier')->latest()->paginate(10);
        return view('pages.admin.produk.index', compact('produks'));
    }


    public function create()
    {
        $suplier = Suplier::all();
        $kategori = Kategori::all();
        return view('pages.admin.produk.create', compact('kategori', 'suplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'suplier_id'  => 'required|exists:suplier,id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'satuan_unit' => 'required|string|max:50',
            'stok_awal' => 'required|integer',
            'stok_minimum' => 'required|integer',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        Produk::create($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        $suplier = Suplier::all();
        $kategori = Kategori::all();
        return view('pages.admin.produk.edit', compact('suplier', 'kategori'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'satuan_unit' => 'required|string|max:50',
            'stok_awal' => 'required|integer',
            'stok_minimum' => 'required|integer',
            'kategori_id' => 'required|exists:kategori,id',
            'suplier_id'  => 'required|exists:suplier,id',
        ]);

        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

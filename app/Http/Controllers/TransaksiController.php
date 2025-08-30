<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('produk.suplier')->latest()->get();
        $produks   = Produk::with('suplier')->get();
        $suplier  = Suplier::all();
        return view('pages.admin.transaksi.index', compact('transaksi', 'produks', 'suplier'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah'     => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $produk = Produk::findOrFail($request->produk_id);

    if ($produk->stok_awal < $request->jumlah) {
        return redirect()->back()
            ->withErrors(['jumlah' => '⚠️ Stok tidak mencukupi. Stok tersedia: ' . $produks->stok_awal])
            ->withInput();
    }


            $produk->decrement('stok_awal', $request->jumlah);

            Transaksi::create([
                'produk_id' => $produk->id,
                'jumlah'     => $request->jumlah,
                'total'      => $produk->harga_jual * $request->jumlah,
            ]);
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('pages.admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Kembalikan stok lama
        $transaksi->produks->increment('stok_awal', $transaksi->jumlah);

        // Update jumlah & total
        $transaksi->update([
            'jumlah' => $request->jumlah,
            'total'  => $transaksi->produks->harga_jual * $request->jumlah,
        ]);

        // Kurangi stok baru
        $transaksi->produks->decrement('stok_awal', $request->jumlah);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function invoice($id)
{
    $transaksi = Transaksi::with('produk')->findOrFail($id);
    return view('pages.admin.transaksi.invoice', compact('transaksi'));
}


     public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->produk->increment('stok_awal', $transaksi->jumlah);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}

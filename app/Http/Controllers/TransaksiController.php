<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('details.produk')->latest()->get();
        $produks = Produk::all();
        return view('pages.admin.transaksi.index', compact('transaksi','produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id.*' => 'required|exists:produk,id',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::transaction(function() use($request){
            $transaksi = Transaksi::create(['total_harga'=>0]);
            $totalBayar = 0;
            $totalItem = 0;

            foreach($request->produk_id as $i => $produk_id){
                $produk = Produk::findOrFail($produk_id);
                $jumlah = $request->jumlah[$i];

                if($produk->stok_awal < $jumlah){
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi");
                }

                $produk->decrement('stok_awal', $jumlah);

                $harga = $produk->harga_jual;
                $subtotal = $harga * $jumlah;

                $transaksi->details()->create([
                    'produk_id' => $produk->id,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);

                $totalBayar += $subtotal;
                $totalItem += $jumlah;
            }

            // Diskon otomatis
            $diskon = 0;
            if($totalItem > 5) $diskon += $totalBayar*0.2;
            if($totalBayar > 100000) $diskon += 20000;

            $transaksi->update(['total_harga'=>$totalBayar - $diskon]);
        });

        return redirect()->route('transaksi.index')->with('success','Transaksi berhasil disimpan');
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        return view('pages.admin.transaksi.invoice', compact('transaksi'));
    }
}

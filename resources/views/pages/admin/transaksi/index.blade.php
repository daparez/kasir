@extends('layouts.app')
@section('title', 'Transaksi Kasir')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(to right, #f9fafb, #eef2f7);
    }
    .container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px;
        padding: 20px;
    }
    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 20px;
        border: 1px solid #f0f0f0;
    }
    .card h2 {
        font-size: 1.3rem;
        font-weight: bold;
        color: #16a34a;
        margin-bottom: 16px;
    }
    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #333;
        font-size: 0.9rem;
    }
    select, input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        outline: none;
        transition: 0.2s;
    }
    select:focus, input:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 2px rgba(34,197,94,0.2);
    }
    .btn-submit {
        width: 100%;
        padding: 12px;
        background: #16a34a;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-submit:hover {
        background: #15803d;
    }
    .table-container {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #e5e7eb;
    }
    th {
        background: #f9fafb;
        font-weight: 600;
        color: #374151;
        text-align: left;
    }
    tr:hover {
        background: #f3f4f6;
    }
    .text-green {
        color: #16a34a;
        font-weight: bold;
    }
    .btn-edit, .btn-delete {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: white;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-edit {
        background: #facc15;
    }
    .btn-edit:hover {
        background: #eab308;
    }
    .btn-delete {
        background: #ef4444;
        border: none;
    }
    .btn-delete:hover {
        background: #dc2626;
    }
    .stok-warning {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 4px;
        display: none;
    }

    .btn-invoice {
    background: #3b82f6;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 0.8rem;
    color: white;
    text-decoration: none;
    margin-left: 5px;
    display: inline-block;
}
.btn-invoice:hover {
    background: #2563eb;
}


</style>

<div class="container">
    
    <!-- FORM -->
    <div class="card" data-aos="fade-right">
        <h2>➕ Tambah Transaksi</h2>

        <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label>Produk</label>
                <select name="produk_id" id="produk" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}" 
                                data-harga="{{ $produk->harga_jual }}" 
                                data-stok="{{ $produk->stok_awal }}">
                            {{ $produk->nama_produk }}
                        </option>
                    @endforeach
                </select>
                <p id="stok-warning" class="stok-warning">⚠️ Stok tidak mencukupi!</p>
            </div>

            <div>
                <label>Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" value="1" min="1">
            </div>

            <div>
                <label>Harga</label>
                <input type="text" id="harga_display" readonly style="background:#f9fafb;">
                <input type="hidden" id="harga" name="harga_jual">
            </div>

            <div>
                <label>Total</label>
                <input type="text" id="total_display" readonly style="background:#f9fafb; font-weight:bold; color:#16a34a;">
                <input type="hidden" id="total" name="total">
            </div>

            <button type="submit" class="btn-submit">💾 Simpan Transaksi</button>
        </form>
    </div>

    <!-- TABLE -->
    <div class="card" data-aos="fade-left">
        <h2>📋 Daftar Transaksi</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Supplier</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $note)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $note->produk->nama_produk ?? '-' }}</td>
                            <td>{{ $note->produk->suplier->nama_suplier ?? '-' }}</td>
                            <td class="text-center">{{ $note->jumlah }}</td>
                            <td class="text-right text-green">Rp {{ number_format($note->total,0,',','.') }}</td>
                            <td class="text-center">{{ $note->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('transaksi.edit', $note->id) }}" class="btn-edit">✏️</a>
                                <form action="{{ route('transaksi.destroy', $note->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑️</button>
                                    <a href="{{ route('transaksi.invoice', $note->id) }}" target="_blank" class="btn-invoice">🧾 Cetak</a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:#9ca3af;">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ duration: 800, once: true });

document.addEventListener("DOMContentLoaded", function () {
    const selectProduk   = document.querySelector("select[name='produk_id']");
    const inputJumlah    = document.getElementById("jumlah");
    const inputHarga     = document.getElementById("harga");
    const hargaDisplay   = document.getElementById("harga_display");
    const inputTotal     = document.getElementById("total");
    const totalDisplay   = document.getElementById("total_display");
    const stokWarning    = document.getElementById("stok-warning");

    function hitungTotal() {
        let option   = selectProduk.options[selectProduk.selectedIndex];
        if (!option) return;

        let harga    = option.getAttribute("data-harga") || 0;
        let stok     = option.getAttribute("data-stok") || 0;
        let jumlah   = parseInt(inputJumlah.value) || 0;

        stokWarning.style.display = (jumlah > stok) ? "block" : "none";

        hargaDisplay.value = "Rp " + parseInt(harga).toLocaleString("id-ID");
        inputHarga.value   = harga;

        let total = harga * jumlah;
        totalDisplay.value = "Rp " + parseInt(total).toLocaleString("id-ID");
        inputTotal.value   = total;
    }

    selectProduk.addEventListener("change", hitungTotal);
    inputJumlah.addEventListener("input", hitungTotal);
});
</script>
@endsection

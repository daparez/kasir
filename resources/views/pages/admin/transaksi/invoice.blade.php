@extends('layouts.app')
@section('title','Invoice Transaksi')

@section('content')
<style>
body {
    font-family: 'Courier New', monospace;
    background:#f3f4f6;
    padding:20px;
}
.invoice-card {
    max-width:400px;
    margin:auto;
    background:#fff;
    padding:20px;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
}
.invoice-card h2 {
    color:#16a34a;
    font-size:1.2rem;
    text-align:center;
    margin-bottom:10px;
}
.invoice-card p {
    font-size:0.85rem;
    margin:2px 0;
}
.invoice-items {
    margin-top:10px;
    border-top:1px dashed #ccc;
    border-bottom:1px dashed #ccc;
    padding:5px 0;
}
.item-row {
    display:flex;
    justify-content:space-between;
    margin-bottom:2px;
}
.item-row span {
    font-size:0.85rem;
}
.total-row {
    display:flex;
    justify-content:space-between;
    font-weight:bold;
    margin-top:5px;
}
.note {
    font-size:0.75rem;
    text-align:center;
    margin-top:10px;
    color:#555;
}
.btn-print {
    background:#3b82f6;
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:8px;
    cursor:pointer;
    width:100%;
    margin-top:10px;
}
.btn-print:hover { background:#2563eb; }
@media print { .btn-print { display:none; } }
</style>

<div class="invoice-card">
    <h2>🧾 STRUK PEMBELIAN</h2>
    <p>Tanggal: {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
    <p>ID Transaksi: {{ $transaksi->id }}</p>
    <div class="invoice-items">
        @foreach($transaksi->details as $d)
        <div class="item-row">
            <span>{{ $d->produk->nama_produk ?? '-' }} x{{ $d->jumlah }}</span>
            <span>Rp {{ number_format($d->subtotal,0,',','.') }}</span>
        </div>
        @endforeach
    </div>

    @php
        $subtotal = $transaksi->details->sum(fn($d)=>$d->subtotal);
        $diskon = $subtotal - $transaksi->total_harga;
    @endphp

    <div class="total-row">
        <span>Subtotal</span>
        <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
    </div>
    <div class="total-row">
        <span>Diskon</span>
        <span>Rp {{ number_format($diskon,0,',','.') }}</span>
    </div>
    <div class="total-row">
        <span>Total Bayar</span>
        <span>Rp {{ number_format($transaksi->total_harga,0,',','.') }}</span>
    </div>

    <div class="note">
        Terima kasih atas kunjungan Anda!<br>
        Barang yang sudah dibeli tidak dapat dikembalikan.
    </div>

    <button class="btn-print" onclick="window.print()">🖨️ Print Struk</button>
</div>
@endsection

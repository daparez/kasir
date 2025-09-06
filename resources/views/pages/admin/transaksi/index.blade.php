@extends('layouts.app')
@section('title','Transaksi Kasir')

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
.btn-hapus {
    background:#ef4444;
    color:#fff;
    border:none;
    border-radius:8px;
    padding:4px 8px;
    margin-top:5px;
    cursor:pointer;
}
.btn-hapus:hover { background:#dc2626; }
.table-container { overflow-x:auto; }
table {
    width:100%;
    border-collapse:collapse;
    font-size:0.9rem;
}
th, td {
    padding:12px 15px;
    border-bottom:1px solid #e5e7eb;
}
th {
    background:#f9fafb;
    font-weight:600;
    color:#374151;
    text-align:left;
}
tr:hover { background:#f3f4f6; }
.text-green { color:#16a34a; font-weight:bold; }
.btn-invoice {
    background:#3b82f6;
    padding:6px 10px;
    border-radius:8px;
    font-size:0.8rem;
    color:white;
    text-decoration:none;
    margin-left:5px;
    display:inline-block;
}
.btn-invoice:hover { background:#2563eb; }
</style>

<div class="container">

<!-- FORM TRANSAKSI -->
<div class="card" data-aos="fade-right">
    <h2>➕ Tambah Transaksi</h2>
    <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
        @csrf
        <div id="produk-wrapper">
            <div class="produk-item mb-2">
                <label>Produk</label>
                <select name="produk_id[]" class="produk-select" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}" data-harga="{{ $produk->harga_jual }}">{{ $produk->nama_produk }}</option>
                    @endforeach
                </select>
                <label>Jumlah</label>
                <input type="number" name="jumlah[]" class="jumlah-input" value="1" min="1">
                <button type="button" class="btn-hapus">❌ Hapus</button>
            </div>
        </div>
        <button type="button" id="tambahProduk" class="btn-submit mb-2" style="background:#facc15;color:#000;">➕ Tambah Produk</button>

        <hr>
        <div>
            <p>Subtotal: Rp <span id="subtotalDisplay">0</span></p>
            <p>Diskon: Rp <span id="diskonDisplay">0</span></p>
            <p><strong>Total Bayar: Rp <span id="totalDisplay">0</span></strong></p>
        </div>

        <button type="submit" class="btn-submit">💾 Simpan Transaksi</button>
    </form>
</div>

<!-- TABEL TRANSAKSI -->
<div class="card" data-aos="fade-left">
    <h2>📋 Daftar Transaksi</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Total Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @foreach($t->details as $d)
                            {{ $d->produk->nama_produk ?? '-' }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($t->details as $d)
                            {{ $d->jumlah }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($t->details as $d)
                            Rp {{ number_format($d->subtotal,0,',','.') }} <br>
                        @endforeach
                    </td>
                    <td>Rp {{ number_format($t->total_harga,0,',','.') }}</td>
                    <td><a href="{{ route('transaksi.invoice',$t->id) }}" target="_blank" class="btn-invoice">🧾 Invoice</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({duration:800,once:true});

// Fungsi hitung total + diskon
function hitungTotal(){
    let subtotal=0,totalItem=0;
    document.querySelectorAll('.produk-item').forEach(item=>{
        const select=item.querySelector('.produk-select');
        const jumlah=parseInt(item.querySelector('.jumlah-input').value)||0;
        const harga=parseFloat(select.selectedOptions[0]?.dataset.harga||0);
        subtotal+=harga*jumlah;
        totalItem+=jumlah;
    });
    let diskon=0;
    if(totalItem>5) diskon+=subtotal*0.2;
    if(subtotal>100000) diskon+=20000;
    document.getElementById('subtotalDisplay').innerText=subtotal.toLocaleString('id-ID');
    document.getElementById('diskonDisplay').innerText=diskon.toLocaleString('id-ID');
    document.getElementById('totalDisplay').innerText=(subtotal-diskon).toLocaleString('id-ID');
}

// Tambah produk baru
const produkWrapper=document.getElementById('produk-wrapper');
document.getElementById('tambahProduk').addEventListener('click',function(){
    const clone=produkWrapper.querySelector('.produk-item').cloneNode(true);
    clone.querySelector('select').value='';
    clone.querySelector('input').value=1;
    produkWrapper.appendChild(clone);

    clone.querySelector('.produk-select').addEventListener('change',hitungTotal);
    clone.querySelector('.jumlah-input').addEventListener('input',hitungTotal);
    clone.querySelector('.btn-hapus').addEventListener('click',function(){ clone.remove(); hitungTotal(); });
    hitungTotal();
});

// Pasang listener hapus & perubahan awal
document.querySelectorAll('.btn-hapus').forEach(btn=>{
    btn.addEventListener('click',function(e){
        e.target.closest('.produk-item').remove();
        hitungTotal();
    });
});
document.querySelectorAll('.produk-select, .jumlah-input').forEach(el=>{
    el.addEventListener('change',hitungTotal);
    el.addEventListener('input',hitungTotal);
});
hitungTotal();
</script>

@endsection

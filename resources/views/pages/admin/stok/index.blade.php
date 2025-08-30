@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="page-title">📦 Data Stok Produk</h2>


    <div class="card">
        <div class="card-body">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>suplier</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok Saat Ini</th>
                        <th>Stok Minimum</th>
                        <th>Status</th>
                        <th>Terakhir Diperbarui</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
           @foreach($produks as $s)
        <tr>
            <td>{{ $s->nama_produk ?? '-' }}</td>
            <td>{{ $s->suplier->nama_suplier ?? '-' }}</td>
            <td>{{ $s->kategori->kategori ?? '-' }}</td>
            <td>Rp {{ number_format($s->harga_jual, 0, ',', '.') }}</td>
            <td>{{ $s->stok_awal }}</td>
            <td>{{ $s->stok_minimum }}</td>
            <td>
                @if($s->stok_awal >= $s->stok_minimum)
                    <span class="badge bg-success">Aman</span>
                @else
                    <span class="badge bg-danger">Tidak Aman</span>
                @endif
            </td>
            <td>{{ $s->updated_at->format('d-m-Y H:i') }}</td>
            <td>
                <a href="{{ route('stok.edit', $s->id) }}" class="btn-warning">✏️ tambah stok</a>
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>
    </div>
</div>

{{-- Inline Style --}}
<style>
    .page-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .btn-custom {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .btn-warning{
    padding: 6px 14px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: all 0.2s;
}
    .btn-primary {
        background: #3498db;
        color: white;
        border: none;
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background: #2980b9;
    }

    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        padding: 15px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom th, .table-custom td {
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
        text-align: center;
    }

    .table-custom th {
        background: #f8f9fa;
        font-weight: 600;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        color: white;
    }

    .bg-success {
        background: #27ae60;
    }

    .bg-danger {
        background: #e74c3c;
    }
</style>
@endsection

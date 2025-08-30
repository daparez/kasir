@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📦 Daftar Suplier</h2>

    <!-- Tombol tambah -->
    <div class="mb-3">
        <a href="{{ route('suplier.create') }}" class="btn-add">➕ Tambah Suplier</a>
    </div>

    <!-- Tabel Suplier -->
    <div class="table-card">
        <table class="table-supplier">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Suplier</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Suplier as $supliers)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supliers->nama_suplier }}</td>
                    <td>{{ $supliers->kontak }}</td>
                    <td>{{ $supliers->alamat }}</td>
                    <td class="actions">
                        <a href="{{ route('suplier.edit', $supliers->id) }}" class="btn-edit">✏️ Edit</a>
                        <form action="{{ route('suplier.destroy', $supliers->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin mau hapus?')">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data suplier</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- CSS --}}
<style>
    .table-card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    .table-supplier {
        width: 100%;
        border-collapse: collapse;
    }

    .table-supplier th, .table-supplier td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .table-supplier th {
        background: #4a90e2;
        color: white;
        font-weight: bold;
    }

    .table-supplier tr:nth-child(even) {
        background: #f9f9f9;
    }

    .btn-add {
        background: #28a745;
        color: #fff;
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }
    .btn-add:hover {
        background: #218838;
    }

    .btn-edit {
        background: #ffc107;
        color: #fff;
        padding: 6px 14px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        margin-right: 6px;
    }
    .btn-edit:hover {
        background: #e0a800;
    }

    .btn-delete {
        background: #dc3545;
        color: #fff;
        padding: 6px 14px;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
    }
    .btn-delete:hover {
        background: #c82333;
    }

    .text-center {
        text-align: center;
        color: #777;
        font-style: italic;
    }
</style>

{{-- JS --}}
<script>
    // Highlight baris saat dihover
    document.querySelectorAll(".table-supplier tbody tr").forEach(row => {
        row.addEventListener("mouseenter", () => {
            row.style.backgroundColor = "#eef6ff";
        });
        row.addEventListener("mouseleave", () => {
            row.style.backgroundColor = "";
        });
    });
</script>
@endsection

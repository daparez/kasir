@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="kategori-page">
    <div class="card">
        <div class="card-header">
            <h2>📚 Daftar Kategori</h2>
            <a href="{{ route('kategori.create') }}" class="btn-add">
                + Tambah Kategori
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Nama Kategori</th>
                            <th style="width: 200px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->kategori }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-warning">✏ Edit</a>
                                    <button type="button" 
                                            data-href="{{ route('kategori.destroy', $kategori->id) }}" 
                                            class="btn-danger btn-hapus">
                                        🗑 Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Form Delete --}}
            <form action="" method="POST" id="formDelete" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<style>
    .kategori-page {
        margin-top: 30px;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h2 {
        margin: 0;
        font-size: 20px;
    }

    .btn-add {
        background: #fff;
        color: #3498db;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-add:hover {
        background: #ecf0f1;
    }

    .card-body {
        padding: 20px;
    }

    .alert {
        background: #2ecc71;
        color: white;
        padding: 10px 15px;
        border-radius: 12px;
        margin-bottom: 15px;
    }

    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    thead {
        background: #2c3e50;
        color: white;
    }

    thead th {
        padding: 12px;
        font-weight: bold;
        text-align: center;
    }

    tbody td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ecf0f1;
    }

    tbody tr:hover {
        background: #f9f9f9;
    }

    /* Tombol */
    .btn-warning,
    .btn-danger {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: all 0.2s;
    }

    .btn-warning {
        background: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background: #e67e22;
    }

    .btn-danger {
        background: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background: #c0392b;
    }

    .hidden {
        display: none;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-hapus").forEach(btn => {
            btn.addEventListener("click", function () {
                if (confirm("Apakah yakin akan dihapus?")) {
                    let url = this.getAttribute("data-href");
                    let form = document.getElementById("formDelete");
                    form.setAttribute("action", url);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection

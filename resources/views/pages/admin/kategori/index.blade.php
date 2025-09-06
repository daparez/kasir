@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="kategori-page">
    <div class="card" data-aos="fade-up">
        <div class="card-header">
            <h2>📚 Daftar Kategori</h2>
            <button type="button" id="btnTambah" class="btn-add">
                + Tambah Kategori
            </button>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert" data-aos="fade-down">
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

{{-- STYLE --}}
<style>
    body {
        background: #f6f9fc;
        font-family: 'Segoe UI', sans-serif;
    }

    .kategori-page {
        margin-top: 30px;
    }

    .card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-3px);
    }

    .card-header {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        padding: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
    }

    .btn-add {
        background: white;
        color: #2575fc;
        padding: 8px 18px;
        border-radius: 25px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        cursor: pointer;
        border: none;
    }

    .btn-add:hover {
        background: #f0f4ff;
        transform: scale(1.05);
    }

    .card-body {
        padding: 20px;
    }

    .alert {
        background: linear-gradient(135deg, #00b09b, #96c93d);
        color: white;
        padding: 12px 18px;
        border-radius: 12px;
        margin-bottom: 15px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        border-radius: 12px;
        overflow: hidden;
    }

    thead {
        background: #2c3e50;
        color: white;
    }

    thead th {
        padding: 14px;
        font-weight: 600;
        text-align: center;
    }

    tbody td {
        padding: 14px;
        text-align: center;
        border-bottom: 1px solid #ecf0f1;
        color: #333;
        font-size: 15px;
    }

    tbody tr:hover {
        background: #f8faff;
    }

    /* Tombol */
    .btn-warning,
    .btn-danger {
        padding: 7px 16px;
        border-radius: 22px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: all 0.25s ease;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .btn-warning {
        background: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background: #e67e22;
        transform: translateY(-2px);
    }

    .btn-danger {
        background: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background: #c0392b;
        transform: translateY(-2px);
    }

    .hidden {
        display: none;
    }
</style>

{{-- SCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // tombol hapus
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

        // tombol tambah kategori tanpa reload server
        document.getElementById("btnTambah").addEventListener("click", function () {
            window.location = "{{ route('kategori.create') }}";
        });
    });
</script>

{{-- Tambah animasi AOS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"/>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 600,
        once: true
    });
</script>
@endsection

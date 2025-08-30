@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            background: #f4f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 1rem !important;
        }
        .table th {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table td {
            font-size: 15px;
        }
        .btn {
            font-weight: 500;
        }
    </style>

    @stack('styles')
</head>
<div class="container mt-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
            <h4 class="mb-0">📦 Daftar Produk</h4>
            <a href="{{ route('produk.create') }}" class="btn btn-light text-primary fw-bold shadow-sm">
                + Tambah Produk
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok Awal</th>
                            <th>Stok Minimum</th>
                            <th>Status Stok</th>
                            <th>Kategori</th>
                            <th>suplier</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $produk->nama_produk }}</td>
                                <td>Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                                <td>{{ $produk->stok_awal }}</td>
                                <td>{{ $produk->stok_minimum }}</td>
                                <td>
                                    @if ($produk->stok_awal <= $produk->stok_minimum)
                                        <span class="badge bg-danger">⚠ Tidak Aman</span>
                                    @else
                                        <span class="badge bg-success">✅ Aman</span>
                                    @endif
                                </td>
                                <td>{{ $produk->kategori->kategori ?? '-' }}</td>
                                 <td>{{ $produk->suplier->nama_suplier ?? '-' }}</td>
                                <td>
                                    <button type="button"
                                            data-href="{{ route('produk.destroy', $produk->id) }}"
                                            class="btn btn-danger btn-sm rounded-pill px-3 btn-hapus">
                                        🗑 Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Form Delete --}}
            <form action="" method="POST" id="formDelete" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-hapus').click(function() {
            const conf = confirm('Apakah yakin akan dihapus?');
            if (conf) {
                const url = $(this).data('href');
                $('#formDelete').attr('action', url).submit();
            }
        })
    });
</script>
@endsection

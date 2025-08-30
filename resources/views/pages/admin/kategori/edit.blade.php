@extends('layouts.app')

@section('title', 'Ubah Kategori Buku')

@section('content')
<div class="kategori-edit">
    <!-- Header -->
    <div class="page-header">
        <h2>✏️ Ubah Kategori Buku</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a> / 
            <span>Ubah Kategori Buku</span>
        </nav>
    </div>

    <!-- Card -->
    <div class="card">
        <div class="card-header">
            <h4>Edit Data</h4>
            <a href="{{ route('kategori.index') }}" class="btn-danger">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label>Nama Kategori </label>
                    <input type="text" 
                           name="kategori" 
                           value="{{ old('kategori', $kategori->kategori) }}" 
                           class="@error('kategori') is-invalid @enderror">
                    @error('kategori_buku')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<style>
    .kategori-edit {
        margin-top: 30px;
    }

    .page-header {
        margin-bottom: 20px;
    }

    .page-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: bold;
    }

    .page-header nav {
        margin-top: 6px;
        color: #7f8c8d;
        font-size: 14px;
    }

    .page-header nav a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h4 {
        margin: 0;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 16px;
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-group input {
        border: 1px solid #ccc;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 15px;
        transition: 0.2s;
    }

    .form-group input:focus {
        border-color: #2ecc71;
        outline: none;
        box-shadow: 0 0 6px rgba(46,204,113,0.3);
    }

    .error {
        color: #e74c3c;
        margin-top: 5px;
        font-size: 14px;
    }

    .btn-primary,
    .btn-danger {
        border: none;
        padding: 10px 18px;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
        font-size: 14px;
    }

    .btn-primary {
        background: #2ecc71;
        color: white;
    }

    .btn-primary:hover {
        background: #27ae60;
    }

    .btn-danger {
        background: #e74c3c;
        color: white;
        text-decoration: none;
    }

    .btn-danger:hover {
        background: #c0392b;
    }
</style>
@endsection

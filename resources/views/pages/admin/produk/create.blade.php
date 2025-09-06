@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="produk-create">
    <!-- Header -->
    <div class="page-header">
        <h2>📦 Tambah Produk</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a> / 
            <a href="{{ route('produk.index') }}">Produk</a> / 
            <span>Tambah Produk</span>
        </nav>
    </div>

    <!-- Card -->
    <div class="card">
        <div class="card-header">
            <h4>Form Produk</h4>
            <a href="{{ route('produk.index') }}" class="btn-danger">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <!-- Nama Produk -->
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required
                               class="@error('nama_produk') is-invalid @enderror">
                        @error('nama_produk') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <!-- Supplier -->
                    <div class="form-group">
                        <label>Suplier</label>
                        <select name="suplier_id" required class="@error('suplier_id') is-invalid @enderror">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suplier as $sup)
                                <option value="{{ $sup->id }}" {{ old('suplier_id') == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->nama_suplier }}
                                </option>
                            @endforeach
                        </select>
                        @error('suplier_id') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <!-- Harga Beli -->
                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" required
                               class="@error('harga_beli') is-invalid @enderror">
                        @error('harga_beli') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <!-- Harga Jual -->
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" value="{{ old('harga_jual') }}" required
                               class="@error('harga_jual') is-invalid @enderror">
                        @error('harga_jual') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <!-- Satuan Unit -->
                    <div class="form-group">
                        <label>Satuan Unit</label>
                        <input type="text" name="satuan_unit" value="{{ old('satuan_unit') }}" required
                               placeholder="contoh: pcs, box, liter"
                               class="@error('satuan_unit') is-invalid @enderror">
                        @error('satuan_unit') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <!-- Stok Awal -->
                    <div class="form-group">
                        <label>Stok Awal</label>
                        <input type="number" name="stok_awal" value="{{ old('stok_awal') }}" required
                               class="@error('stok_awal') is-invalid @enderror">
                        @error('stok_awal') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <!-- Stok Minimum -->
                    <div class="form-group">
                        <label>Stok Minimum</label>
                        <input type="number" name="stok_minimum" value="{{ old('stok_minimum') }}" required
                               class="@error('stok_minimum') is-invalid @enderror">
                        @error('stok_minimum') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" required class="@error('kategori_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn-primary">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .page-header { margin-bottom: 20px; }
    .page-header h2 { font-size: 1.6rem; font-weight: bold; }
    .page-header nav { font-size: 0.9rem; color: #777; }
    .page-header nav a { color: #007bff; text-decoration: none; }
    .page-header nav a:hover { text-decoration: underline; }

    .card { background: #fff; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 20px; }
    .card-header { display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px solid #eee; }
    .card-header h4 { margin: 0; font-size: 1.2rem; }
    .card-body { padding: 20px; }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

    .form-group { display: flex; flex-direction: column; }
    .form-group label { font-weight: 600; margin-bottom: 6px; }
    .form-group input, .form-group select, .form-group textarea {
        width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;
        transition: all 0.2s ease;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.4);
    }
    .error { color: red; font-size: 0.85rem; }

    .btn-primary, .btn-danger {
        display: inline-block; padding: 8px 20px; border-radius: 30px; font-weight: bold;
        text-decoration: none; transition: 0.2s;
    }
    .btn-primary { background: #007bff; color: #fff; border: none; }
    .btn-primary:hover { background: #0056b3; }
    .btn-danger { background: #dc3545; color: #fff; }
    .btn-danger:hover { background: #b52a37; }
</style>
@endsection

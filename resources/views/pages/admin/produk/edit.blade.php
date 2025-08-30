@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')



<div class="produk-edit">
    <div class="page-header">
        <h2>✏️ Edit Produk</h2>
        <a href="{{ route('produk.index') }}" class="btn-danger">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Produk -->
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                </div>

                <!-- Harga Beli -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="number" name="harga_beli" value="{{ old('harga_beli', $produk->harga_beli) }}" required>
                </div>

                <!-- Harga Jual -->
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}" required>
                </div>

                <!-- Satuan -->
                <div class="form-group">
                    <label>Satuan Unit</label>
                    <input type="text" name="satuan_unit" value="{{ old('satuan_unit', $produk->satuan_unit) }}" required>
                </div>

                <!-- Stok Awal -->
                <div class="form-group">
                    <label>Stok Awal</label>
                    <input type="number" name="stok_awal" value="{{ old('stok_awal', $produk->stok_awal) }}" required>
                </div>

                <!-- Stok Minimum -->
                <div class="form-group">
                    <label>Stok Minimum</label>
                    <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $produk->stok_minimum) }}" required>
                </div>

                <!-- Kategori -->
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" required>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                                {{ $k->kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-primary">💾 Update</button>
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

    .form-group { margin-bottom: 15px; }
    .form-group label { font-weight: 600; display: block; margin-bottom: 6px; }
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

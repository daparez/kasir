@extends('layouts.app')

@section('title', 'Edit suplier')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">✏️ Edit Suplier</h2>

    <form action="{{ route('suplier.update', $suplier->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <!-- Nama Suplier -->
        <div class="form-group">
            <label for="nama_suplier" class="form-label">Nama Suplier</label>
            <input type="text" name="nama_suplier" id="nama_suplier" class="form-input"
                   value="{{ old('nama_suolier', $suplier->nama_suplier) }}" required>
        </div>

        <!-- Kontak -->
        <div class="form-group">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-input"
                   value="{{ old('kontak', $suplier->kontak) }}" required>
        </div>

        <!-- Alamat -->
        <div class="form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-input" rows="3" required>{{ old('alamat', $suplier->alamat) }}</textarea>
        </div>

        <!-- Tombol Aksi -->
        <div class="form-actions">
            <button type="submit" class="btn-save">💾 Update</button>
            <a href="{{ route('suplier.index') }}" class="btn-cancel">Kembali</a>
        </div>
    </form>
</div>

{{-- CSS --}}
<style>
    .form-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: auto;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #333;
    }

    .form-input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.2s ease;
        resize: none;
    }

    .form-input:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 6px rgba(74,144,226,0.3);
        outline: none;
    }

    .form-actions {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }

    .btn-save {
        background: #007bff;
        color: #fff;
        padding: 10px 24px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-save:hover {
        background: #0069d9;
    }

    .btn-cancel {
        background: #6c757d;
        color: #fff;
        padding: 10px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        transition: 0.2s;
    }
    .btn-cancel:hover {
        background: #5a6268;
    }
</style>

{{-- JS --}}
<script>
    // Efek border biru saat input berubah
    document.querySelectorAll(".form-input").forEach(el => {
        el.addEventListener("change", () => {
            el.style.borderColor = "#007bff";
            setTimeout(() => {
                el.style.borderColor = "#ccc";
            }, 1000);
        });
    });
</script>
@endsection

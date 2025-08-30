@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">✏️ Edit Stok Produk</h2>

    <form action="{{ route('stok.update', $produks->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div class="form-group">
            <label class="form-label">Nama Produk</label>
            <input type="hidden" >
            <input type="text" class="form-input" value="{{ $produks->nama_produk ?? '-' }}" readonly>
        </div>

        

        

        <div class="mb-3">
                        <label for="stok_awal" class="form-label">Penyesuaian Stok</label>
                        <input type="number" name="stok_awal" class="form-input @error('stok_awal') is-invalid @enderror"
                               value="{{ old('stok_awal', $produks->stok_awal) }}" required>
                        @error('stok_awal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Masukkan jumlah stok terbaru.</small>
                    </div>

        

        <div class="form-actions">
            <button type="submit" class="btn-save">💾 Simpan</button>
            <a href="{{ route('stok.index') }}" class="btn-cancel">Kembali</a>
        </div>
    </form>
</div>

{{-- CSS + JS --}}
<style>
    /* Card container */
    .form-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: auto;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 18px;
    }

    /* Label */
    .form-label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #333;
    }

    /* Input & Select */
    .form-input,
    .form-select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.2s ease;
    }

    /* Focus effect */
    .form-input:focus,
    .form-select:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 6px rgba(74,144,226,0.3);
        outline: none;
    }

    /* Button Group */
    .form-actions {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }

    /* Save Button */
    .btn-save {
        background: #28a745;
        color: #fff;
        padding: 10px 24px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-save:hover {
        background: #218838;
    }

    /* Cancel Button */
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

<script>
    // Highlight input saat ada perubahan
    document.querySelectorAll(".form-input, .form-select").forEach(el => {
        el.addEventListener("change", () => {
            el.style.borderColor = "#28a745";
            setTimeout(() => {
                el.style.borderColor = "#ccc";
            }, 1000);
        });
    });
</script>
@endsection

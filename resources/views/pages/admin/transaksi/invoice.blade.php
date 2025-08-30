<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Transaksi #{{ $transaksi->id }}</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 30px; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 10px;
        }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background: #f3f4f6; }
        .text-right { text-align: right; }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <h2>🧾 Invoice Transaksi</h2>
        <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d M Y') }}</p>

        <table>
            <tr>
                <th>Produk</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>{{ $transaksi->produk->nama_produk }}</td>
                <td>{{ $transaksi->produk->suplier->nama_suplier ?? '-' }}</td>
                <td>{{ $transaksi->jumlah }}</td>
                <td class="text-right">Rp {{ number_format($transaksi->harga_jual,0,',','.') }}</td>
                <td class="text-right">Rp {{ number_format($transaksi->total,0,',','.') }}</td>
            </tr>
        </table>

        <p style="margin-top:20px; text-align:center;">Terima kasih telah bertransaksi 🙏</p>
    </div>
</body>
</html>

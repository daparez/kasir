@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard">
        <h2 class="page-title" data-aos="fade-right">📊 Dashboard</h2>

        <div class="grid">
            <!-- Jumlah Anggota -->
            <div class="card stat-card bg-info" data-aos="zoom-in">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="details">
                    <h3>Jumlah suplier</h3>
                    <p></p>
                </div>
            </div>

            <!-- Jumlah Kategori -->
            <div class="card stat-card bg-danger" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <div class="details">
                    <h3>Kategori Produk</h3>
                    <p>15</p>
                </div>
            </div>

            <!-- Jumlah Produk -->
            <div class="card stat-card bg-success" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="details">
                    <h3>Jumlah Produk</h3>
                    <p>350</p>
                </div>
            </div>

            <!-- Jumlah Transaksi -->
            <div class="card stat-card bg-warning" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon">
                    <i class="fas fa-cash-register"></i>
                </div>
                <div class="details">
                    <h3>Jumlah Transaksi</h3>
                    <p>89</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            padding: 20px;
            border-radius: 16px;
            color: white;
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.18);
        }

        .stat-card .icon {
            font-size: 36px;
            margin-right: 20px;
            opacity: 0.85;
        }

        .stat-card .details h3 {
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 6px;
            opacity: 0.9;
        }

        .stat-card .details p {
            font-size: 22px;
            font-weight: bold;
        }

        /* Warna tema */
        .bg-info { background: linear-gradient(135deg, #3498db, #2980b9); }
        .bg-danger { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .bg-success { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .bg-warning { background: linear-gradient(135deg, #f39c12, #d35400); }
    </style>

    <script>
        // Animasi angka naik
        document.addEventListener("DOMContentLoaded", function () {
            const counters = document.querySelectorAll(".stat-card p");
            counters.forEach(counter => {
                let value = parseInt(counter.innerText) || 0;
                let start = 0;
                let duration = 1000;
                let increment = value / (duration / 16);

                function animate() {
                    start += increment;
                    if (start < value) {
                        counter.innerText = Math.floor(start);
                        requestAnimationFrame(animate);
                    } else {
                        counter.innerText = value;
                    }
                }
                if (value > 0) animate();
            });
        });
    </script>
@endsection

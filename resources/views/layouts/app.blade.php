<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <style>
        /* ============ Reset ============ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #333;
        }

        .wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* ============ Sidebar ============ */
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #2c3e50, #1a252f);
            color: white;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
            position: relative;
        }

        .sidebar .brand {
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .menu {
            list-style: none;
            flex: 1;
            padding: 20px 0;
        }

        .sidebar .menu li {
            margin-bottom: 8px;
        }

        .sidebar .menu li a {
            padding: 12px 20px;
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar .menu li a:hover {
            background: rgba(255,255,255,0.08);
            border-left: 3px solid #3498db;
            color: #fff;
        }

        /* Collapsed */
        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .menu li a {
            text-align: center;
            padding: 12px;
        }

        /* ============ Main Area ============ */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f5f6fa;
            overflow: hidden;
        }

        /* Navbar */
        .navbar {
            height: 60px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid #eee;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .toggle-btn {
            font-size: 22px;
            background: none;
            border: none;
            cursor: pointer;
            color: #2c3e50;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        /* Content */
        .content {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            animation: fadeIn 0.6s ease;
        }

        /* Footer */
        .footer {
            height: 45px;
            background: #fff;
            text-align: center;
            line-height: 45px;
            border-top: 1px solid #eee;
            font-size: 14px;
            color: #777;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -240px;
                top: 0;
                bottom: 0;
                z-index: 100;
            }
            .sidebar.show {
                left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="brand">💰 Kasir App</div>
            <ul class="menu">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('kategori.index') }}">Kategori</a></li>
                <li><a href="{{ route('suplier.index') }}">Supplier</a></li>
                <li><a href="{{ route('produk.index') }}">Produk</a></li>
                <li><a href="{{ route('stok.index') }}">Stok</a></li>
                <li><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
            </ul>
        </aside>

        <!-- Main -->
        <div class="main">
            <!-- Navbar -->
            <header class="navbar">
                <button class="toggle-btn" id="toggleBtn">&#9776;</button>
                <h1>@yield('title')</h1>
                <div class="user-info">
                    <span>👤 Admin</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="content" data-aos="fade-up">
                @yield('content')
                @yield('scripts')
            </main>

            <!-- Footer -->
            <footer class="footer">
                &copy; 2025 SMK Nurul Islam
            </footer>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 600, once: true });

        const toggleBtn = document.getElementById("toggleBtn");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle("show");
            } else {
                sidebar.classList.toggle("collapsed");
            }
        });
    </script>
</body>
</html>

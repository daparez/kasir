<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f4f6fb;
            color: #333;
            transition: background 0.3s, color 0.3s;
        }

        .wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #4e54c8, #8f94fb);
            color: white;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease, background 0.3s;
            position: relative;
            box-shadow: 2px 0 8px rgba(0,0,0,0.15);
        }

        .sidebar .brand {
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar .menu {
            list-style: none;
            flex: 1;
            padding: 20px 0;
        }

        .sidebar .menu li {
            margin-bottom: 5px;
        }

        .sidebar .menu li a {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            color: #f0f0f0;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            font-size: 15px;
            border-radius: 8px;
            margin: 0 10px;
        }

        .sidebar .menu li a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar .menu li a:hover,
        .sidebar .menu li a.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 3px solid #ffdd57;
            color: #fff;
        }

        /* Collapsed */
        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .menu li a {
            justify-content: center;
            gap: 0;
        }

        .sidebar.collapsed .menu li a span {
            display: none;
        }

        /* Main */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f9f9ff;
            overflow: hidden;
            transition: background 0.3s, color 0.3s;
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
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: background 0.3s, color 0.3s;
        }

        .toggle-btn {
            font-size: 22px;
            background: none;
            border: none;
            cursor: pointer;
            color: #4e54c8;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logout-btn {
            background: linear-gradient(90deg, #ff6a6a, #ff4757);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            opacity: 0.85;
        }

        /* Dark mode toggle */
        .dark-toggle {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #555;
            transition: 0.3s;
        }

        .dark-toggle:hover {
            color: #000;
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
            transition: background 0.3s, color 0.3s;
        }

        /* Dark Mode Styles */
        body.dark {
            background: #1e1e2f;
            color: #e0e0e0;
        }

        body.dark .navbar {
            background: #2a2a3c;
            color: #e0e0e0;
            border-bottom: 1px solid #444;
        }

        body.dark .main {
            background: #2a2a3c;
            color: #e0e0e0;
        }

        body.dark .footer {
            background: #2a2a3c;
            border-top: 1px solid #444;
            color: #bbb;
        }

        body.dark .toggle-btn {
            color: #fff;
        }

        body.dark .dark-toggle {
            color: #ffdd57;
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
                <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('kategori.index') }}"><i class="fas fa-tags"></i><span>Kategori</span></a></li>
                <li><a href="{{ route('suplier.index') }}"><i class="fas fa-truck"></i><span>Supplier</span></a></li>
                <li><a href="{{ route('produk.index') }}"><i class="fas fa-box"></i><span>Produk</span></a></li>
                <li><a href="{{ route('stok.index') }}"><i class="fas fa-cubes"></i><span>Stok</span></a></li>
                <li><a href="{{ route('transaksi.index') }}"><i class="fas fa-cash-register"></i><span>Transaksi</span></a></li>
            </ul>
        </aside>

        <!-- Main -->
        <div class="main">
            <!-- Navbar -->
            <header class="navbar">
                <button class="toggle-btn" id="toggleBtn">&#9776;</button>
                <h1>@yield('title')</h1>
                <div class="user-info">
                    <button class="dark-toggle" id="darkToggle"><i class="fas fa-moon"></i></button>
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
        const darkToggle = document.getElementById("darkToggle");

        // Sidebar toggle
        toggleBtn.addEventListener("click", () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle("show");
            } else {
                sidebar.classList.toggle("collapsed");
            }
        });

        // Dark mode toggle
        function setDarkMode(isDark) {
            if (isDark) {
                document.body.classList.add("dark");
                darkToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem("darkMode", "true");
            } else {
                document.body.classList.remove("dark");
                darkToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem("darkMode", "false");
            }
        }

        // Event listener dark mode
        darkToggle.addEventListener("click", () => {
            const isDark = document.body.classList.contains("dark");
            setDarkMode(!isDark);
        });

        // Load preferensi user
        window.onload = () => {
            if (localStorage.getItem("darkMode") === "true") {
                setDarkMode(true);
            }
        };
    </script>
</body>
</html>

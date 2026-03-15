<x-app-layout>
    <style>
        /* ========ZAk styling ======== */
        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            background: #ffffff;
            color: #222222;
            line-height: 1.7;
        }

        h1,
        h2,
        h3 {
            font-family: "Playfair Display", serif;
            margin: 0;
        }

        .section-title {
            font-size: 2.4rem;
            text-align: center;
            margin-bottom: 10px;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto 30px;
            color: #555;
        }

        /* ======== Dashboard Boxes ======== */
        .dashboard-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .dashboard-box {
            background: white;
            padding: 40px;
            border-radius: 8px;
            border: 1px solid #eee;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dashboard-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .dashboard-box h2 {
            font-size: 1.8rem;
            color: #b89b5e;
            margin-bottom: 15px;
        }

        .dashboard-box p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 25px;
        }

        .dashboard-box a {
            background: #b89b5e;
            color: white;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
            display: inline-block;
        }

        .dashboard-box a:hover {
            background: #a58954;
        }

        /* ======== zak Navbar  ======== */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 60px;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            background: #ffffff;
            z-index: 1000;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .nav-links li {
            display: inline-block;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 6px 10px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #b89b5e;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 18px 25px;
            }

            .dashboard-container {
                padding: 40px 15px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.9rem;
            }
        }
    </style>

    <header class="navbar">
        <div class="logo">Seraphine Atelier</div>
        <nav>
            <ul class="nav-links">
                <li><a class="active" href="/">Home</a></li>
                <li><a href="/products">Shop</a></li>
                <li><a href="/products">Categories</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('profile.edit') }}">My Account</a></li>
            </ul>
        </nav>
    </header>

    <div class="dashboard-container">
        <h1 class="section-title">Welcome to Your Dashboard</h1>
        <p class="section-subtitle">Manage your orders and shopping cart</p>

        <div class="dashboard-grid">
            <!-- Orders Box -->
            <div class="dashboard-box">
                <h2>📦 My Orders</h2>
                <p>View and track all your orders. Check order status, shipping details, and more.</p>
                <a href="#orders">View Orders</a>
            </div>

            <!-- Cart Box -->
            <div class="dashboard-box">
                <h2>🛒 My Cart</h2>
                <p>Review items in your cart and proceed to checkout whenever you're ready.</p>
                <a href="#cart">View Cart</a>
            </div>
        </div>
    </div>
</x-app-layout>

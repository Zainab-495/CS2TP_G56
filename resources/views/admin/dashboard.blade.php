<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard – Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .admin-wrapper { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .admin-header h1 { font-size: 32px; font-weight: 700; color: #222; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .stat-card { background: #fff; border: 1px solid #e5e5e5; border-radius: 8px; padding: 28px; text-align: center; }
        .stat-card .number { font-size: 42px; font-weight: 700; color: #c8c389; }
        .stat-card .label { font-size: 14px; color: #666; margin-top: 6px; }
        .section-title { font-size: 20px; font-weight: 700; color: #222; margin-bottom: 16px; }
        .orders-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #e5e5e5; }
        .orders-table th { background: #111; color: #fff; padding: 12px 16px; text-align: left; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
        .orders-table td { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; color: #444; }
        .orders-table tr:last-child td { border-bottom: none; }
        .status-badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
        .status-pending  { background: #fff3cd; color: #856404; }
        .status-shipped  { background: #cfe2ff; color: #084298; }
        .status-completed { background: #d1e7dd; color: #0a3622; }
        .status-cancelled { background: #f8d7da; color: #842029; }
        .logout-btn { background: #111; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; }
        .logout-btn:hover { background: #333; }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="admin-wrapper">
            <div class="admin-header">
                <h1>Admin Dashboard</h1>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="number">{{ $totalOrders }}</div>
                    <div class="label">Total Orders</div>
                </div>
                <div class="stat-card">
                    <div class="number">{{ $totalProducts }}</div>
                    <div class="label">Products</div>
                </div>
                <div class="stat-card">
                    <div class="number">{{ $totalUsers }}</div>
                    <div class="label">Customers</div>
                </div>
            </div>

            <div class="section-title">Recent Orders</div>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                        <td>£{{ number_format($order->total_price, 2) }}</td>
                        <td><span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span></td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;color:#999;">No orders yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

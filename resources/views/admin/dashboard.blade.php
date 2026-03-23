<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard – Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .AdminPage { max-width: 1200px; margin: 80px auto 60px; padding: 0 24px 60px; }
        .AdminPage h1 { font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
        .AdminSubnav { display: flex; gap: 10px; margin-bottom: 36px; flex-wrap: wrap; }
        .AdminSubnav a { display: inline-block; font-size: 14px; font-weight: 600; text-decoration: none; padding: 8px 20px; border-radius: 4px; border: 2px solid #c8c389; color: #c8c389; transition: all 0.2s; }
        .AdminSubnav a:hover, .AdminSubnav a.active { background: #c8c389; color: #fff; }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .stat-card { background: #fff; border: 1px solid #e8e0d0; border-radius: 8px; padding: 28px; text-align: center; }
        .stat-card .number { font-size: 42px; font-weight: 700; color: #c8c389; }
        .stat-card .label { font-size: 14px; color: #666; margin-top: 6px; }

        .section-title { font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 16px; }
        .orders-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #e8e0d0; }
        .orders-table th { background: #1a1a1a; color: #fff; padding: 13px 16px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: 0.6px; }
        .orders-table td { padding: 13px 16px; border-bottom: 1px solid #f5f0e8; font-size: 14px; color: #444; }
        .orders-table tr:last-child td { border-bottom: none; }
        .orders-table tr:hover td { background: #fdfaf5; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: capitalize; }
        .status-pending    { background: #fff3cd; color: #856404; }
        .status-processing { background: #cfe2ff; color: #084298; }
        .status-shipped    { background: #d1ecf1; color: #0c5460; }
        .status-completed  { background: #d4edda; color: #155724; }
        .status-cancelled  { background: #f8d7da; color: #721c24; }
        .status-refunded   { background: #e2d9f3; color: #432874; }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="AdminPage">
                <h1>Admin Dashboard</h1>
                <div class="AdminSubnav">
                    <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
                    <a href="{{ route('admin.orders') }}">Customer Orders</a>
                </div>

                @if(isset($lowStockProducts) && $lowStockProducts->count() && !session('dismiss_low_stock_alert'))
                    <div id="lowStockAlert" style="position:relative;background: #fff3cd; color: #856404; border: 1px solid #ffeeba; border-radius: 6px; padding: 18px 24px; margin-bottom: 32px;">
                        <button onclick="dismissLowStockAlert()" style="position:absolute;top:10px;right:14px;background:none;border:none;font-size:18px;color:#856404;cursor:pointer;">&times;</button>
                        <strong>Inventory Alert:</strong> The following products are out of stock or below their threshold:
                        <ul style="margin: 12px 0 0 18px;">
                            @foreach($lowStockProducts as $product)
                                <li>
                                    <strong>{{ $product->name }}</strong> &ndash; Stock: {{ $product->stock_quantity }} (Threshold: {{ $product->stock_threshold }})
                                    <a href="{{ route('admin.products.edit', $product->id) }}" style="margin-left:10px;font-size:13px;">Edit</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <script>
                        function dismissLowStockAlert() {
                            fetch("{{ route('admin.dismissLowStockAlert') }}", { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                                .then(() => {
                                    document.getElementById('lowStockAlert').style.display = 'none';
                                });
                        }
                    </script>
                @endif

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
                            <td>&pound;{{ number_format($order->total_price ?? $order->total_amount, 2) }}</td>
                            <td><span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span></td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" style="text-align:center;color:#999;">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="section-title">Recent Refund/Return Requests</div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRefundRequests as $request)
                        <tr>
                            <td>{{ ucfirst($request->type) }}</td>
                            <td>#{{ $request->order_id }}</td>
                            <td>{{ $request->user->name ?? 'Unknown' }}</td>
                            <td><span class="status-badge status-{{ $request->status }}">{{ ucfirst($request->status) }}</span></td>
                            <td>{{ $request->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" style="text-align:center;color:#999;">No refund or return requests yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @include('partials.footer')
    </div>
</body>
</html>
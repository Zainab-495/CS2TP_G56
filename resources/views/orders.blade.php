<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders &ndash; Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .OrdersPage { max-width: 1100px; margin: 60px auto; padding: 0 20px 60px; }
        .OrdersPage h1 { font-size: 36px; font-weight: 700; color: #1a1a1a; margin-bottom: 36px; }
        .EmptyOrders { text-align: center; padding: 60px 20px; background: #f9f6f0; border-radius: 8px; }
        .EmptyOrders p { font-size: 17px; color: #666; margin-bottom: 24px; }
        .EmptyOrders a { display: inline-block; padding: 12px 28px; background: #111; color: white; text-decoration: none; border-radius: 4px; font-weight: 600; }
        .OrdersTable { width: 100%; border-collapse: collapse; }
        .OrdersTable thead tr { background: #f5f0e8; }
        .OrdersTable th { padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #555; border-bottom: 2px solid #e8e0d0; }
        .OrdersTable td { padding: 16px; border-bottom: 1px solid #eee; font-size: 14px; color: #333; vertical-align: middle; }
        .OrdersTable tr:last-child td { border-bottom: none; }
        .OrdersTable tr:hover td { background: #fdfaf5; }
        .StatusBadge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .StatusBadge.pending    { background: #fff3cd; color: #856404; }
        .StatusBadge.processing { background: #cfe2ff; color: #084298; }
        .StatusBadge.shipped    { background: #d1ecf1; color: #0c5460; }
        .StatusBadge.completed  { background: #d4edda; color: #155724; }
        .StatusBadge.cancelled  { background: #f8d7da; color: #721c24; }
        .StatusBadge.refunded   { background: #e2d9f3; color: #432874; }
        .ActionBtn { display: inline-block; padding: 6px 14px; font-size: 13px; font-weight: 600; border-radius: 4px; cursor: pointer; text-decoration: none; border: none; transition: opacity 0.2s; }
        .ActionBtn:hover { opacity: 0.8; }
        .ActionBtn.view   { background: #111; color: white; }
        .ActionBtn.cancel { background: #dc3545; color: white; margin-left: 6px; }
        .OrderAmount { font-weight: 700; color: #1a1a1a; }
        .Toast { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); background: #111; color: #fff; padding: 12px 24px; border-radius: 4px; font-size: 14px; z-index: 9999; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="OrdersPage">
                <h1>{{ $isAdmin ? 'All Orders' : 'My Orders' }}</h1>

                @if($orders->isEmpty())
                    <div class="EmptyOrders">
                        <p>{{ $isAdmin ? 'No orders have been placed yet.' : "You haven't placed any orders yet." }}</p>
                        <a href="{{ route('products.index') }}">Browse Products</a>
                    </div>
                @else
                    <div style="overflow-x:auto;">
                        <table class="OrdersTable">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    @if($isAdmin)<th>Customer</th>@endif
                                    <th style="text-align:center;">Items</th>
                                    <th style="text-align:right;">Total</th>
                                    <th style="text-align:center;">Status</th>
                                    <th style="text-align:center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td style="font-weight:700;">#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    @if($isAdmin)
                                        <td style="font-size:13px;">{{ $order->user->name ?? 'Unknown' }}<br><span style="color:#999;">{{ $order->user->email ?? '' }}</span></td>
                                    @endif
                                    <td style="text-align:center;">{{ $order->orderItems->count() }}</td>
                                    <td style="text-align:right;" class="OrderAmount">&pound;{{ number_format($order->total_amount, 2) }}</td>
                                    <td style="text-align:center;">
                                        <span class="StatusBadge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td style="text-align:center; white-space:nowrap;">
                                        <a href="{{ route('orders.show', $order->id) }}" class="ActionBtn view">View</a>
                                        @if($order->status === 'pending' || $order->status === 'processing')
                                            <button onclick="cancelOrder({{ $order->id }})" class="ActionBtn cancel">Cancel</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        @include('partials.footer')
    </div>

    <div class="Toast" id="toast"></div>
    <script>
        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg; t.style.opacity = 1;
            setTimeout(() => t.style.opacity = 0, 3000);
        }
        function cancelOrder(orderId) {
            if (!confirm('Cancel this order?')) return;
            fetch(`/orders/${orderId}/cancel`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { showToast('Order cancelled.'); setTimeout(() => location.reload(), 1000); }
                else showToast('Error: ' + (data.error || 'Could not cancel.'));
            })
            .catch(() => showToast('An error occurred.'));
        }
    </script>
</body>
</html>
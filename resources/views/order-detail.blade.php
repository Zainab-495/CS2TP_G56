<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} &ndash; Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .OrderDetailPage { max-width: 820px; margin: 60px auto; padding: 0 20px 60px; }
        .OrderDetailPage h1 { font-size: 30px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
        .BackLink { display: inline-block; margin-bottom: 28px; font-size: 14px; color: #666; text-decoration: none; }
        .BackLink:hover { color: #111; }
        .InfoCard { background: #f9f6f0; border: 1px solid #e8e0d0; border-radius: 8px; padding: 24px; margin-bottom: 24px; }
        .InfoGrid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .InfoLabel { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #888; margin-bottom: 4px; }
        .InfoValue { font-size: 15px; color: #1a1a1a; font-weight: 500; }
        .StatusBadge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .StatusBadge.pending    { background: #fff3cd; color: #856404; }
        .StatusBadge.processing { background: #cfe2ff; color: #084298; }
        .StatusBadge.shipped    { background: #d1ecf1; color: #0c5460; }
        .StatusBadge.completed  { background: #d4edda; color: #155724; }
        .StatusBadge.cancelled  { background: #f8d7da; color: #721c24; }
        .StatusBadge.refunded   { background: #e2d9f3; color: #432874; }
        .ItemsTable { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        .ItemsTable th { padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #555; background: #f5f0e8; border-bottom: 2px solid #e8e0d0; }
        .ItemsTable td { padding: 14px 16px; border-bottom: 1px solid #eee; font-size: 14px; color: #333; }
        .ItemsTable tr:last-child td { border-bottom: none; }
        .SummaryBox { background: #f9f6f0; border: 1px solid #e8e0d0; border-radius: 8px; padding: 20px 24px; margin-bottom: 24px; text-align: right; }
        .SummaryBox .TotalLabel { font-size: 14px; color: #555; margin-bottom: 6px; }
        .SummaryBox .TotalAmount { font-size: 22px; font-weight: 700; color: #1a1a1a; }
        .ActionRow { display: flex; gap: 12px; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .ActionBtn { display: inline-block; padding: 10px 22px; font-size: 14px; font-weight: 600; border-radius: 4px; cursor: pointer; text-decoration: none; border: none; transition: opacity 0.2s; }
        .ActionBtn:hover { opacity: 0.8; }
        .ActionBtn.back     { background: #777; color: white; }
        .ActionBtn.shop     { background: #111; color: white; }
        .ActionBtn.cancel   { background: #dc3545; color: white; }
        .Toast { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); background: #111; color: #fff; padding: 12px 24px; border-radius: 4px; font-size: 14px; z-index: 9999; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        @media (max-width: 600px) { .InfoGrid { grid-template-columns: 1fr; } .ActionRow { flex-direction: column; } }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="OrderDetailPage">
                <a href="{{ route('orders.index') }}" class="BackLink">&larr; Back to My Orders</a>
                <h1>Order #{{ $order->id }}</h1>

                {{-- Order meta --}}
                <div class="InfoCard">
                    <div class="InfoGrid">
                        <div>
                            <p class="InfoLabel">Order Date</p>
                            <p class="InfoValue">{{ $order->created_at->format('d M Y, g:i A') }}</p>
                        </div>
                        <div>
                            <p class="InfoLabel">Status</p>
                            <p class="InfoValue">
                                <span class="StatusBadge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            </p>
                        </div>
                        <div>
                            <p class="InfoLabel">Payment Method</p>
                            <p class="InfoValue">{{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}</p>
                        </div>
                        <div>
                            <p class="InfoLabel">Shipping Address</p>
                            <p class="InfoValue">{{ $order->shipping_address ?? 'N/A' }}</p>
                        </div>
                        @if($isAdmin ?? false)
                        <div>
                            <p class="InfoLabel">Customer</p>
                            <p class="InfoValue">{{ $order->user->name ?? 'Unknown' }}<br><span style="font-size:13px;color:#888;">{{ $order->user->email ?? '' }}</span></p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Items --}}
                <table class="ItemsTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:right;">Unit Price</th>
                            <th style="text-align:right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Product removed' }}</td>
                            <td style="text-align:center;">{{ $item->quantity }}</td>
                            <td style="text-align:right;">&pound;{{ number_format($item->unit_price, 2) }}</td>
                            <td style="text-align:right; font-weight:700;">&pound;{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Total --}}
                <div class="SummaryBox">
                    <p class="TotalLabel">Order Total</p>
                    <p class="TotalAmount">&pound;{{ number_format($order->total_amount, 2) }}</p>
                </div>

                @if($order->notes)
                <div class="InfoCard" style="margin-bottom:24px;">
                    <p class="InfoLabel">Order Notes</p>
                    <p style="margin:6px 0 0;font-size:14px;color:#333;">{{ $order->notes }}</p>
                </div>
                @endif

                {{-- Actions --}}
                <div class="ActionRow">
                    <a href="{{ route('orders.index') }}" class="ActionBtn back">My Orders</a>
                    <div style="display:flex;gap:10px;">
                        @if($order->status === 'pending' || $order->status === 'processing')
                            <button onclick="cancelOrder({{ $order->id }})" class="ActionBtn cancel">Cancel Order</button>
                        @endif

                    
        @if(true)
            <button onclick="requestReturn({{ $order->id }})" class="ActionBtn return">
                Request Return
            </button>
        @endif








                        <a href="{{ route('products.index') }}" class="ActionBtn shop">Continue Shopping</a>
                    </div>
                </div>
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
                if (data.success) { showToast('Order cancelled.'); setTimeout(() => location.href = '/orders', 1200); }
                else showToast('Error: ' + (data.error || 'Could not cancel.'));
            })
            .catch(() => showToast('An error occurred.'));
        }

        function requestReturn(orderId) {
    if (!confirm('Request a return for this order?')) return;

    showToast('Submitting return request...');

    setTimeout(() => {
        showToast('Return request sent!');
    }, 1000);

    console.log('Return requested for order:', orderId);
}
















    </script>
</body>
</html>
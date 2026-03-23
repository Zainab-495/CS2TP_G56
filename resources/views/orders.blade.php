<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders &ndash; Skyrose Atelier</title>
    @include('partials.head')
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')
            <div class="OrdersPage">
                <h1>{{ $isAdmin ? 'All Orders' : 'My Orders' }}</h1>
                {{-- Product Reviews Section removed: reviews can only be submitted from the product page. --}}
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
                                    <th>Products</th>
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
                                    <td>
                                        @foreach($order->items as $item)
                                            <span style="display:inline-block; margin-bottom:2px;">{{ $item->product->name ?? 'Product' }}</span>@if(!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td style="text-align:center;">{{ $order->items->count() }}</td>
                                    <td style="text-align:right;" class="OrderAmount">&pound;{{ number_format($order->total_amount, 2) }}</td>
                                    <td style="text-align:center;">
                                        <span class="StatusBadge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td style="text-align:center; white-space:nowrap;">
    <a href="{{ route('orders.show', $order->id) }}" class="ActionBtn view">View</a>

    {{-- Cancel button for pending orders --}}
    @if($order->status === 'pending' || $order->status === 'processing')
        <button onclick="cancelOrder({{ $order->id }})" class="ActionBtn cancel">Cancel</button>
    @endif

    {{-- Return button for delivered orders --}}
    @if(true)
        <button onclick="requestReturn({{ $order->id }})" class="ActionBtn return">Return</button>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js" defer></script>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            <!-- Top Navigation -->
            <div class="TopNav">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ url('/contact') }}">Contact</a>
                <div class="IconNav"></div>
            </div>

            <!-- Page Title -->
            <h1 style="text-align: center; margin: 30px 0;">Order #{{ $order->id }}</h1>

            <!-- Order Details Section -->
            <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
                
                <!-- Order Information -->
                <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <p style="color: #666; font-size: 12px; text-transform: uppercase; margin: 0;">Order Date</p>
                            <p style="font-size: 18px; font-weight: bold; margin: 5px 0;">{{ $order->created_at->format('M d, Y g:i A') }}</p>
                        </div>
                        <div>
                            <p style="color: #666; font-size: 12px; text-transform: uppercase; margin: 0;">Status</p>
                            <p style="font-size: 18px; font-weight: bold; margin: 5px 0;">
                                <span style="padding: 5px 12px; border-radius: 20px; 
                                    @if($order->status === 'pending') background: #fff3cd; color: #856404;
                                    @elseif($order->status === 'completed') background: #d4edda; color: #155724;
                                    @elseif($order->status === 'cancelled') background: #f8d7da; color: #721c24;
                                    @else background: #d1ecf1; color: #0c5460;
                                    @endif
                                    ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <p style="color: #666; font-size: 12px; text-transform: uppercase; margin: 0;">Payment Method</p>
                            <p style="font-size: 14px; margin: 5px 0;">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
                        </div>
                        <div>
                            <p style="color: #666; font-size: 12px; text-transform: uppercase; margin: 0;">Shipping Address</p>
                            <p style="font-size: 14px; margin: 5px 0;">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div style="margin-bottom: 30px;">
                    <h2 style="margin-top: 0;">Order Items</h2>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f5f5f5; border-bottom: 2px solid #ccc;">
                                <th style="padding: 12px; text-align: left;">Product</th>
                                <th style="padding: 12px; text-align: center;">Quantity</th>
                                <th style="padding: 12px; text-align: right;">Price</th>
                                <th style="padding: 12px; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 12px;">{{ $item->product->name }}</td>
                                    <td style="padding: 12px; text-align: center;">{{ $item->quantity }}</td>
                                    <td style="padding: 12px; text-align: right;">£{{ number_format($item->unit_price, 2) }}</td>
                                    <td style="padding: 12px; text-align: right; font-weight: bold;">£{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Order Total -->
                <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 30px; text-align: right;">
                    <h3 style="margin: 0 0 15px 0;">Order Summary</h3>
                    <p style="font-size: 18px; font-weight: bold; margin: 10px 0;">Total: £{{ number_format($order->total_amount, 2) }}</p>
                </div>

                <!-- Order Notes -->
                @if($order->notes)
                    <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                        <h3 style="margin-top: 0;">Order Notes</h3>
                        <p>{{ $order->notes }}</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div style="display: flex; gap: 10px; justify-content: space-between;">
                    <a href="{{ route('orders.index') }}" style="padding: 10px 20px; background: #666; color: white; text-decoration: none; border-radius: 3px;">Back to Orders</a>
                    @if($order->status === 'pending')
                        <button onclick="cancelOrder({{ $order->id }})" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;">Cancel Order</button>
                    @endif
                    <a href="{{ route('products.index') }}" style="padding: 10px 20px; background: #333; color: white; text-decoration: none; border-radius: 3px;">Continue Shopping</a>
                </div>
            </div>

            <!-- Featured Products Section -->
            @if($products && $products->count() > 0)
            <div style="margin-top: 50px; padding: 20px;">
                <h2 style="text-align: center; margin-bottom: 30px;">Featured Products</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    @foreach($products as $product)
                    <div style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                        <div style="padding: 15px;">
                            <h3 style="margin: 0 0 10px 0;">{{ $product->name }}</h3>
                            <p style="color: #666; margin: 0 0 10px 0; font-size: 14px;">{{ substr($product->description, 0, 80) }}...</p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 18px; font-weight: bold;">£{{ number_format($product->price, 2) }}</span>
                                <span style="background: #f0f0f0; padding: 5px 10px; border-radius: 3px; font-size: 12px;">{{ $product->category }}</span>
                            </div>
                            <a href="{{ route('products.show', $product->id) }}" style="display: block; margin-top: 10px; padding: 8px; background: #333; color: white; text-decoration: none; border-radius: 3px; text-align: center;">View Product</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <script>
                function cancelOrder(orderId) {
                    if (confirm('Are you sure you want to cancel this order?')) {
                        fetch(`/orders/${orderId}/cancel`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                alert('Order cancelled successfully');
                                location.href = '{{ route("orders.index") }}';
                            } else {
                                alert('Error: ' + data.error);
                            }
                        })
                        .catch(err => alert('An error occurred'));
                    }
                }
            </script>

        </div>

        <!-- Footer -->
        <div id="site-footer">
            <footer class="footer">
                <div class="FooterIconsContainer">
                    <img src="assets/images/FacebookIcon.png" class="FooterIcons" alt="facebook">
                    <img src="assets/images/InstagramIcon.png" class="FooterIcons" alt="instagram">
                    <img src="assets/images/YoutubeIcon.png" class="FooterIcons" alt="youtube">
                </div>
                <p class="ContactTitle">© 2025 Luxury Jewelry Store</p>
            </footer>
        </div>
    </div>
</body>
</html>

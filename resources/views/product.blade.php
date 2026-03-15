<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} – Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .ProductDetailPage { max-width: 1100px; margin: 60px auto; padding: 0 20px; }
        .ProductDetailGrid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }
        .ProductDetailImage { position: sticky; top: 100px; }
        .ProductDetailImage img {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #eee;
            object-fit: cover;
            max-height: 500px;
        }
        .ProductDetailInfo h1 { font-size: 32px; font-weight: 700; color: #1a1a1a; margin: 0 0 12px 0; }
        .ProductDetailCategory { font-size: 13px; color: #999; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
        .ProductDetailPrice { font-size: 28px; font-weight: 700; color: #c8c389; margin-bottom: 20px; }
        .ProductDetailDescription { font-size: 15px; color: #666; line-height: 1.8; margin-bottom: 24px; }
        .ProductDetailMeta { display: flex; flex-direction: column; gap: 8px; margin-bottom: 28px; font-size: 14px; color: #555; }
        .ProductDetailMeta span strong { color: #222; }
        .StockBadge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 24px; }
        .StockBadge.in-stock { background: #d1e7dd; color: #0a3622; }
        .StockBadge.out-of-stock { background: #f8d7da; color: #842029; }
        .QtyRow { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; font-size: 14px; color: #555; }
        .QtyRow select { padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; background: white; }
        .AddToCartBtn {
            width: 100%; padding: 14px; background: #111; color: white;
            border: none; border-radius: 4px; font-size: 16px; font-weight: 600;
            cursor: pointer; transition: background 0.3s; margin-bottom: 10px;
        }
        .AddToCartBtn:hover { background: #333; }
        .WishlistBtnDetail {
            width: 100%; padding: 12px; background: transparent; color: #111;
            border: 1px solid #111; border-radius: 4px; font-size: 14px;
            font-weight: 600; cursor: pointer; transition: all 0.3s;
        }
        .WishlistBtnDetail:hover { background: #fff0f0; border-color: #e74c3c; color: #e74c3c; }
        .BackLink { display: inline-block; margin-bottom: 30px; font-size: 14px; color: #666; text-decoration: none; }
        .BackLink:hover { color: #111; }
        .Toast {
            position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%);
            background: #111; color: #fff; padding: 12px 24px; border-radius: 4px;
            font-size: 14px; z-index: 9999; opacity: 0; transition: opacity 0.3s; pointer-events: none;
        }
        @media (max-width: 768px) {
            .ProductDetailGrid { grid-template-columns: 1fr; gap: 30px; }
            .ProductDetailImage { position: static; }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="ProductDetailPage">
                <a href="/products" class="BackLink">&larr; Back to Products</a>

                <div class="ProductDetailGrid">
                    <div class="ProductDetailImage">
                        <img src="{{ asset($product->image_url ?? 'images/logo Skyrose.jpg') }}"
                             alt="{{ $product->name }}"
                             onerror="this.src='{{ asset('images/logo Skyrose.jpg') }}'">
                    </div>

                    <div class="ProductDetailInfo">
                        <div class="ProductDetailCategory">{{ $product->category }}</div>
                        <h1>{{ $product->name }}</h1>
                        <div class="ProductDetailPrice">&pound;{{ number_format($product->price, 2) }}</div>

                        @if($product->stock_quantity > 0)
                            <span class="StockBadge in-stock">In Stock ({{ $product->stock_quantity }} available)</span>
                        @else
                            <span class="StockBadge out-of-stock">Out of Stock</span>
                        @endif

                        <div class="ProductDetailDescription">{{ $product->description }}</div>

                        <div class="ProductDetailMeta">
                            @if($product->material)
                            <span><strong>Material:</strong> {{ $product->material }}</span>
                            @endif
                            <span><strong>Category:</strong> {{ $product->category }}</span>
                        </div>

                        <div class="QtyRow">
                            <label for="qty">Quantity:</label>
                            <select id="qty">
                                @for($i = 1; $i <= min(10, max(1, $product->stock_quantity)); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        @if($product->stock_quantity > 0)
                        <button class="AddToCartBtn" onclick="addToCart()">Add to Cart</button>
                        @else
                        <button class="AddToCartBtn" disabled style="background:#ccc;cursor:not-allowed;">Out of Stock</button>
                        @endif
                        <button class="WishlistBtnDetail" id="wishlistBtn" onclick="toggleWishlist()">&#9825; Add to Wishlist</button>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>

    <div class="Toast" id="toast"></div>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const productName = @json($product->name);
        const productPrice = {{ $product->price }};
        const productId = {{ $product->id }};

        function addToCart() {
            const qty = parseInt(document.getElementById('qty').value, 10);
            fetch('/cart/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                credentials: 'include',
                body: JSON.stringify({ productId: productId, productName: productName, price: productPrice, quantity: qty })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    showToast(productName + ' added to cart');
                    const el = document.getElementById('cart-count');
                    if (el) el.textContent = data.cartCount;
                } else {
                    showToast(data.error || 'Error adding to cart');
                }
            })
            .catch(() => showToast('Error adding to cart'));
        }

        function toggleWishlist() {
            const btn = document.getElementById('wishlistBtn');
            const active = btn.classList.toggle('active');
            btn.innerHTML = active ? '&#9829; Remove from Wishlist' : '&#9825; Add to Wishlist';
            showToast(active ? productName + ' added to wishlist' : productName + ' removed from wishlist');
        }

        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.style.opacity = '1';
            clearTimeout(t._t);
            t._t = setTimeout(() => { t.style.opacity = '0'; }, 2500);
        }

        fetch('/session/init', { credentials: 'include' })
            .then(r => r.json())
            .then(d => { const el = document.getElementById('cart-count'); if (el && d.cartCount !== undefined) el.textContent = d.cartCount; });
    </script>
</body>
</html>


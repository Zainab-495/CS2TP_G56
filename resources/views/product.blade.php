<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} – Skyrose Atelier</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo%20Skyrose.jpg') }}">
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


            <!-- Product Reviews Section (Prettier) -->
            <div class="ProductReviews" style="max-width:700px;margin:40px auto 0;">
                <h2 style="font-size:2em;font-weight:700;color:#c8c389;margin-bottom:18px;letter-spacing:1px;">Product Reviews</h2>
                @if(session('success'))
                    <div style="color:#198754;background:#e9fbe7;padding:10px 18px;border-radius:6px;margin-bottom:18px;font-weight:600;">{{ session('success') }}</div>
                @endif
                @auth
                <form method="POST" action="{{ route('reviews.store', ['product' => $product->id]) }}" style="margin-bottom:30px;background:#faf9f6;padding:22px 28px;border-radius:10px;box-shadow:0 2px 8px rgba(200,195,137,0.08);">
                    @csrf
                    <div style="display:flex;gap:18px;align-items:center;margin-bottom:12px;flex-wrap:wrap;">
                        <label for="rating" style="font-weight:600;color:#222;">Rating:</label>
                        <div id="star-rating" style="display:inline-block;">
                            @for($i=1;$i<=5;$i++)
                                <span class="star" data-value="{{ $i }}" style="font-size:2em;cursor:pointer;color:#e4e4e4;">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" required>
                    </div>
                    <div style="margin-bottom:12px;">
                        <label for="comment" style="font-weight:600;color:#222;">Comment:</label><br>
                        <textarea name="comment" id="comment" rows="3" style="width:100%;max-width:500px;padding:10px 14px;border-radius:6px;border:1px solid #ddd;font-size:1em;"></textarea>
                    </div>
                    <button type="submit" style="background:#c8c389;color:#fff;font-weight:700;padding:10px 28px;border:none;border-radius:6px;font-size:1em;cursor:pointer;transition:background 0.2s;">Submit Review</button>
                </form>
                <script>
                // Star rating interactivity
                document.addEventListener('DOMContentLoaded', function() {
                    const stars = document.querySelectorAll('#star-rating .star');
                    const ratingInput = document.getElementById('rating');
                    let currentRating = 0;
                    stars.forEach(star => {
                        star.addEventListener('mouseenter', function() {
                            const val = parseInt(this.getAttribute('data-value'));
                            highlightStars(val);
                        });
                        star.addEventListener('mouseleave', function() {
                            highlightStars(currentRating);
                        });
                        star.addEventListener('click', function() {
                            currentRating = parseInt(this.getAttribute('data-value'));
                            ratingInput.value = currentRating;
                            highlightStars(currentRating);
                        });
                    });
                    function highlightStars(rating) {
                        stars.forEach(star => {
                            if (parseInt(star.getAttribute('data-value')) <= rating) {
                                star.style.color = '#c8c389';
                            } else {
                                star.style.color = '#e4e4e4';
                            }
                        });
                    }
                });
                </script>
                @else
                    <p style="background:#fff3cd;color:#856404;padding:10px 18px;border-radius:6px;"> <a href="{{ route('login') }}" style="color:#856404;text-decoration:underline;">Log in</a> to leave a review.</p>
                @endauth

                @if($product->reviews->count())
                    <ul style="list-style:none;padding:0;margin:0;">
                    @foreach($product->reviews as $review)
                        <li style="border-bottom:1px solid #eee;padding:18px 0;display:flex;gap:18px;align-items:flex-start;">
                            <div style="background:#c8c389;color:#fff;font-weight:700;width:38px;height:38px;display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:1.1em;flex-shrink:0;">
                                {{ strtoupper(substr($review->user->name ?? 'U',0,1)) }}
                            </div>
                            <div style="flex:1;">
                                <div style="font-weight:600;color:#222;">{{ $review->user->name ?? 'User' }}</div>
                                <div style="color:#c8c389;font-weight:600;margin:2px 0 6px 0;">@for($i=1;$i<=5;$i++)<span style="font-size:1.1em;">{{ $i <= $review->rating ? '★' : '☆' }}</span>@endfor</div>
                                <div style="font-size:1em;color:#444;margin-bottom:4px;">{{ $review->comment }}</div>
                                <small style="color:#888;">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                @else
                    <p style="color:#888;font-style:italic;">No reviews yet.</p>
                @endif
            </div>

        </div>

        @include('partials.footer')
    </div>

    <div class="Toast" id="toast"></div>

    <script src="{{ asset('js/wishlist.js') }}"></script>
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
            const wl = window.wishlist;
            if (!wl) return;

            const imgEl = document.querySelector('.ProductDetailImage img');
            const imgSrc = imgEl ? imgEl.src : '';
            const catEl  = document.querySelector('.ProductDetailCategory');
            const cat    = catEl ? catEl.textContent.trim() : '';

            if (wl.isInWishlist(productName)) {
                wl.removeFromWishlist(productName);
                btn.classList.remove('active');
                btn.innerHTML = '&#9825; Add to Wishlist';
                showToast(productName + ' removed from wishlist');
            } else {
                wl.addToWishlist({
                    name:     productName,
                    price:    '£' + productPrice.toFixed(2),
                    image:    imgSrc,
                    link:     window.location.pathname,
                    category: cat
                });
                btn.classList.add('active');
                btn.innerHTML = '&#9829; In Wishlist';
                showToast(productName + ' added to wishlist');
            }
        }
        function showToast(msg) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.style.opacity = 1;
            setTimeout(() => { toast.style.opacity = 0; }, 2000);
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
            </div>
        </div>

        <!-- Product Reviews Section -->
        <div class="ProductReviews" style="max-width:700px;margin:40px auto 0;">
            <h2>Product Reviews</h2>
            @if(session('success'))
                <div style="color:green;">{{ session('success') }}</div>
            @endif
            @auth
            <form method="POST" action="{{ route('reviews.store', ['product' => $product->id]) }}" style="margin-bottom:30px;">
                @csrf
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" required>
                    <option value="">Select</option>
                    @for($i=1;$i<=5;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <br>
                <label for="comment">Comment:</label><br>
                <textarea name="comment" id="comment" rows="3" style="width:100%;max-width:500px;"></textarea>
                <br>
                <button type="submit">Submit Review</button>
            </form>
            @else
                <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
            @endauth

            @if($product->reviews->count())
                <ul style="list-style:none;padding:0;">
                @foreach($product->reviews as $review)
                    <li style="border-bottom:1px solid #eee;padding:12px 0;">
                        <strong>{{ $review->user->name ?? 'User' }}</strong> -
                        <span>Rating: {{ $review->rating }}/5</span><br>
                        <span>{{ $review->comment }}</span><br>
                        <small style="color:#888;">{{ $review->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
                </ul>
            @else
                <p>No reviews yet.</p>
            @endif
        </div>
    </div>

    <div class="Toast" id="toast"></div>

    <script src="{{ asset('js/wishlist.js') }}"></script>
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const productName = @json($product->name);
        const productPrice = {{ $product->price }};
        const productId = {{ $product->id }};

        function addToCart() {
            const qty = parseInt(document.getElementById('qty').value, 10);
            fetch('/cart/add', {
                method: 'POST',

                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>{{ $product->name }} | Product Details</title>
                    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
                    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo%20Skyrose.jpg') }}">
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

                            <!-- Product Reviews Section -->
                            <div class="ProductReviews" style="max-width:700px;margin:40px auto 0;">
                                <h2>Product Reviews</h2>
                                @if(session('success'))
                                    <div style="color:green;">{{ session('success') }}</div>
                                @endif
                                @auth
                                <form method="POST" action="{{ route('reviews.store', ['product' => $product->id]) }}" style="margin-bottom:30px;">
                                    @csrf
                                    <label for="rating">Rating:</label>
                                    <select name="rating" id="rating" required>
                                        <option value="">Select</option>
                                        @for($i=1;$i<=5;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <br>
                                    <label for="comment">Comment:</label><br>
                                    <textarea name="comment" id="comment" rows="3" style="width:100%;max-width:500px;"></textarea>
                                    <br>
                                    <button type="submit">Submit Review</button>
                                </form>
                                @else
                                    <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
                                @endauth

                                @if($product->reviews->count())
                                    <ul style="list-style:none;padding:0;">
                                    @foreach($product->reviews as $review)
                                        <li style="border-bottom:1px solid #eee;padding:12px 0;">
                                            <strong>{{ $review->user->name ?? 'User' }}</strong> -
                                            <span>Rating: {{ $review->rating }}/5</span><br>
                                            <span>{{ $review->comment }}</span><br>
                                            <small style="color:#888;">{{ $review->created_at->diffForHumans() }}</small>
                                        </li>
                                    @endforeach
                                    </ul>
                                @else
                                    <p>No reviews yet.</p>
                                @endif
                            </div>

                        </div>

                        @include('partials.footer')
                    </div>

                    <div class="Toast" id="toast"></div>

                    <script src="{{ asset('js/wishlist.js') }}"></script>
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
                            const wl = window.wishlist;
                            if (!wl) return;

                            const imgEl = document.querySelector('.ProductDetailImage img');
                            const imgSrc = imgEl ? imgEl.src : '';
                            const catEl  = document.querySelector('.ProductDetailCategory');
                            const cat    = catEl ? catEl.textContent.trim() : '';

                            if (wl.isInWishlist(productName)) {
                                wl.removeFromWishlist(productName);
                                btn.classList.remove('active');
                                btn.innerHTML = '&#9825; Add to Wishlist';
                                showToast(productName + ' removed from wishlist');
                            } else {
                                wl.addToWishlist({
                                    name:     productName,
                                    price:    '£' + productPrice.toFixed(2),
                                    image:    imgSrc,
                                    link:     window.location.pathname,
                                    category: cat
                                });
                                btn.classList.add('active');
                                btn.innerHTML = '&#9829; In Wishlist';
                                showToast(productName + ' added to wishlist');
                            }
                        }
                        function showToast(msg) {
                            const toast = document.getElementById('toast');
                            toast.textContent = msg;
                            toast.style.opacity = 1;
                            setTimeout(() => { toast.style.opacity = 0; }, 2000);
                        }
                    </script>
                </body>
                </html>
            }

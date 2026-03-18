<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist – Skyrose Atelier</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        .WishlistPage { max-width: 1100px; margin: 60px auto; padding: 0 24px; }
        .WishlistPage h1 { font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
        .WishlistSubtitle { font-size: 15px; color: #888; margin-bottom: 40px; }

        .WishlistGrid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 28px;
        }

        .WishlistCard {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s;
        }
        .WishlistCard:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.08); }

        .WishlistCard img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .WishlistCardBody {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .WishlistCardCategory {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
            margin-bottom: 6px;
        }

        .WishlistCardName {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        .WishlistCardPrice {
            font-size: 18px;
            font-weight: 700;
            color: #c8c389;
            margin-bottom: 16px;
        }

        .WishlistCardActions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .WishlistAddToCartBtn {
            flex: 1;
            padding: 10px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .WishlistAddToCartBtn:hover { background: #333; }

        .WishlistRemoveBtn {
            padding: 10px 12px;
            background: transparent;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            color: #e74c3c;
            line-height: 1;
            transition: border-color 0.2s, background 0.2s;
        }
        .WishlistRemoveBtn:hover { background: #fff0f0; border-color: #e74c3c; }

        .WishlistEmpty {
            text-align: center;
            padding: 80px 20px;
            color: #888;
        }
        .WishlistEmpty svg { margin-bottom: 20px; opacity: 0.3; }
        .WishlistEmpty h2 { font-size: 22px; font-weight: 600; margin-bottom: 10px; color: #444; }
        .WishlistEmpty p { margin-bottom: 24px; font-size: 15px; }
        .WishlistEmpty a {
            display: inline-block;
            padding: 12px 32px;
            background: #111;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }
        .WishlistEmpty a:hover { background: #333; }

        .WishlistToast {
            position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%);
            background: #111; color: #fff; padding: 12px 24px; border-radius: 4px;
            font-size: 14px; z-index: 9999; opacity: 0; transition: opacity 0.3s;
            pointer-events: none;
        }

        @media (max-width: 600px) {
            .WishlistGrid { grid-template-columns: 1fr 1fr; gap: 16px; }
            .WishlistCard img { height: 160px; }
        }
        @media (max-width: 400px) {
            .WishlistGrid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="PageContent">
        @include('partials.nav')

        <div class="WishlistPage">
            <h1>My Wishlist</h1>
            <p class="WishlistSubtitle">Items you've saved – click the heart to remove them.</p>

            <div id="wishlist-container">
                <!-- Rendered by JS from localStorage -->
            </div>
        </div>
    </div>

    @include('partials.footer')
</div>

<div class="WishlistToast" id="wishlist-page-toast"></div>

<script src="{{ asset('js/wishlist.js') }}"></script>
<script>
(function () {
    var STORAGE_KEY = 'skyrose_wishlist';

    function getWishlist() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
        catch (e) { return []; }
    }

    function saveWishlist(items) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    }

    function showToast(msg) {
        var t = document.getElementById('wishlist-page-toast');
        t.textContent = msg;
        t.style.opacity = '1';
        clearTimeout(t._wt);
        t._wt = setTimeout(function () { t.style.opacity = '0'; }, 2500);
    }

    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, function (c) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
        });
    }

    function addToCart(name, price) {
        var numericPrice = parseFloat(String(price).replace(/[^0-9.]/g, '')) || 0;
        var csrf = document.querySelector('meta[name="csrf-token"]');
        fetch('/cart/add', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf ? csrf.getAttribute('content') : ''
            },
            body: JSON.stringify({ productName: name, price: numericPrice, quantity: 1 })
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            if (data.success) {
                showToast(name + ' added to cart');
            } else {
                showToast(data.error || 'Could not add to cart');
            }
        })
        .catch(function () { showToast('Could not add to cart'); });
    }

    function removeItem(name) {
        var items = getWishlist().filter(function (i) { return i.name !== name; });
        saveWishlist(items);
        showToast(name + ' removed from wishlist');
        renderWishlist();
    }

    function renderWishlist() {
        var container = document.getElementById('wishlist-container');
        var items = getWishlist();

        if (items.length === 0) {
            container.innerHTML = '<div class="WishlistEmpty">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>' +
                '<h2>Your wishlist is empty</h2>' +
                '<p>Heart items on any product page to save them here.</p>' +
                '<a href="/products">Browse Products</a>' +
                '</div>';
            return;
        }

        var html = '<div class="WishlistGrid">';
        items.forEach(function (item) {
            var safeImage = escapeHtml(item.image || '/images/logo Skyrose.jpg');
            var safeName  = escapeHtml(item.name || '');
            var safeCat   = escapeHtml(item.category || '');
            var safePrice = escapeHtml(item.price || '');
            var safeLink  = escapeHtml(item.link || '/products');

            html += '<div class="WishlistCard">' +
                '<a href="' + safeLink + '"><img src="' + safeImage + '" alt="' + safeName + '" onerror="this.src=\'/images/logo Skyrose.jpg\'"></a>' +
                '<div class="WishlistCardBody">' +
                    '<div class="WishlistCardCategory">' + safeCat + '</div>' +
                    '<div class="WishlistCardName">' + safeName + '</div>' +
                    '<div class="WishlistCardPrice">' + safePrice + '</div>' +
                    '<div class="WishlistCardActions">' +
                        '<button class="WishlistAddToCartBtn" onclick="addToCartFromWishlist(' + JSON.stringify(item.name) + ',' + JSON.stringify(item.price) + ')">Add to Cart</button>' +
                        '<button class="WishlistRemoveBtn" onclick="removeFromWishlistPage(' + JSON.stringify(item.name) + ')" title="Remove from wishlist">&#9829;</button>' +
                    '</div>' +
                '</div>' +
                '</div>';
        });
        html += '</div>';
        container.innerHTML = html;
    }

    window.addToCartFromWishlist = addToCart;
    window.removeFromWishlistPage = removeItem;

    renderWishlist();
})();
</script>
</body>
</html>

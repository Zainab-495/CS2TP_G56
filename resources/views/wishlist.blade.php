<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic page setup (Kiff) -->
    <meta charset="UTF-8">

    <!-- CSRF token for secure form requests (Zak) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Makes the page responsive on mobile (Kiff) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title shown in browser tab (Zak) -->
    <title>My Wishlist – Skyrose Atelier</title>

    <!-- Link to main CSS file (Kiff) -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <!-- ================= STYLES FOR WISHLIST PAGE (Zak styling) ================= -->
    <style>

        /* Main container for wishlist page */
        .WishlistPage { max-width: 1100px; margin: 60px auto; padding: 0 24px; }

        /* Page heading */
        .WishlistPage h1 { font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }

        /* Subtitle under heading */
        .WishlistSubtitle { font-size: 15px; color: #888; margin-bottom: 40px; }

        /* Grid layout for wishlist items */
        .WishlistGrid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 28px;
        }

        /* Individual product card */
        .WishlistCard {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s;
        }

        /* Hover effect for cards (Zak) */
        .WishlistCard:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.08); }

        /* Product image styling */
        .WishlistCard img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        /* Card content section */
        .WishlistCardBody {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* Product category label */
        .WishlistCardCategory {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
            margin-bottom: 6px;
        }

        /* Product name */
        .WishlistCardName {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        /* Product price */
        .WishlistCardPrice {
            font-size: 18px;
            font-weight: 700;
            color: #c8c389;
            margin-bottom: 16px;
        }

        /* Action buttons container */
        .WishlistCardActions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        /* Add to cart button */
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

        /* Hover effect for add to cart */
        .WishlistAddToCartBtn:hover { background: #333; }

        /* Remove button (heart icon) */
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

        /* Hover effect for remove button */
        .WishlistRemoveBtn:hover { background: #fff0f0; border-color: #e74c3c; }

        /* Styling for empty wishlist message */
        .WishlistEmpty {
            text-align: center;
            padding: 80px 20px;
            color: #888;
        }

        /* Icon spacing in empty state */
        .WishlistEmpty svg { margin-bottom: 20px; opacity: 0.3; }

        /* Empty title */
        .WishlistEmpty h2 { font-size: 22px; font-weight: 600; margin-bottom: 10px; color: #444; }

        /* Empty description */
        .WishlistEmpty p { margin-bottom: 24px; font-size: 15px; }

        /* Button in empty wishlist */
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

        /* Hover effect for empty state button */
        .WishlistEmpty a:hover { background: #333; }

        /* Toast notification popup */
        .WishlistToast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            background: #111;
            color: #fff;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 14px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        /* Responsive layout for tablets (Zak) */
        @media (max-width: 600px) {
            .WishlistGrid { grid-template-columns: 1fr 1fr; gap: 16px; }
            .WishlistCard img { height: 160px; }
        }

        /* Responsive layout for small phones (Kiff) */
        @media (max-width: 400px) {
            .WishlistGrid { grid-template-columns: 1fr; }
        }

    </style>
</head>
<body>

<!-- Wrapper for entire page layout -->
<div class="page-wrapper">
    <div class="PageContent">

        <!-- Navigation bar (shared component) -->
        @include('partials.nav')

        <!-- Wishlist section (Zak - main feature) -->
        <div class="WishlistPage">

            <!-- Page title -->
            <h1>My Wishlist</h1>

            <!-- Subtitle explaining functionality -->
            <p class="WishlistSubtitle">Items you've saved – click the heart to remove them.</p>

            <!-- Container where wishlist items are rendered using JavaScript -->
            <div id="wishlist-container"></div>

        </div>
    </div>

    <!-- Footer section (shared across site) -->
    @include('partials.footer')
</div>

<!-- Toast notification for actions like add/remove -->
<div class="WishlistToast" id="wishlist-page-toast"></div>

<!-- External wishlist JS file (Zak - functionality split) -->
<script src="{{ asset('js/wishlist.js') }}"></script>

<script>
(function () {

    /* Key used for storing wishlist in localStorage */
    var STORAGE_KEY = 'skyrose_wishlist';

    /* Get wishlist items from localStorage */
    function getWishlist() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
        catch (e) { return []; }
    }

    /* Save updated wishlist to localStorage */
    function saveWishlist(items) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    }

    /* Show toast message to user */
    function showToast(msg) {
        var t = document.getElementById('wishlist-page-toast');
        t.textContent = msg;
        t.style.opacity = '1';

        clearTimeout(t._wt);
        t._wt = setTimeout(function () {
            t.style.opacity = '0';
        }, 2500);
    }

    /* Prevent XSS by escaping HTML */
    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, function (c) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
        });
    }

    /* Add item from wishlist to cart (Zak) */
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
            body: JSON.stringify({
                productName: name,
                price: numericPrice,
                quantity: 1
            })
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            if (data.success) {
                showToast(name + ' added to cart');
            } else {
                showToast(data.error || 'Could not add to cart');
            }
        })
        .catch(function () {
            showToast('Could not add to cart');
        });
    }

    /* Remove item from wishlist (Kiff) */
    function removeItem(name) {
        var items = getWishlist().filter(function (i) {
            return i.name !== name;
        });

        saveWishlist(items);
        showToast(name + ' removed from wishlist');

        renderWishlist();
    }

    /* Render wishlist items dynamically */
    function renderWishlist() {
        var container = document.getElementById('wishlist-container');
        var items = getWishlist();

        /* If wishlist is empty, show empty state */
        if (items.length === 0) {
            container.innerHTML = '<div class="WishlistEmpty"> ... </div>';
            return;
        }

        /* Build wishlist grid */
        var html = '<div class="WishlistGrid">';

        items.forEach(function (item) {

            /* Clean values before inserting into HTML */
            var safeImage = escapeHtml(item.image || '/images/logo Skyrose.jpg');
            var safeName  = escapeHtml(item.name || '');
            var safeCat   = escapeHtml(item.category || '');
            var safePrice = escapeHtml(item.price || '');
            var safeLink  = escapeHtml(item.link || '/products');

            html += '<div class="WishlistCard">' +

                /* Clickable product image */
                '<a href="' + safeLink + '">' +
                '<img src="' + safeImage + '" alt="' + safeName + '">' +
                '</a>' +

                '<div class="WishlistCardBody">' +
                    '<div class="WishlistCardCategory">' + safeCat + '</div>' +
                    '<div class="WishlistCardName">' + safeName + '</div>' +
                    '<div class="WishlistCardPrice">' + safePrice + '</div>' +

                    '<div class="WishlistCardActions">' +
                        /* Add to cart button (uses data-attrs + delegated handler) */
                        '<button class="WishlistAddToCartBtn" ' +
                            'data-action="add" ' +
                            'data-name="' + safeName + '" ' +
                            'data-price="' + safePrice + '"' +
                        '>Add to Cart</button>' +

                        /* Remove button (uses data-attrs + delegated handler) */
                        '<button class="WishlistRemoveBtn" ' +
                            'data-action="remove" ' +
                            'data-name="' + safeName + '"' +
                        '>&#9829;</button>' +

                    '</div>' +
                '</div>' +
            '</div>';
        });

        html += '</div>';
        container.innerHTML = html;
    }

    /* Make functions accessible globally */
    window.removeFromWishlistPage = removeItem;

    /* Handle clicks via event delegation so data-attrs stay safe and re-renders still work */
    var wishlistContainer = document.getElementById('wishlist-container');
    document.addEventListener('click', function (e) {
        if (!wishlistContainer || !wishlistContainer.contains(e.target)) return;

        var addBtn = e.target.closest('.WishlistAddToCartBtn');
        var removeBtn = e.target.closest('.WishlistRemoveBtn');

        if (addBtn && addBtn.dataset.name) {
            addToCart(addBtn.dataset.name, addBtn.dataset.price);
            return;
        }

        if (removeBtn && removeBtn.dataset.name) {
            removeItem(removeBtn.dataset.name);
        }
    });

    /* Initial render on page load */
    renderWishlist();

})();
</script>

</body>
</html>

/**
 * Skyrose Atelier – Wishlist module
 * Persists wishlist to localStorage so it survives page navigation.
 * Exposes: window.toggleWishlist(event, btn) for product-card heart buttons
 *          window.wishlist  – helper object used by product detail page
 */
(function () {
    var STORAGE_KEY = 'skyrose_wishlist';

    function getWishlist() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
        catch (e) { return []; }
    }

    function saveWishlist(items) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    }

    function isInWishlist(name) {
        return getWishlist().some(function (i) { return i.name === name; });
    }

    function addToWishlist(item) {
        var items = getWishlist();
        if (!items.some(function (i) { return i.name === item.name; })) {
            items.push(item);
            saveWishlist(items);
        }
    }

    function removeFromWishlist(name) {
        saveWishlist(getWishlist().filter(function (i) { return i.name !== name; }));
    }

    function showWishlistToast(message) {
        var toast = document.getElementById('wishlist-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'wishlist-toast';
            toast.style.cssText = [
                'position:fixed', 'bottom:24px', 'left:50%',
                'transform:translateX(-50%)', 'background:#111', 'color:#fff',
                'padding:12px 24px', 'border-radius:4px', 'font-size:14px',
                'z-index:9999', 'opacity:0', 'transition:opacity 0.3s',
                'pointer-events:none'
            ].join(';');
            document.body.appendChild(toast);
        }
        toast.textContent = message;
        toast.style.opacity = '1';
        clearTimeout(toast._wt);
        toast._wt = setTimeout(function () { toast.style.opacity = '0'; }, 2500);
    }

    /**
     * Used by onclick="toggleWishlist(event, this)" on product-card heart buttons.
     * Reads product info from the surrounding .ProductCard anchor.
     */
    window.toggleWishlist = function (event, btn) {
        event.preventDefault();
        event.stopPropagation();

        var card = btn.closest('.ProductCard');
        var name     = (card && card.dataset.name)  || (card && card.querySelector('.ProductTitle') && card.querySelector('.ProductTitle').textContent.trim()) || '';
        var image    = (card && card.querySelector('.ProductImage') && card.querySelector('.ProductImage').src) || '';
        var price    = (card && card.querySelector('.ProductPrice') && card.querySelector('.ProductPrice').textContent.trim()) || '';
        var link     = (card && card.href) || '';
        var category = (card && card.dataset.category) || (card && card.querySelector('.ProductBadge') && card.querySelector('.ProductBadge').textContent.trim()) || '';

        if (isInWishlist(name)) {
            removeFromWishlist(name);
            btn.classList.remove('active');
            btn.innerHTML = '&#9825;';
            showWishlistToast(name + ' removed from wishlist');
        } else {
            addToWishlist({ name: name, price: price, image: image, link: link, category: category });
            btn.classList.add('active');
            btn.innerHTML = '&#9829;';
            showWishlistToast(name + ' added to wishlist');
        }
    };

    /** Set the active (filled-heart) state for every .WishlistBtn on the current page. */
    function initWishlistButtons() {
        document.querySelectorAll('.WishlistBtn').forEach(function (btn) {
            var card = btn.closest('.ProductCard');
            if (!card) return;
            var name = card.dataset.name || (card.querySelector('.ProductTitle') && card.querySelector('.ProductTitle').textContent.trim()) || '';
            if (name && isInWishlist(name)) {
                btn.classList.add('active');
                btn.innerHTML = '&#9829;';
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initWishlistButtons);
    } else {
        initWishlistButtons();
    }

    /** Shared API for pages that need direct wishlist control (e.g. product detail). */
    window.wishlist = {
        getWishlist: getWishlist,
        isInWishlist: isInWishlist,
        addToWishlist: addToWishlist,
        removeFromWishlist: removeFromWishlist,
        showToast: showWishlistToast
    };
})();

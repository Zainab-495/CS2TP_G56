<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout &ndash; Skyrose Atelier</title>
    @include('partials.head')
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <h1>Checkout</h1>
            <div id="checkout-items"></div>
            <button id="placeOrderBtn">Place Order</button>
        </div>

        @include('partials.footer')
    </div>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/cart/data', { credentials: 'include' })
            .then(r => r.json())
            .then(cart => {
                const c = document.getElementById('checkout-items');
                if (!cart.items || !cart.items.length) {
                    c.innerHTML = '<p>Your cart is empty.</p>';
                    return;
                }
                cart.items.forEach(i => {
                    c.innerHTML += `<p>${i.name} &times; ${i.quantity} - &pound;${i.price}</p>`;
                });
            });

        document.getElementById('placeOrderBtn').onclick = () => {
            fetch('/cart/place-order', {
                method: 'POST',
                credentials: 'include',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' }
            })
            .then(() => { alert('Order placed!'); window.location = '/'; });
        };
    </script>
</body>
</html>



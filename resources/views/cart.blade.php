<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Basket &ndash; Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .CartPage { max-width: 1200px; margin: 80px auto; padding: 0 20px; }
        .CartTitle { font-size: 36px; font-weight: 700; margin-bottom: 40px; color: #1a1a1a; }
        .CartContainer { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }
        .CartItems { background: #fff; }
        .EmptyCart { text-align: center; padding: 60px 20px; background: #f9f9f9; border-radius: 8px; }
        .EmptyCart p { font-size: 18px; color: #666; margin-bottom: 20px; }
        .EmptyCart a {
            display: inline-block;
            padding: 12px 28px;
            background: #111;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: background 0.3s;
        }
        .EmptyCart a:hover { background: #333; }
        .CartItem {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }
        .CartItem:last-child { border-bottom: none; }
        .ItemInfo h3 { font-size: 16px; font-weight: 600; margin: 0 0 10px 0; color: #1a1a1a; }
        .ItemPrice { font-size: 14px; color: #666; margin-bottom: 10px; }
        .QuantityControl { display: flex; align-items: center; border: 1px solid #ddd; border-radius: 4px; width: fit-content; }
        .QuantityControl button { background: #f5f5f5; border: none; padding: 8px 12px; cursor: pointer; font-weight: 600; transition: background 0.2s; }
        .QuantityControl button:hover { background: #e0e0e0; }
        .QuantityControl select { width: 80px; text-align: center; border: none; border-left: 1px solid #ddd; border-right: 1px solid #ddd; padding: 8px; font-weight: 600; background: white; appearance: none; }
        .ItemSubtotal { font-size: 16px; font-weight: 600; color: #1a1a1a; text-align: right; }
        .RemoveBtn { padding: 8px 12px; background: #ff6b6b; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; transition: background 0.2s; }
        .RemoveBtn:hover { background: #ff5252; }
        .CartSummary { position: sticky; top: 100px; background: #f9f9f9; padding: 30px; border-radius: 8px; height: fit-content; }
        .SummaryTitle { font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #1a1a1a; }
        .SummaryRow { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; color: #666; }
        .SummaryRow.total { border-top: 1px solid #ddd; padding-top: 12px; margin-top: 12px; font-size: 18px; font-weight: 700; color: #1a1a1a; }
        .CheckoutBtn { width: 100%; padding: 14px; background: #111; color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 20px; transition: background 0.3s; }
        .CheckoutBtn:hover { background: #333; }
        .ContinueShoppingBtn { width: 100%; padding: 12px; background: transparent; color: #111; border: 1px solid #111; border-radius: 4px; font-size: 14px; font-weight: 600; cursor: pointer; margin-top: 10px; transition: all 0.3s; }
        .ContinueShoppingBtn:hover { background: #111; color: white; }
        @media (max-width: 768px) {
            .CartContainer { grid-template-columns: 1fr; }
            .CartItem { grid-template-columns: 1fr; gap: 12px; }
            .ItemSubtotal, .RemoveBtn { text-align: left; }
            .CartSummary { position: static; }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="CartPage">
                <h1 class="CartTitle">Shopping Basket</h1>
                <div class="CartContainer">
                    <div class="CartItems" id="cartItems"></div>
                    <div class="CartSummary" id="cartSummary" style="display:none;">
                        <h2 class="SummaryTitle">Order Summary</h2>
                        <div class="SummaryRow">
                            <span>Subtotal:</span>
                            <span>&pound;<span id="subtotalPrice">0.00</span></span>
                        </div>
                        <div class="SummaryRow">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <div class="SummaryRow total">
                            <span>Total:</span>
                            <span>&pound;<span id="totalPrice">0.00</span></span>
                        </div>
                        <button type="button" class="CheckoutBtn" onclick="proceedToCheckout()">Proceed to Checkout</button>
                        <a href="/products"><button type="button" class="ContinueShoppingBtn">Continue Shopping</button></a>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let cart = [];

        renderEmptyCart();

        function loadCart() {
            fetch('/cart/data', { credentials: 'include' })
                .then(r => r.json())
                .then(data => { cart = data.items || []; renderCart(); updateCartCount(); })
                .catch(err => { console.error('Error loading cart:', err); renderEmptyCart(); });
        }

        function renderCart() {
            const container = document.getElementById('cartItems');
            const summary = document.getElementById('cartSummary');
            if (!cart || cart.length === 0) {
                renderEmptyCart();
                summary.style.display = 'block';
                document.getElementById('subtotalPrice').textContent = '0.00';
                document.getElementById('totalPrice').textContent = '0.00';
                return;
            }
            summary.style.display = 'block';
            let html = '', total = 0;
            cart.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                total += subtotal;
                const quantityOptions = [1,2,3,4,5,10,25,50,100];
                const optionsHtml = quantityOptions.map(q => `<option value="${q}" ${q===item.quantity?'selected':''}>${q}</option>`).join('');
                const ensureCurrent = quantityOptions.includes(item.quantity) ? '' : `<option value="${item.quantity}" selected>${item.quantity}</option>`;
                html += `
                    <div class="CartItem">
                        <div class="ItemInfo">
                            <h3>${item.name}</h3>
                            <div class="ItemPrice">&pound;${parseFloat(item.price).toFixed(2)} per item</div>
                        </div>
                        <div class="QuantityControl">
                            <button type="button" onclick="updateQuantity(${index}, ${item.quantity-1})">&minus;</button>
                            <select onchange="handleQuantityChange(${index}, this.value)">${ensureCurrent}${optionsHtml}</select>
                            <button type="button" onclick="updateQuantity(${index}, ${item.quantity+1})">+</button>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;">
                            <div class="ItemSubtotal">&pound;${subtotal.toFixed(2)}</div>
                            <button type="button" class="RemoveBtn" onclick="removeItem(${index})">Remove</button>
                        </div>
                    </div>`;
            });
            container.innerHTML = html;
            document.getElementById('subtotalPrice').textContent = total.toFixed(2);
            document.getElementById('totalPrice').textContent = total.toFixed(2);
        }

        function renderEmptyCart() {
            document.getElementById('cartItems').innerHTML = `
                <div class="EmptyCart">
                    <p>Your basket is empty</p>
                    <a href="/products">Continue Shopping</a>
                </div>`;
            const summary = document.getElementById('cartSummary');
            if (summary) {
                summary.style.display = 'block';
                document.getElementById('subtotalPrice').textContent = '0.00';
                document.getElementById('totalPrice').textContent = '0.00';
            }
        }

        function handleQuantityChange(index, value) {
            const parsed = parseInt(value, 10);
            if (!isFinite(parsed) || parsed < 1) return;
            updateQuantity(index, parsed);
        }

        function updateQuantity(index, newQuantity) {
            if (newQuantity < 1) { removeItem(index); return; }
            fetch('/cart/update', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF},
                credentials: 'include',
                body: JSON.stringify({index: index, quantity: newQuantity})
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { cart[index].quantity = newQuantity; renderCart(); }
                else alert('Error updating quantity: ' + (data.error || 'Unknown error'));
            })
            .catch(err => { console.error(err); alert('Error updating quantity'); });
        }

        function removeItem(index) {
            fetch('/cart/remove', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF},
                credentials: 'include',
                body: JSON.stringify({index: index})
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { cart.splice(index, 1); renderCart(); updateCartCount(); }
                else alert('Error removing item: ' + (data.error || 'Unknown error'));
            })
            .catch(err => { console.error(err); alert('Error removing item'); });
        }

        function updateCartCount() {
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            const el = document.getElementById('cart-count');
            if (el) el.textContent = count;
        }

        function proceedToCheckout() {
            if (cart.length === 0) { alert('Your basket is empty'); return; }
            window.location.href = '/checkout';
        }

        loadCart();
    </script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout &ndash; Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .CheckoutPage { max-width: 1100px; margin: 60px auto; padding: 0 20px 60px; }
        .CheckoutPage > h1 { font-size: 36px; font-weight: 700; color: #1a1a1a; margin-bottom: 36px; }
        .CheckoutGrid { display: grid; grid-template-columns: 3fr 2fr; gap: 40px; align-items: start; }
        /* Left: Form */
        .CheckoutForm { display: flex; flex-direction: column; gap: 24px; }
        .FormSection { background: #fff; border: 1px solid #e8e0d0; border-radius: 8px; padding: 28px; }
        .FormSection h2 { font-size: 16px; font-weight: 700; color: #1a1a1a; margin: 0 0 18px 0; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        .FormGroup { margin-bottom: 14px; }
        .FormGroup:last-child { margin-bottom: 0; }
        .FormGroup label { display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #555; margin-bottom: 6px; }
        .FormGroup input, .FormGroup select, .FormGroup textarea {
            width: 100%; padding: 10px 14px; border: 1px solid #ddd; border-radius: 6px;
            font-size: 14px; color: #111; box-sizing: border-box; background: white; transition: border-color 0.2s;
        }
        .FormGroup input:focus, .FormGroup select:focus, .FormGroup textarea:focus { outline: none; border-color: #d4af37; box-shadow: 0 0 0 3px rgba(212,175,55,0.12); }
        .FormGroup textarea { resize: vertical; min-height: 80px; }
        .PaymentOptions { display: flex; flex-direction: column; gap: 10px; }
        .PaymentOption { display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid #ddd; border-radius: 6px; cursor: pointer; transition: border-color 0.2s; }
        .PaymentOption:hover { border-color: #d4af37; }
        .PaymentOption input[type="radio"] { accent-color: #d4af37; width: 16px; height: 16px; flex-shrink: 0; }
        .PaymentOption span { font-size: 14px; color: #333; }
        /* Right: Summary */
        .CheckoutSummary { position: sticky; top: 100px; }
        .SummaryCard { background: #f9f6f0; border: 1px solid #e8e0d0; border-radius: 8px; padding: 28px; }
        .SummaryCard h2 { font-size: 16px; font-weight: 700; color: #1a1a1a; margin: 0 0 18px 0; padding-bottom: 10px; border-bottom: 1px solid #e0d8c8; }
        .SummaryItems { margin-bottom: 16px; }
        .SummaryItem { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333; }
        .SummaryItem:last-child { border-bottom: none; }
        .SummaryItemName { flex: 1; padding-right: 10px; }
        .SummaryItemQty { color: #888; font-size: 12px; }
        .SummaryItemPrice { font-weight: 600; white-space: nowrap; }
        .SummaryDivider { border: none; border-top: 1px solid #e0d8c8; margin: 12px 0; }
        .SummaryRow { display: flex; justify-content: space-between; font-size: 14px; color: #555; margin-bottom: 8px; }
        .SummaryRow.total { font-size: 18px; font-weight: 700; color: #1a1a1a; margin-top: 12px; padding-top: 12px; border-top: 2px solid #d4af37; }
        .PlaceOrderBtn {
            width: 100%; padding: 15px; background: #111; color: white; border: none;
            border-radius: 6px; font-size: 16px; font-weight: 700; cursor: pointer;
            margin-top: 20px; transition: background 0.3s; letter-spacing: 0.5px;
        }
        .PlaceOrderBtn:hover:not(:disabled) { background: #333; }
        .PlaceOrderBtn:disabled { background: #aaa; cursor: not-allowed; }
        .EmptyCartMsg { text-align: center; padding: 40px 20px; }
        .EmptyCartMsg p { font-size: 16px; color: #666; margin-bottom: 16px; }
        .EmptyCartMsg a { color: #d4af37; text-decoration: none; font-weight: 600; }
        .Toast { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); background: #111; color: #fff; padding: 12px 24px; border-radius: 4px; font-size: 14px; z-index: 9999; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        .LoadingText { color: #888; font-size: 14px; padding: 20px 0; }
        @media (max-width: 768px) { .CheckoutGrid { grid-template-columns: 1fr; } .CheckoutSummary { position: static; } }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="CheckoutPage">
                <h1>Checkout</h1>

                <div id="emptyMsg" style="display:none;" class="EmptyCartMsg">
                    <p>Your basket is empty.</p>
                    <a href="{{ route('products.index') }}">&larr; Continue Shopping</a>
                </div>

                <div class="CheckoutGrid" id="checkoutGrid">
                    {{-- Left: form --}}
                    <div class="CheckoutForm">
                        <div class="FormSection">
                            <h2>Shipping Address</h2>
                            <div class="FormGroup">
                                <label for="shipping_address">Full Delivery Address</label>
                                <textarea id="shipping_address" placeholder="e.g. 12 Rose Lane, Birmingham, B1 2AB" required></textarea>
                            </div>
                        </div>

                        <div class="FormSection">
                            <h2>Payment Method</h2>
                            <div class="PaymentOptions">
                                <label class="PaymentOption">
                                    <input type="radio" name="payment_method" value="credit_card" checked>
                                    <span>Credit Card</span>
                                </label>
                                <label class="PaymentOption">
                                    <input type="radio" name="payment_method" value="debit_card">
                                    <span>Debit Card</span>
                                </label>
                                <label class="PaymentOption">
                                    <input type="radio" name="payment_method" value="paypal">
                                    <span>PayPal</span>
                                </label>
                            </div>
                        </div>

                        <div class="FormSection">
                            <h2>Order Notes <span style="font-weight:400;color:#888;">(optional)</span></h2>
                            <div class="FormGroup">
                                <label for="notes">Special instructions or gift message</label>
                                <textarea id="notes" placeholder="Leave blank if none"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Right: summary --}}
                    <div class="CheckoutSummary">
                        <div class="SummaryCard">
                            <h2>Order Summary</h2>
                            <div class="SummaryItems" id="summaryItems">
                                <p class="LoadingText">Loading your basket&hellip;</p>
                            </div>
                            <hr class="SummaryDivider">
                            <div class="SummaryRow">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            <div class="SummaryRow total">
                                <span>Total</span>
                                <span>&pound;<span id="totalPrice">0.00</span></span>
                            </div>
                            <button class="PlaceOrderBtn" id="placeOrderBtn" disabled>Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>

    <div class="Toast" id="toast"></div>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg; t.style.opacity = 1;
            setTimeout(() => t.style.opacity = 0, 3500);
        }

        // Load cart items into summary panel
        fetch('/cart/data', { credentials: 'include' })
            .then(r => r.json())
            .then(cart => {
                const items = cart.items || [];
                const container = document.getElementById('summaryItems');

                if (!items.length) {
                    document.getElementById('checkoutGrid').style.display = 'none';
                    document.getElementById('emptyMsg').style.display = 'block';
                    return;
                }

                let html = '';
                let subtotal = 0;
                items.forEach(item => {
                    const lineTotal = item.price * item.quantity;
                    subtotal += lineTotal;
                    html += `<div class="SummaryItem">
                        <div class="SummaryItemName">
                            ${item.name}
                            <span class="SummaryItemQty"> &times; ${item.quantity}</span>
                        </div>
                        <span class="SummaryItemPrice">&pound;${lineTotal.toFixed(2)}</span>
                    </div>`;
                });
                container.innerHTML = html;
                document.getElementById('totalPrice').textContent = subtotal.toFixed(2);
                document.getElementById('placeOrderBtn').disabled = false;
            })
            .catch(() => {
                document.getElementById('summaryItems').innerHTML = '<p style="color:#b91c1c;font-size:13px;">Could not load basket.</p>';
            });

        // Place order
        document.getElementById('placeOrderBtn').addEventListener('click', () => {
            const address = document.getElementById('shipping_address').value.trim();
            const payment = document.querySelector('input[name="payment_method"]:checked').value;
            const notes   = document.getElementById('notes').value.trim();

            if (!address) {
                showToast('Please enter a shipping address.');
                document.getElementById('shipping_address').focus();
                return;
            }

            const btn = document.getElementById('placeOrderBtn');
            btn.disabled = true;
            btn.textContent = 'Placing Order…';

            fetch('/checkout', {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: JSON.stringify({ shipping_address: address, payment_method: payment, notes })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    showToast('Order placed! Redirecting…');
                    setTimeout(() => window.location = '/orders', 1500);
                } else {
                    showToast('Error: ' + (data.error || 'Could not place order.'));
                    btn.disabled = false;
                    btn.textContent = 'Place Order';
                }
            })
            .catch(() => {
                showToast('A network error occurred. Please try again.');
                btn.disabled = false;
                btn.textContent = 'Place Order';
            });
        });
    </script>
</body>
</html>
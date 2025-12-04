document.addEventListener('DOMContentLoaded', () => {
    loadCart();
});

function loadCart() {
    fetch('api/get-cart.php')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('cart-items');
            const totalEl = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');

            if (!container || !totalEl || !checkoutBtn) return;

            if (!data.items || data.items.length === 0) {
                container.innerHTML = '<p class="text-center text-gray-600 text-lg">Your cart is empty</p>';
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
                return;
            }

            checkoutBtn.disabled = false;
            checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');

            container.innerHTML = '';
            data.items.forEach(item => {
                container.innerHTML += `
                    <div class="bg-white p-4 rounded-lg shadow flex items-center gap-4">
                        <img src="${item.image}" class="w-24 h-24 object-cover rounded" alt="${item.name}">
                        <div class="flex-1">
                            <h3 class="font-bold text-lg">${item.name}</h3>
                            <p class="text-gray-600">£${parseFloat(item.price).toFixed(2)} x ${item.quantity}</p>
                            <p class="text-yellow-600 font-bold">Subtotal: £${parseFloat(item.subtotal).toFixed(2)}</p>
                        </div>
                        <button 
                            onclick="removeItem(${item.cart_id})" 
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                        >
                            Remove
                        </button>
                    </div>
                `;
            });

            totalEl.textContent = '£' + parseFloat(data.total).toFixed(2);
        })
        .catch(err => {
            console.error('Error loading cart:', err);
            const container = document.getElementById('cart-items');
            if (container) {
                container.innerHTML = '<p class="text-center text-red-600 text-lg">Error loading cart.</p>';
            }
        });
}

function removeItem(cartId) {
    fetch('api/remove-from-cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ cartId: cartId })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadCart();
            } else {
                alert(data.error || 'Failed to remove item.');
            }
        })
        .catch(err => {
            console.error('Error removing item:', err);
            alert('Failed to remove item.');
        });
}

function proceedToCheckout() {
    fetch('api/check-auth.php')
        .then(res => res.json())
        .then(data => {
            if (data.loggedIn) {
                // Mock checkout
                return fetch('api/checkout.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ paymentMethod: 'mock' })
                })
                    .then(res => res.json())
                    .then(result => {
                        if (result.success) {
                            alert(`Order #${result.orderId} placed successfully! Total: £${result.total.toFixed(2)}`);
                            window.location.href = 'index.html';
                        } else {
                            alert(result.error || 'Checkout failed.');
                        }
                    });
            } else {
                alert('Please login to checkout');
                window.location.href = 'login.html?redirect=cart';
            }
        })
        .catch(err => {
            console.error('Error during checkout auth check:', err);
            alert('Something went wrong. Please try again.');
        });
}

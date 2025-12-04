// Check auth status
fetch('api/check-auth.php')
    .then(res => res.json())
    .then(data => {
        const authDiv = document.getElementById('auth-buttons');
        if (!authDiv) return;

        if (data.loggedIn) {
            authDiv.innerHTML = `
                <span class="text-sm">Hello, ${data.username}</span>
                <button onclick="logout()" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm">Logout</button>
            `;
        } else {
            authDiv.innerHTML = `
                <a href="login.html" class="bg-gold hover:bg-dark-gold px-4 py-2 rounded text-sm">Login</a>
                <a href="register.html" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded text-sm">Register</a>
            `;
        }
    })
    .catch(err => {
        console.error('Auth check error:', err);
    });

// Load cart count
fetch('api/get-cart.php')
    .then(res => res.json())
    .then(data => {
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = data.count || 0;
        }
    })
    .catch(err => {
        console.error('Cart load error:', err);
    });

// Load products
fetch('api/get-products.php')
    .then(res => res.json())
    .then(products => {
        const loading = document.getElementById('loading');
        const container = document.getElementById('products-container');

        if (loading) loading.style.display = 'none';
        if (!container) return;

        if (products.error) {
            container.innerHTML = `
                <div class="col-span-full text-center text-red-600 text-lg">
                    ${products.error}
                </div>`;
            return;
        }

        if (!products.length) {
            container.innerHTML = `
                <div class="col-span-full text-center text-gray-600 text-lg">
                    No products available
                </div>`;
            return;
        }

        products.forEach(product => {
            const stockClass = product.quantity < 10 ? 'text-red-500' : 'text-green-600';
            const stockText = product.quantity > 0 ? `In Stock: ${product.quantity}` : 'Out of Stock';
            const buttonDisabled = product.quantity === 0
                ? 'opacity-50 cursor-not-allowed'
                : 'hover:bg-dark-gold transform hover:scale-105';

            const productCard = document.createElement('div');
            productCard.className = 'bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2';

            productCard.innerHTML = `
                <div class="relative">
                    <img src="${product.image}" alt="${product.name}" class="w-full h-64 object-cover">
                    <span class="absolute top-4 left-4 bg-gray-900 text-white px-3 py-1 rounded-full text-sm font-medium">
                        ${product.category}
                    </span>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">${product.name}</h3>
                    <p class="text-gray-600 text-sm mb-4">${product.description}</p>

                    <div class="flex items-center justify-between mb-4">
                        <span class="${stockClass} text-sm font-semibold">${stockText}</span>
                        <span class="text-gold text-2xl font-bold">£${parseFloat(product.price).toFixed(2)}</span>
                    </div>

                    <button 
                        onclick="addToCart(${product.id}, '${product.name.replace(/'/g, "\\'")}')" 
                        class="w-full bg-gold text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 ${buttonDisabled}"
                        ${product.quantity === 0 ? 'disabled' : ''}
                    >
                        ${product.quantity === 0 ? 'Out of Stock' : 'Add to Cart'}
                    </button>
                </div>
            `;

            container.appendChild(productCard);
        });
    })
    .catch(err => {
        const loading = document.getElementById('loading');
        if (loading) {
            loading.innerHTML = '<div class="text-center text-red-600 text-lg">Error loading products.</div>';
        }
        console.error('Products load error:', err);
    });

function addToCart(productId, productName) {
    fetch('api/add-to-cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ productId: productId, quantity: 1 })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showNotification(`✓ Added "${productName}" to cart!`, 'success');
                // Update cart count
                return fetch('api/get-cart.php')
                    .then(res => res.json())
                    .then(cart => {
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount) {
                            cartCount.textContent = cart.count || 0;
                        }
                    });
            } else {
                showNotification(data.error || 'Failed to add to cart', 'error');
            }
        })
        .catch(err => {
            console.error('Add to cart error:', err);
            showNotification('Failed to add to cart', 'error');
        });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `
        fixed top-4 right-4
        ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}
        text-white px-6 py-4 rounded-lg shadow-lg z-50
    `;
    notification.textContent = message;

    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}

function logout() {
    fetch('api/logout.php')
        .then(() => window.location.reload())
        .catch(err => console.error('Logout error:', err));
}

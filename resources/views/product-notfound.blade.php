<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <style>
        .ProductDetail {
            display: flex;
            gap: 40px;
            max-width: 1000px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .ProductDetailImage {
            flex: 1;
            min-width: 300px;
        }

        .ProductDetailImage img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            max-height: 500px;
        }

        .ProductDetailInfo {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .ProductTitle {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            color: #222;
        }

        .ProductCategory {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .ProductPrice {
            font-size: 28px;
            font-weight: 600;
            color: #111;
        }

        .ProductDescription {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .StockInfo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .StockBadge {
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 600;
            background: #e8f5e9;
            color: #2e7d32;
        }

        .StockBadge.low-stock {
            background: #fff3e0;
            color: #e65100;
        }

        .StockBadge.out-of-stock {
            background: #ffebee;
            color: #c62828;
        }

        .QuantitySection {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
        }

        .QuantityLabel {
            font-weight: 600;
            font-size: 14px;
        }

        .QuantityControl {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .QuantityControl button {
            background: #f5f5f5;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .QuantityControl button:hover {
            background: #e0e0e0;
        }

        .QuantityControl input {
            width: 50px;
            text-align: center;
            border: none;
            padding: 8px;
            font-size: 16px;
            font-weight: 600;
        }

        .AddToCartSection {
            display: flex;
            gap: 12px;
            margin: 30px 0;
        }

        .AddToCartButton {
            flex: 1;
            padding: 16px 24px;
            background: #111;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .AddToCartButton:hover:not(:disabled) {
            background: #333;
        }

        .AddToCartButton:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .BuyNowButton {
            flex: 1;
            padding: 16px 24px;
            background: #fff;
            color: #111;
            border: 2px solid #111;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .BuyNowButton:hover {
            background: #111;
            color: white;
        }

        .SuccessMessage {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px 16px;
            border-radius: 4px;
            text-align: center;
            font-weight: 600;
            display: none;
            margin: 15px 0;
        }

        .ErrorMessage {
            background: #ffebee;
            color: #c62828;
            padding: 12px 16px;
            border-radius: 4px;
            text-align: center;
            font-weight: 600;
            display: none;
            margin: 15px 0;
        }

        .ProductDetails {
            border-top: 1px solid #eee;
            padding-top: 30px;
            margin-top: 30px;
        }

        .DetailsGrid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .DetailItem {
            padding: 15px;
            background: #f9f9f9;
            border-radius: 6px;
        }

        .DetailLabel {
            font-size: 12px;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .DetailValue {
            font-size: 16px;
            color: #222;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .ProductDetail {
                flex-direction: column;
                gap: 30px;
                margin: 30px auto;
            }

            .ProductTitle {
                font-size: 24px;
            }

            .ProductPrice {
                font-size: 22px;
            }

            .AddToCartSection {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            <!-- Top Navigation -->
            <div class="TopNav">
                <a class="logo-link" href="/" aria-label="Skyrose Atelier home"><img class="header-logo" src="{{ asset('images/logo Skyrose.jpg') }}" alt="Skyrose Atelier logo"></a>
                <a href="/">Home</a>
                <a href="/about">About</a>
                <a href="/products">Products</a>
                <a href="/contact">Contact</a>
                <div class="IconNav">
                    <a class="NavSearch" href="/products#searchInput" aria-label="Search"><img src="{{ asset('images/SearchIcon.png') }}" alt="Search"></a>
                    <div id="auth-buttons">
                        <a href="/login" aria-label="Login"><img src="{{ asset('images/ProfileIcon.png') }}" alt="Profile"></a>
                        <a href="/cart" aria-label="Cart"><img src="{{ asset('images/CartIcon.png') }}" alt="Cart"><span id="cart-count">0</span></a>
                    </div>
                </div>
            </div>

            <!-- Breadcrumb Navigation -->
            <div style="padding: 20px; border-bottom: 1px solid #eee;">
                <a href="/products" style="color: #0066cc; text-decoration: none;">All Products</a>
                <span style="color: #999; margin: 0 10px;">/</span>
                <span id="breadcrumbName" style="color: #666;">Product Name</span>
            </div>

            <!-- Product Detail Section -->
            <div class="ProductDetail">
                <div class="ProductDetailImage">
                    <img id="productImage" src="" alt="Product Image">
                </div>

                <div class="ProductDetailInfo">
                    <div class="ProductCategory" id="productCategory">Category</div>
                    <h1 class="ProductTitle" id="productName">Product Name</h1>
                    
                    <div class="ProductPrice" id="productPrice">£0.00</div>

                    <div class="StockInfo">
                        <span class="StockBadge" id="stockBadge">In Stock</span>
                        <span id="stockText">100 items available</span>
                    </div>

                    <p class="ProductDescription" id="productDescription">Product description goes here.</p>

                    <div class="QuantitySection">
                        <label class="QuantityLabel">Quantity:</label>
                        <div class="QuantityControl">
                            <button onclick="decrementQuantity()">−</button>
                            <input type="number" id="quantityInput" min="1" max="100" value="1" readonly>
                            <button onclick="incrementQuantity()">+</button>
                        </div>
                    </div>

                    <div class="SuccessMessage" id="successMessage">✓ Added to cart successfully!</div>
                    <div class="ErrorMessage" id="errorMessage"></div>

                    <div class="AddToCartSection">
                        <button class="AddToCartButton" id="addToCartBtn" onclick="addToCart()">Add to Cart</button>
                        <button class="BuyNowButton" onclick="buyNow()">Buy Now</button>
                    </div>

                    <div class="ProductDetails">
                        <h3 style="margin-bottom: 20px; font-size: 18px;">Product Information</h3>
                        <div class="DetailsGrid">
                            <div class="DetailItem">
                                <div class="DetailLabel">SKU</div>
                                <div class="DetailValue" id="productSKU">SKU-001</div>
                            </div>
                            <div class="DetailItem">
                                <div class="DetailLabel">Availability</div>
                                <div class="DetailValue" id="productAvailability">In Stock</div>
                            </div>
                            <div class="DetailItem">
                                <div class="DetailLabel">Category</div>
                                <div class="DetailValue" id="productCategoryDetail">Jewelry</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="text-align: center; padding: 40px 20px;">
                <a href="/products" style="color: #0066cc; text-decoration: none; font-weight: 600;">← Continue Shopping</a>
            </div>
        </div>

        <!-- Footer -->
        <div id="site-footer">
            <footer class="footer">
                <div class="FooterIconsContainer">
                    <img src="{{ asset('images/FacebookIcon.png') }}" class="FooterIcons" alt="facebook">
                    <img src="{{ asset('images/InstagramIcon.png') }}" class="FooterIcons" alt="instagram">
                    <img src="{{ asset('images/YoutubeIcon.png') }}" class="FooterIcons" alt="youtube">
                </div>
                <p class="ContactTitle">© 2025 Luxury Jewelry Store</p>
            </footer>
        </div>
        <script src="{{ asset('js/index.js') }}" defer></script>
    </div>

    <script>
        // Product database with all 25 items
        const products = {
            'buta-ring': {
                name: 'Buta Ring',
                price: 185,
                category: 'Rings',
                image: 'assets/images/ButaRing.png',
                description: 'A beautifully detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.',
                stock: 100,
                sku: 'RING-001'
            },
            'saphire-ring': {
                name: 'Saphire Ring',
                price: 420,
                category: 'Rings',
                image: 'assets/images/saphire-ring.jpg',
                description: 'A beautifully Sapphire blue ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.',
                stock: 100,
                sku: 'RING-002'
            },
            'rose-gold-ring': {
                name: 'Rose Gold Ring',
                price: 385,
                category: 'Rings',
                image: 'assets/images/rose-gold.jpg',
                description: 'A beautifully Rose gold golden detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.',
                stock: 100,
                sku: 'RING-003'
            },
            'vintage-ring': {
                name: 'Vintage Ring',
                price: 650,
                category: 'Rings',
                image: 'assets/images/vintage-ring.jpg',
                description: 'A vintage-inspired ring with timeless elegance. Handcrafted from ethically sourced materials with intricate detailing.',
                stock: 100,
                sku: 'RING-004'
            },
            'diamond-ring': {
                name: 'Diamond Ring',
                price: 550,
                category: 'Rings',
                image: 'assets/images/diamond-ring.jpg',
                description: 'A dazzling diamond ring that captures the essence of luxury and elegance. Handcrafted from ethically sourced materials with intricate detailing.',
                stock: 100,
                sku: 'RING-005'
            },
            'threadbare-earrings': {
                name: 'Threadbare Earrings',
                price: 120,
                category: 'Earrings',
                image: 'assets/images/ThreadbareEarrings.png',
                description: 'Lightweight, elegant earrings for everyday wear. Perfect complement to any outfit with subtle elegance.',
                stock: 100,
                sku: 'EARR-001'
            },
            'diamond-earrings': {
                name: 'Diamond Earrings',
                price: 480,
                category: 'Earrings',
                image: 'assets/images/diamond-earring.jpg',
                description: 'Stunning diamond earrings that add a touch of luxury and sparkle to any ensemble.',
                stock: 100,
                sku: 'EARR-002'
            },
            'gold-hoop': {
                name: 'Gold Hoop',
                price: 195,
                category: 'Earrings',
                image: 'assets/images/gold-hoop.jpg',
                description: 'Classic gold hoop earrings with timeless appeal. Perfect for any occasion.',
                stock: 100,
                sku: 'EARR-003'
            },
            'pearl-drop': {
                name: 'Pearl Drop',
                price: 275,
                category: 'Earrings',
                image: 'assets/images/pearl-drop.jpg',
                description: 'Elegant pearl drop earrings that exude sophistication and grace.',
                stock: 100,
                sku: 'EARR-004'
            },
            'silver-stud': {
                name: 'Silver Stud',
                price: 145,
                category: 'Earrings',
                image: 'assets/images/silver-stud.jpg',
                description: 'Minimalist silver stud earrings perfect for everyday wear.',
                stock: 100,
                sku: 'EARR-005'
            },
            'bleeding-heart-bracelet': {
                name: 'Bleeding Heart Bracelet',
                price: 245,
                category: 'Bracelets',
                image: 'assets/images/BleedingHeartBracelet.png',
                description: 'A unique and artistic bracelet with a bleeding heart design. Perfect statement piece.',
                stock: 100,
                sku: 'BRAC-001'
            },
            'gold-bangle': {
                name: 'Gold Bangle',
                price: 380,
                category: 'Bracelets',
                image: 'assets/images/gold-bangle.jpg',
                description: 'Classic gold bangle bracelet with elegant finish.',
                stock: 100,
                sku: 'BRAC-002'
            },
            'cuban-bracelet': {
                name: 'Cuban Bracelet',
                price: 520,
                category: 'Bracelets',
                image: 'assets/images/cuban-bracelet.jpg',
                description: 'Bold and stylish Cuban link bracelet for the fashion-forward.',
                stock: 100,
                sku: 'BRAC-003'
            },
            'charm-bracelet': {
                name: 'Charm Bracelet',
                price: 310,
                category: 'Bracelets',
                image: 'assets/images/charm-bracelet.jpg',
                description: 'Versatile charm bracelet with room for your favorite charms.',
                stock: 100,
                sku: 'BRAC-004'
            },
            'leather-bracelet': {
                name: 'Leather Bracelet',
                price: 175,
                category: 'Bracelets',
                image: 'assets/images/leather-bracelet.jpg',
                description: 'Premium leather bracelet with subtle metal accents.',
                stock: 100,
                sku: 'BRAC-005'
            },
            'signature-necklace': {
                name: 'Signature Necklace',
                price: 380,
                category: 'Necklaces',
                image: 'assets/images/HandCraftedJewellry.png',
                description: 'Our signature handcrafted necklace with intricate detailing.',
                stock: 100,
                sku: 'NECK-001'
            },
            'diamond-choker': {
                name: 'Diamond Choker',
                price: 720,
                category: 'Necklaces',
                image: 'assets/images/diamond-choker.jpg',
                description: 'Luxurious diamond choker necklace for special occasions.',
                stock: 100,
                sku: 'NECK-002'
            },
            'pearl-necklace': {
                name: 'Pearl Necklace',
                price: 420,
                category: 'Necklaces',
                image: 'assets/images/pearl-necklace.jpg',
                description: 'Elegant pearl necklace with a timeless appeal.',
                stock: 100,
                sku: 'NECK-003'
            },
            'gold-necklace': {
                name: 'Gold Necklace',
                price: 540,
                category: 'Necklaces',
                image: 'assets/images/gold-necklace.jpg',
                description: 'Beautiful gold necklace perfect for any occasion.',
                stock: 100,
                sku: 'NECK-004'
            },
            'layered-necklace': {
                name: 'Layered Necklace',
                price: 340,
                category: 'Necklaces',
                image: 'assets/images/layered-necklace.jpg',
                description: 'Trendy layered necklace with multiple chains.',
                stock: 100,
                sku: 'NECK-005'
            },
            'gold-watch': {
                name: 'Gold Watch',
                price: 650,
                category: 'Watches',
                image: 'assets/images/gold-watch.jpg',
                description: 'Elegant gold watch combining luxury and functionality.',
                stock: 100,
                sku: 'WATCH-001'
            },
            'sport-watch': {
                name: 'Sport Watch',
                price: 290,
                category: 'Watches',
                image: 'assets/images/sport-watch.jpg',
                description: 'Durable sport watch perfect for active lifestyles.',
                stock: 100,
                sku: 'WATCH-002'
            },
            'silver-watch': {
                name: 'Silver Watch',
                price: 410,
                category: 'Watches',
                image: 'assets/images/silver-watch.jpg',
                description: 'Classic silver watch with sophisticated design.',
                stock: 100,
                sku: 'WATCH-003'
            },
            'classic-leather-watch': {
                name: 'Classic Leather Watch',
                price: 350,
                category: 'Watches',
                image: 'assets/images/classic-leather-watch.jpg',
                description: 'Timeless leather watch with automatic movement.',
                stock: 100,
                sku: 'WATCH-004'
            },
            'luxury-watch': {
                name: 'Luxury Watch',
                price: 850,
                category: 'Watches',
                image: 'assets/images/Rolexwatch.jpg',
                description: 'Ultimate luxury watch with precision and style.',
                stock: 100,
                sku: 'WATCH-005'
            }
        };

        let currentProduct = null;

        // Get product from URL parameter
        function getProductFromURL() {
            const params = new URLSearchParams(window.location.search);
            return params.get('product');
        }

        // Load product details
        function loadProductDetails() {
            const productId = getProductFromURL();
            
            if (!productId || !products[productId]) {
                document.querySelector('.ProductDetail').innerHTML = '<p style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">Product not found. <a href="/products">Go back to products</a></p>';
                return;
            }

            currentProduct = products[productId];
            
            // Update page title
            document.title = currentProduct.name + ' | Skyrose Atelier';

            // Update breadcrumb
            document.getElementById('breadcrumbName').textContent = currentProduct.name;

            // Update product details
            document.getElementById('productImage').src = currentProduct.image;
            document.getElementById('productImage').alt = currentProduct.name;
            document.getElementById('productName').textContent = currentProduct.name;
            document.getElementById('productCategory').textContent = currentProduct.category;
            document.getElementById('productPrice').textContent = '£' + currentProduct.price.toLocaleString('en-GB', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('productDescription').textContent = currentProduct.description;
            document.getElementById('productSKU').textContent = currentProduct.sku;
            document.getElementById('productCategoryDetail').textContent = currentProduct.category;

            // Update stock
            const stockBadge = document.getElementById('stockBadge');
            const stockText = document.getElementById('stockText');
            document.getElementById('productAvailability').textContent = currentProduct.stock > 0 ? 'In Stock' : 'Out of Stock';

            if (currentProduct.stock > 20) {
                stockBadge.textContent = 'In Stock';
                stockBadge.className = 'StockBadge';
            } else if (currentProduct.stock > 0) {
                stockBadge.textContent = 'Low Stock';
                stockBadge.className = 'StockBadge low-stock';
            } else {
                stockBadge.textContent = 'Out of Stock';
                stockBadge.className = 'StockBadge out-of-stock';
            }

            stockText.textContent = currentProduct.stock + ' items available';

            // Update quantity input max
            document.getElementById('quantityInput').max = currentProduct.stock;

            // Enable/disable buttons based on stock
            const addBtn = document.getElementById('addToCartBtn');
            const buyBtn = document.querySelector('.BuyNowButton');
            if (currentProduct.stock === 0) {
                addBtn.disabled = true;
                buyBtn.disabled = true;
                addBtn.textContent = 'Out of Stock';
                buyBtn.textContent = 'Out of Stock';
            }
        }

        function incrementQuantity() {
            const input = document.getElementById('quantityInput');
            const currentValue = parseInt(input.value);
            if (currentValue < currentProduct.stock) {
                input.value = currentValue + 1;
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('quantityInput');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }

        function addToCart() {
            const quantity = parseInt(document.getElementById('quantityInput').value);
            const errorMsg = document.getElementById('errorMessage');
            const successMsg = document.getElementById('successMessage');

            errorMsg.style.display = 'none';
            errorMsg.textContent = '';
            successMsg.style.display = 'none';

            if (!currentProduct) {
                errorMsg.textContent = '✗ Product not loaded. Please refresh the page.';
                errorMsg.style.display = 'block';
                console.error('Current product is null');
                return;
            }

            if (!currentProduct.name || currentProduct.price === undefined) {
                errorMsg.textContent = '✗ Product data incomplete.';
                errorMsg.style.display = 'block';
                console.error('Product missing required fields:', currentProduct);
                return;
            }

            const payload = {
                productName: currentProduct.name,
                quantity: quantity,
                price: currentProduct.price
            };

            console.log('Adding to cart:', payload);

            fetch('api/add-to-cart.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(payload)
            })
            .then(r => {
                console.log('Response status:', r.status);
                if (!r.ok) {
                    throw new Error(`HTTP ${r.status}`);
                }
                return r.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.error) {
                    errorMsg.textContent = '✗ ' + data.error;
                    errorMsg.style.display = 'block';
                } else if (data.success) {
                    successMsg.style.display = 'block';
                    document.getElementById('quantityInput').value = 1;
                    
                    // Update cart count if available
                    if (data.cartCount) {
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount) cartCount.textContent = data.cartCount;
                    }

                    // Hide success message after 3 seconds
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                    }, 3000);
                } else {
                    errorMsg.textContent = '✗ Unexpected response from server.';
                    errorMsg.style.display = 'block';
                }
            })
            .catch(err => {
                console.error('Fetch error:', err);
                errorMsg.textContent = '✗ Error adding to cart: ' + err.message;
                errorMsg.style.display = 'block';
            });
        }

        function buyNow() {
            const quantity = parseInt(document.getElementById('quantityInput').value);
            
            fetch('api/add-to-cart.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    productName: currentProduct.name,
                    quantity: quantity,
                    price: currentProduct.price
                })
            })
            .then(r => r.json())
            .then(data => {
                if (!data.error) {
                    window.location.href = 'checkout.html';
                }
            })
            .catch(err => console.error(err));
        }

        // Load product on page load
        loadProductDetails();
    </script>
</body>
</html>




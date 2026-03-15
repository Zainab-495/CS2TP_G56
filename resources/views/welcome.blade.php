<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyrose Atelier</title>
    @vite(['resources/js/app.js'])
</head>
<body>

<header class="navbar">
    <div class="logo">Skyrose Atelier</div>
    <nav>
        <ul class="nav-links">
            <li><a class="active" href="/">Home</a></li>
            <li><a href="/products">Shop</a></li>
            <li><a href="/products">Categories</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- ZAK HERO -->
<section class="hero">
    <div class="container hero-content">
        <h1 class="hero-title">Discover Timeless Elegance</h1>
        <p class="hero-subtitle">Luxury handcrafted jewellery for every occasion.</p>
        <div class="hero-buttons">
            <a href="/products" class="btn-primary">Shop Now</a>
            <a href="/products" class="btn-outline">Explore Collections</a>
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS from ZAK EDIT SHOP -->
<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="product-grid">

            <a href="product.html" class="product-card">
                <img src="assets/images/elegant gold ring.jpg" alt="Gold Ring">
                <h3>Elegant Gold Ring</h3>
                <p class="product-price">$249</p>
            </a>

            <a href="product.html" class="product-card">
                <img src="assets/images/silver necklace.jpg" alt="Silver Necklace">
                <h3>Silver Necklace</h3>
                <p class="product-price">$199</p>
            </a>

            <a href="product.html" class="product-card">
                <img src="assets/images/diamond earrings.jpg" alt="Diamond Earrings">
                <h3>Diamond Earrings</h3>
                <p class="product-price">$349</p>
            </a>

        </div>
    </div>
</section>

<!-- ZAK PART ON OUR STORY -->
<section class="story-section">
    <div class="container">
        <h2>Our Story</h2>
        <p>
            At Skyrose Atelier, we craft timeless jewelry that celebrates elegance, artistry, and individuality. 
            Founded with a passion for design and a commitment to quality, our pieces are carefully handcrafted to bring a touch of sophistication to everyday life.
             Every creation tells a story, blending classic techniques with modern inspiration,
              ensuring that each item is as unique as the person who wears it.
        </p>
    </div>
</section>

<!-- ZAK EDIT FOOTER -->
<footer class="footer">
    <div class="container">
        <p>© 2024 Skyrose Atelier • All Rights Reserved</p>
    </div>
</footer>

</body>
</html>



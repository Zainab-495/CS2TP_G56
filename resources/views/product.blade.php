<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyrose Atelier</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>


    <style>
  /* ========ZAk styling ======== */
body {
  margin: 0;
  font-family: "Inter", sans-serif;
  background: #ffffff;
  color: #222222;
  line-height: 1.7;
}

h1,
h2,
h3 {
  font-family: "Playfair Display", serif;
  margin: 0;
}

.section-title {
  font-size: 2.4rem;
  text-align: center;
  margin-bottom: 10px;
}

.section-subtitle {
  text-align: center;
  font-size: 1rem;
  max-width: 600px;
  margin: 0 auto 30px;
  color: #555;
}

/* ======== zak Navbar  ======== */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 60px;
    border-bottom: 1px solid #eee;
    position: sticky;
    top: 0;
    background: #ffffff;
    z-index: 1000;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 30px;
}

.nav-links li {
    display: inline-block;
}

.nav-links a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    font-size: 0.95rem;
    padding: 6px 10px;
    transition: color 0.3s;
}

.nav-links a:hover {
    color: #b89b5e; /* Gold accent */
}

.logo {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 700;
}


/* ======== zak edit the hero section ======== */
.hero {
  text-align: center;
  padding: 130px 20px;
  background: #faf9f5;
}

.hero-title {
  font-size: 3rem;
  margin-bottom: 15px;
}

.hero-subtitle {
  font-size: 1.1rem;
  color: #555;
  max-width: 600px;
  margin: 0 auto 30px;
}

.btn-primary {
  background: #b89b5e;
  color: white;
  padding: 14px 34px;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.95rem;
  margin-right: 10px;
}

.btn-primary:hover {
  background: #a58954;
}

.btn-outline {
  border: 1px solid #b89b5e;
  padding: 13px 32px;
  border-radius: 4px;
  color: #b89b5e;
  text-decoration: none;
}

.btn-outline:hover {
  background: #b89b5e;
  color: white;
}

/* ======== STORY SECTION ======== */
.story-section {
  padding: 60px 60px;
}

.story-columns {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 22px;
  margin-top: 30px;
}

/* ======== RELATED ARTICLES ======== */
.related-section {
  padding: 60px 60px;
  background: #f8f8f8;
}

.related-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 25px;
}

.related-card {
  background: white;
  padding: 20px;
  border-radius: 6px;
  border: 1px solid #eee;
}

.related-card h3 {
  font-size: 1.2rem;
}

.author,
.topic,
.page {
  font-size: 0.9rem;
  color: #777;
}

/* ======== FOOTER ======== */
.footer {
  text-align: center;
  padding: 25px 0;
  font-size: 0.9rem;
  color: #666;
  border-top: 1px solid #eee;
}

/* ======== RESPONSIVE ======== */
@media (max-width: 768px) {
  .navbar {
    padding: 18px 25px;
  }

  .hero-title {
    font-size: 2.2rem;
  }

  .section-title {
    font-size: 1.9rem;
  }
}


/* ======== ABOUT PAGE ======== */

.about-hero {
    background: #faf9f5;
    padding: 120px 20px;
    text-align: center;
}

.about-hero h1 {
    font-size: 2.8rem;
    margin-bottom: 10px;
}

.about-hero p {
    max-width: 550px;
    margin: 0 auto;
    color: #555;
}

/* Story Grid (reuse style from landing) */
.about-section {
    padding: 60px 60px;
}

.about-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
    margin-top: 30px;
}

/* Mission Section */
.mission-section {
    background: #f8f8f8;
    padding: 60px 40px;
    text-align: center;
}

.mission-text {
    max-width: 700px;
    margin: 0 auto;
    color: #444;
    font-size: 1.05rem;
    line-height: 1.8;
}

/* Team Section */
.team-section {
    padding: 60px 60px;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.team-card {
    background: white;
    border: 1px solid #eee;
    padding: 20px;
    border-radius: 6px;
    text-align: center;
}

.team-photo {
    width: 100%;
    height: 220px;
    background: #ddd;
    border-radius: 6px;
    margin-bottom: 15px;
}

.role {
    font-size: 0.9rem;
    color: #b89b5e;
    margin-bottom: 10px;
}

.bio {
    color: #555;
    font-size: 0.9rem;
    line-height: 1.6;
}

/* Responsive Fixes */
@media (max-width: 768px) {
    .about-hero h1 {
        font-size: 2rem;
    }
}
/* ======== PRODUCT DETAIL PAGE ======== */
.product-detail {
    padding: 80px 60px;
}

.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 50px;
    align-items: start;
}

.product-image img {
    width: 100%;
    border-radius: 8px;
    border: 1px solid #eee;
}

.product-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    margin-bottom: 10px;
}

.product-price {
    font-size: 1.3rem;
    color: #b89b5e;
    margin-bottom: 20px;
}

.product-description {
    font-size: 1rem;
    color: #555;
    margin-bottom: 30px;
}

@media (max-width: 768px) {
    .product-detail {
        padding: 50px 20px;
    }
}

/* ======== PRODUCT page listing zak ======== */
.product-list-section {
    padding: 60px 60px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.product-card {
    display: block;
    background: white;
    padding: 20px;
    border-radius: 6px;
    text-align: center;
    border: 1px solid #eee;
    text-decoration: none;
    color: #222;
    transition: transform 0.2s, box-shadow 0.2s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
}

.product-card img {
    width: 100%;
    border-radius: 6px;
    margin-bottom: 15px;
}

.product-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    margin-bottom: 8px;
}

.product-price {
    color: #b89b5e;
    font-weight: 500;
    font-size: 1rem;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .product-list-section {
        padding: 50px 20px;
    }

    .hero {
        height: 400px;
    }

    .hero-content {
        padding: 30px 20px;
    }
   </style>
}
<!-- Zak NAVbar -->
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
        <h1 class="hero-title">{{ $product->name }}</h1>
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



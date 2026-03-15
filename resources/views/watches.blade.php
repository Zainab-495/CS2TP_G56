<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Watches — Skyrose Atelier</title>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
  <div class="page-wrapper">
    <div class="PageContent">
      <header class="TopNav">
        <a class="logo-link" href="/" aria-label="Skyrose Atelier home"><img class="header-logo" src="{{ asset('images/logo Skyrose.jpg') }}" alt="Skyrose Atelier logo"></a>
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/products">Products</a>
        <a href="/contact">Contact</a>
        <div class="IconNav">
          <a class="NavSearch" href="/products#searchInput" aria-label="Search"><img src="{{ asset('images/SearchIcon.png') }}" alt="Search"></a>
          <div id="auth-buttons">
            <a href="/login" aria-label="Login"><img src="{{ asset('images/ProfileIcon.png') }}" alt="Profile"></a>
            <a href="/cart" aria-label="Cart"><img src="{{ asset('images/CartIcon.png') }}" alt="Cart"><span id="cart-count" style="display:inline-block;margin-left:6px;color:#111;">0</span></a>
          </div>
        </div>
      </header>

      <!-- category navigation for browsing products -->
      <nav class="CategoryNav" aria-label="Product categories">
        <a href="/products">All</a>
        <a href="/category/rings">Rings</a>
        <a href="/category/earrings">Earrings</a>
        <a href="/category/bracelets">Bracelets</a>
        <a href="/category/necklaces">Necklaces</a>
        <a href="/category/watches">Watches</a>
      </nav>

      <!-- page heading + short info -->
      <section class="TitleSection">
        <h1 class="MainTitle">Watches</h1>
        <p class="TitleDescription">Curated mechanical and quartz watches.</p>
      </section>

      <!-- main product grid -->
      <main class="ProductsGrid" aria-label="Watches">
        <!-- single watch product card + description + price -->
        <a class="ProductCard" href="/products?product=gold-watch" data-name="Gold Watch" data-category="Watch">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/gold-watch.jpg') }}" alt="Gold Watch">
            <span class="ProductBadge">Watch</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Watch</h3>
            <p class="ProductDescription">A timeless gold factory watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta"><span class="ProductPrice">£650</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-gold-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Gold Watch', 'qty-gold-watch')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=sport-watch" data-name="Sport Watch" data-category="Watch">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/sport-watch.jpg') }}" alt="Sport Watch">
            <span class="ProductBadge">Watch</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Sport Watch</h3>
            <p class="ProductDescription">A timeless watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta"><span class="ProductPrice">£290</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-sport-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Sport Watch', 'qty-sport-watch')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=silver-watch" data-name="Silver Watch" data-category="Watch">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/silver-watch.jpg') }}" alt="Silver Watch">
            <span class="ProductBadge">Watch</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Silver Watch</h3>
            <p class="ProductDescription">A timeless factory silver watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta"><span class="ProductPrice">£410</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-silver-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Silver Watch', 'qty-silver-watch')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=Classic-leather-watch" data-name="Classic Leather Watch" data-category="Watch">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/classic-leather-watch.jpg') }}" alt="Classic Leather Watch">
            <span class="ProductBadge">Watch</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Classic Leather Watch</h3>
            <p class="ProductDescription">A timeless classic leather watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta"><span class="ProductPrice">£350</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-classic-leather-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Classic Leather Watch', 'qty-classic-leather-watch')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=signature-watch" data-name="Luxury Watch" data-category="Watch">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/Rolexwatch.jpg') }}" alt="Luxury Watch">
            <span class="ProductBadge">Watch</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Luxury Watch</h3>
            <p class="ProductDescription">A timeless watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta"><span class="ProductPrice">£850</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-luxury-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Luxury Watch', 'qty-luxury-watch')">Add to Cart</button>
          </div>
        </a>
      </main>

    </div>

    <!-- footer section -->
    <footer class="footer">
      <div class="FooterIconsContainer">
        <img class="FooterIcons" src="{{ asset('images/FacebookIcon.png') }}" alt="Facebook">
        <img class="FooterIcons" src="{{ asset('images/InstagramIcon.png') }}" alt="Instagram">
        <img class="FooterIcons" src="{{ asset('images/YoutubeIcon.png') }}" alt="YouTube">
      </div>

      <!-- copyright text -->
      <div class="FooterCopyright">&copy; <span id="year">2025</span> Skyrose Atelier</div>
    </footer>
  </div>

  <!-- auto-update the footer year -->
  <script>try{document.getElementById('year').textContent=new Date().getFullYear()}catch(e){};</script>
  <!-- main JS file -->
  <script src="{{ asset('js/index.js') }}" defer></script>
</body>
</html>




<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Earrings — Skyrose Atelier</title>
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

      <!-- links to different product categories -->
      <!-- Category sub-navigation -->
      <nav class="CategoryNav" aria-label="Product categories">
        <a href="/products">All</a>
        <a href="/category/rings">Rings</a>
        <a href="/category/earrings">Earrings</a>
        <a href="/category/bracelets">Bracelets</a>
        <a href="/category/necklaces">Necklaces</a>
        <a href="/category/watches">Watches</a>
      </nav>

 <!-- page title + short description -->
      <section class="TitleSection">
        <h1 class="MainTitle">Earrings</h1>
        <p class="TitleDescription">Finished earrings for everyday wear and special moments.</p>
      </section>

 <!-- product grid container -->
      <main class="ProductsGrid" aria-label="Earrings">
         <!-- single earring product card -->
        <a class="ProductCard" href="/products?product=threadbare-earrings" data-name="Threadbare Earrings" data-category="Earrings">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/ThreadbareEarrings.png') }}" alt="Threadbare Earrings">
            <span class="ProductBadge">Earrings</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Threadbare Earrings</h3>
            <p class="ProductDescription">Lightweight, elegant earrings for everyday wear. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta"><span class="ProductPrice">£120</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-threadbare-earrings"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Threadbare Earrings', 'qty-threadbare-earrings')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=diamond-earring" data-name="Diamond Earring" data-category="Earrings">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/diamond-earring.jpg') }}" alt="Diamond Earring">
            <span class="ProductBadge">Earrings</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Diamond chandelier Earring</h3>
            <p class="ProductDescription">A sparkling diamond earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta"><span class="ProductPrice">£480</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-diamond-earrings"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Diamond Earrings', 'qty-diamond-earrings')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=gold-earring" data-name="Gold Hoop Earring" data-category="Earrings">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/gold-hoop.jpg') }}" alt="Gold Hoop Earring">
            <span class="ProductBadge">Earrings</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Hoop Earring</h3>
            <p class="ProductDescription">A sparkling gold earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta"><span class="ProductPrice">£195</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-gold-hoop"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Gold Hoop', 'qty-gold-hoop')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=pearl-drop-earring" data-name="Pearl Drop Earring" data-category="Earrings">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/pearl-drop.jpg') }}" alt="Pearl Drop Earring">
            <span class="ProductBadge">Earrings</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Pearl Drop Earring</h3>
            <p class="ProductDescription">Elegant pearl drop earrings that add a touch of sophistication to any outfit. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta"><span class="ProductPrice">£275</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-pearl-drop"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Pearl Drop', 'qty-pearl-drop')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=silver-stud-earring" data-name="Silver Stud Earring" data-category="Earrings">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/silver-stud.jpg') }}" alt="Silver Stud Earring">
            <span class="ProductBadge">Earrings</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Silver Stud Earring</h3>
            <p class="ProductDescription">A sparkling silver stud earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta"><span class="ProductPrice">£145</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-silver-stud"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Silver Stud', 'qty-silver-stud')">Add to Cart</button>
          </div>
        </a>
      </main>

    </div>

 <!-- footer area -->
    <footer class="footer">
      <!-- social media icons -->
      <div class="FooterIconsContainer">
        <img class="FooterIcons" src="{{ asset('images/FacebookIcon.png') }}" alt="Facebook">
        <img class="FooterIcons" src="{{ asset('images/InstagramIcon.png') }}" alt="Instagram">
        <img class="FooterIcons" src="{{ asset('images/YoutubeIcon.png') }}" alt="YouTube">
      </div>
      <!-- dynamic year -->
      <div class="FooterCopyright">&copy; <span id="year">2025</span> Skyrose Atelier</div>
    </footer>
  </div>

<!-- updates footer year automatically -->
  <script>try{document.getElementById('year').textContent=new Date().getFullYear()}catch(e){};</script>
  <!-- main script -->
  <script src="{{ asset('js/index.js') }}" defer></script>
</body>
</html>




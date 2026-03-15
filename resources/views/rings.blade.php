<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rings — Skyrose Atelier</title>
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

      <!-- page heading + short description -->
      <section class="TitleSection">
        <h1 class="MainTitle">Rings</h1>
        <p class="TitleDescription">Explore our curated selection of rings.</p>
      </section>

      <!-- main product grid -->
      <main class="ProductsGrid" aria-label="Rings">
        <!-- single ring product card + description + price -->
        <a class="ProductCard" href="/products?product=buta-ring" data-name="Buta Ring" data-category="Ring">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/ButaRing.png') }}" alt="Buta Ring">
            <span class="ProductBadge">Ring</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Buta Ring</h3>
            <p class="ProductDescription">A beautifully detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta"><span class="ProductPrice">£185</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-buta-ring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Buta Ring', 'qty-buta-ring')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=Saphire-ring" data-name="Saphire Ring" data-category="Ring">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/saphire-ring.jpg') }}" alt="Saphire Ring">
            <span class="ProductBadge">Ring</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Saphire Ring</h3>
            <p class="ProductDescription">A beautifully Sapphire blue ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta"><span class="ProductPrice">£420</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-saphire-ring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Saphire Ring', 'qty-saphire-ring')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=rose-gold-ring" data-name="Rose Gold Ring" data-category="Ring">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/rose-gold.jpg') }}" alt="Rose Gold Ring">
            <span class="ProductBadge">Ring</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Rose Gold Ring</h3>
            <p class="ProductDescription">A beautifully Rose gold goldern detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta"><span class="ProductPrice">£385</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-rose-gold-ring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Rose Gold Ring', 'qty-rose-gold-ring')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=vintage-ring" data-name="Vintage Ring" data-category="Ring">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/vintage-ring.jpg') }}" alt="Vintage Ring">
            <span class="ProductBadge">Ring</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Vintage Ring</h3>
            <p class="ProductDescription">A vintage-inspired ring with timeless elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta"><span class="ProductPrice">£650</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-vintage-ring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Vintage Ring', 'qty-vintage-ring')">Add to Cart</button>
          </div>
        </a>

        <a class="ProductCard" href="/products?product=diamond-ring" data-name="Diamond Ring" data-category="Ring">
          <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/diamond-ring.jpg') }}" alt="Diamond Ring">
            <span class="ProductBadge">Ring</span>
          </div>
          <div class="ProductInfo">
            <h3 class="ProductTitle">Diamond Ring</h3>
            <p class="ProductDescription">A dazzling diamond ring that captures the essence of luxury and elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta"><span class="ProductPrice">£550</span></div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-diamond-ring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Diamond Ring', 'qty-diamond-ring')">Add to Cart</button>
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
      <!-- auto–updating copyright -->
      <div class="FooterCopyright">&copy; <span id="year">2025</span> Skyrose Atelier</div>
    </footer>
  </div>

  <!-- automatically update the year -->
  <script>try{document.getElementById('year').textContent=new Date().getFullYear()}catch(e){};</script>
  
  <!-- main site script -->
  <script src="{{ asset('js/index.js') }}" defer></script>
</body>
</html>




<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rings — Seraphine Atelier</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <div class="page-wrapper">
    <div class="PageContent">
      <header class="TopNav">
        <a href="home.html">Home</a>
        <a href="about.html">About</a>
        <a href="products.html">Products</a>
        <a href="contact.html">Contact</a>
        <div class="IconNav" id="auth-buttons"></div>
      </header>

      <!-- category navigation for browsing products -->
      <nav class="CategoryNav" aria-label="Product categories">
        <a href="products.html">All</a>
        <a href="rings.html">Rings</a>
        <a href="earrings.html">Earrings</a>
        <a href="bracelets.html">Bracelets</a>
        <a href="necklaces.html">Necklaces</a>
        <a href="watches.html">Watches</a>
      </nav>

<!-- page heading + short description -->
      <section class="TitleSection">
        <h1 class="MainTitle">Rings</h1>
        <p class="TitleDescription">Explore our curated selection of rings.</p>
      </section>

       <!-- main product grid -->
      <main class="ProductsGrid" aria-label="Rings">

<<<<<<< HEAD
        <!-- single ring product card + description + price -->
        <a class="ProductCard" href="product.html?product=buta-ring">
          <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/ButaRing.png" alt="Buta Ring"></div>
          <div class="ProductInfo"><h3 class="ProductTitle">Buta Ring</h3><p class="ProductDescription">A beautifully detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p><div class="ProductMeta"><span class="ProductPrice">£129</span></div></div>
        </a>
      </main>
=======
  <a class="ProductCard" href="products.html?product=buta-ring" data-name="Buta Ring" data-category="Ring">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/ButaRing.png" alt="Buta Ring"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Buta Ring</h3>
      <p class="ProductDescription">A beautifully detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
      <div class="ProductMeta"><span class="ProductPrice">£129</span></div>
    </div>
  </a>

  <a class="ProductCard" href="products.html?product=rose-gold-ring" data-name="Rose Gold Ring" data-category="Ring">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/rose-gold.jpg" alt="Rose Gold Ring"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Rose Gold Ring</h3>
      <p class="ProductDescription">A beautifully Rose gold goldern detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
      <div class="ProductMeta"><span class="ProductPrice">£3049</span></div>
    </div>
  </a>

  <a class="ProductCard" href="products.html?product=diamond-ring" data-name="Diamond Ring" data-category="Ring">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/diamond-ring.jpg" alt="Diamond Ring"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Diamond Ring</h3>
      <p class="ProductDescription">A dazzling diamond ring that captures the essence of luxury and elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
      <div class="ProductMeta"><span class="ProductPrice">£1929</span></div>
    </div>
  </a>

<a class="ProductCard" href="products.html?product=Sapphire-ring" data-name="Sapphire Ring" data-category="Ring">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/saphire-ring.jpg" alt="Sapphire Ring"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Sapphire Ring</h3>
      <p class="ProductDescription">A dazzling sapphire ring that captures the essence of luxury and elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
      <div class="ProductMeta"><span class="ProductPrice">£4059</span></div>
    </div>
  </a>

  <a class="ProductCard" href="products.html?product=vintage-ring" data-name="Vintage Ring" data-category="Ring">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/vintage-ring.jpg" alt="Vintage Ring"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Vintage Ring</h3>
      <p class="ProductDescription">A vintage-inspired ring with timeless elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
      <div class="ProductMeta"><span class="ProductPrice">£9302</span></div>
    </div>
  </a>




</main>
>>>>>>> b4c5a9c09529ecbaff02d7f14bc8223fd0fe3de7

    </div>

    <!-- footer section -->
    <footer class="footer">
      <div class="FooterIconsContainer">
        <img class="FooterIcons" src="assets/images/FacebookIcon.png" alt="Facebook">
        <img class="FooterIcons" src="assets/images/InstagramIcon.png" alt="Instagram">
        <img class="FooterIcons" src="assets/images/YoutubeIcon.png" alt="YouTube">
      </div>
       <!-- auto–updating copyright -->
      <div class="FooterCopyright">&copy; <span id="year">2025</span> Seraphine Atelier</div>
    </footer>
  </div>
<!-- automatically update the year -->
  <script>try{document.getElementById('year').textContent=new Date().getFullYear()}catch(e){};</script>
  
   <!-- main site script -->
  <script src="js/index.js" defer></script>
</body>
</html>

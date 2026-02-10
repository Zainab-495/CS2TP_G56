<!doctype html>
<html lang="en">
<head>
  <!--main stylesheet-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bracelets — Seraphine Atelier</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <div class="page-wrapper">
    <div class="PageContent">
      <!--main top navbar-->
      <header class="TopNav">
        <a href="home.html">Home</a>
        <a href="about.html">About</a>
        <a href="products.html">Products</a>
        <a href="contact.html">Contact</a>
        <div class="IconNav" id="auth-buttons"></div>
      </header>

      <!-- Category sub-navigation -->
      <nav class="CategoryNav" aria-label="Product categories">
        <a href="products.html">All</a>
        <a href="rings.html">Rings</a>
        <a href="earrings.html">Earrings</a>
        <a href="bracelets.html">Bracelets</a>
        <a href="necklaces.html">Necklaces</a>
        <a href="watches.html">Watches</a>
      </nav>

      <!--page title + short intro-->
      <section class="TitleSection">
        <h1 class="MainTitle">Bracelets</h1>
        <p class="TitleDescription">Bracelets handcrafted with care.</p>
      </section>


       <main class="ProductsGrid" aria-label="Bracelets">

  <a class="ProductCard" href="products.html?product=BleedingHeartBracelet" data-name="Bleeding Heart Bracelet" data-category="Bracelet">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/BleedingHeartBracelet.png" alt="Bleeding Heart Bracelet"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Bleeding Heart Bracelet</h3>
      <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£149</span></div>
    </div>
  </a>

   <a class="ProductCard" href="products.html?product=charm-Bracelet" data-name="Charm Bracelet" data-category="Bracelet">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/charm-bracelet.jpg" alt="Charm Bracelet"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Charm Bracelet</h3>
      <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£1419</span></div>
    </div>
  </a>

   <a class="ProductCard" href="products.html?product=gold-bangle" data-name="Gold Bangle" data-category="Bracelet">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/gold-bangle.jpg" alt="Gold Bangle"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Gold Bangle</h3>
      <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£16303</span></div>
    </div>
  </a>

   <a class="ProductCard" href="products.html?product=Leather-Bracelet" data-name="Leather Bracelet" data-category="Bracelet">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/leather-bracelet.jpg" alt="Leather Bracelet"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Leather Bracelet</h3>
      <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£1349</span></div>
    </div>
  </a>

   <a class="ProductCard" href="products.html?product=Cuban-Bracelet" data-name="Cuban Bracelet" data-category="Bracelet">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/cuban-bracelet.jpg" alt="Cuban Bracelet"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Cuban Bracelet</h3>
      <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£8302</span></div>
    </div>
  </a>

    </div>
<!--footer + social media icons-->
    <footer class="footer">
      <div class="FooterIconsContainer">
        <img class="FooterIcons" src="assets/images/FacebookIcon.png" alt="Facebook">
        <img class="FooterIcons" src="assets/images/InstagramIcon.png" alt="Instagram">
        <img class="FooterIcons" src="assets/images/YoutubeIcon.png" alt="YouTube">
      </div>
      <!--copyright-->
      <div class="FooterCopyright">&copy; <span id="year">2025</span> Seraphine Atelier</div>
    </footer>
  </div>
<!--update footer year automatically-->
  <script>try{document.getElementById('year').textContent=new Date().getFullYear()}catch(e){};</script>
  <!--main javascipt file-->
  <script src="js/index.js" defer></script>
</body>
</html>

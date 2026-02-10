<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Earrings — Seraphine Atelier</title>
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

      <!-- links to different product categories -->
      <nav class="CategoryNav" aria-label="Product categories">
        <a href="products.html">All</a>
        <a href="rings.html">Rings</a>
        <a href="earrings.html">Earrings</a>
        <a href="bracelets.html">Bracelets</a>
        <a href="necklaces.html">Necklaces</a>
        <a href="watches.html">Watches</a>
      </nav>
 <!-- page title + short description -->
      <section class="TitleSection">
        <h1 class="MainTitle">Earrings</h1>
        <p class="TitleDescription">Finished earrings for everyday wear and special moments.</p>
      </section>
 <!-- product grid container -->
      <main class="ProductsGrid" aria-label="Earrings">

        <a class="ProductCard" href="products.html?product=diamond-earring" data-name="Diamond Earring" data-category="Earrings">
          <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/diamond-earring.jpg" alt="Diamond Earring"></div>
          <div class="ProductInfo"><h3 class="ProductTitle">Diamond Earring</h3><p class="ProductDescription">A sparkling diamond earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p><div class="ProductMeta"><span class="StockText in-stock">In Stock</span><span class="ProductPrice">£8309</span></div></div>
        
        <a class="ProductCard" href="products.html?product=pearl-drop-earrings" data-name="Pearl Drop Earrings" data-category="Earrings">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/pearl-drop.jpg" alt="Pearl Drop Earrings"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Pearl Drop Earrings</h3>
      <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£9709</span></div>
    </div>
  </a>

  <a class="ProductCard" href="products.html?product=Gold-Hoop-Earring" data-name="Gold Hoop Earring" data-category="Earrings">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/gold-hoop.jpg" alt="Gold Earring"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Gold Hoop Earring</h3>
      <p class="ProductDescription">Handcrafted earring with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£9309</span></div>
    </div>
  </a>

  <a class="ProductCard" href="products.html?product=Silver-stud-Earring" data-name="Silver stud Earring" data-category="Earrings">
    <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/silver-stud.jpg" alt="Silver stud Earring"></div>
    <div class="ProductInfo">
      <h3 class="ProductTitle">Silver stud Earring</h3>
      <p class="ProductDescription">Handcrafted silver stud earring with romantic detailing. A statement piece celebrating love and craftsmanship with timeless appeal.</p>
      <div class="ProductMeta"><span class="ProductPrice">£9309</span></div>
    </div>
  </a>
        
        
          <a class="ProductCard" href="products.html?product=threadbare-earrings" data-name="Threadbare Earrings" data-category="Earrings">
          <div class="ProductImageWrap"><img class="ProductImage" src="assets/images/ThreadbareEarrings.png" alt="Threadbare Earrings"></div>
          <div class="ProductInfo"><h3 class="ProductTitle">Threadbare Earrings</h3><p class="ProductDescription">Lightweight, elegant earrings for everyday wear. Perfect complement to any outfit with subtle elegance and timeless design.</p><div class="ProductMeta"><span class="ProductPrice">£89</span></div></div>
        </a>
      </main>



    </div>
 <!-- footer area -->
    <footer class="footer">
      <!-- social media icons -->
      <div class="FooterIconsContainer">
        <img class="FooterIcons" src="assets/images/FacebookIcon.png" alt="Facebook">
        <img class="FooterIcons" src="assets/images/InstagramIcon.png" alt="Instagram">
        <img class="FooterIcons" src="assets/images/YoutubeIcon.png" alt="YouTube">
      </div>
      <!-- dynamic year -->
      <div class="FooterCopyright">&copy; <span id="year">2025</span> Seraphine Atelier</div>
    </footer>
  </div>
<!-- updates footer year automatically -->
  <script>try{document.getElementById('year').textContent=new Date().getFullYear()}catch(e){};</script>
  <!-- main script -->
  <script src="js/index.js" defer></script>
</body>
</html>

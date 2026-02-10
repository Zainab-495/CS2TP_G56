    <!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Our Products</title>
        <link rel="stylesheet" href="css/index.css">
        <script src="js/index.js" defer></script>
</head>
<body>

<div class="page-wrapper">
    <div class="PageContent">

    <!-- Top Navigation -->
    <div class="TopNav">
        <a href="home.html">Home</a>
        <a href="about.html">About</a>
        <a href="products.html">Products</a>
        <a href="contact.html">Contact</a>

        <div class="IconNav"></div>
</div>

<section class="TitleSection">
        <h1 class="MainTitle">Our Jewellery Collection</h1>
        <p class="TitleDescription">Browse our handmade, luxury jewellery pieces.</p>
</section>

<!-- Search Bar -->
<section class="SearchSection" style="padding: 20px; text-align: center; background: #f9f9f9; margin: 20px 0;">
    <input type="text" id="searchInput" placeholder="Search products by name or category..." style="width: 100%; max-width: 500px; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
</section>

<!-- Category links -->
<section class="CategoryLinks" aria-label="Shop by category">
    <h2 class="SectionTitle">Shop By Category</h2>
    <div class="CategoryGrid">
        <a class="CategoryCard" href="rings.html">Rings</a>
        <a class="CategoryCard" href="earrings.html">Earrings</a>
        <a class="CategoryCard" href="bracelets.html">Bracelets</a>
        <a class="CategoryCard" href="necklaces.html">Necklaces</a>
        <a class="CategoryCard" href="watches.html">Watches</a>
    </div>
</section>

<!-- Products Grid (uses CSS in css/index.css) -->
<main class="ProductsGrid" id="productsGrid" aria-label="Product list">
<<<<<<< HEAD
 <!-- product card 1 -->
    <a class="ProductCard" href="product.html?product=buta-ring" data-name="Buta Ring" data-category="Ring">
=======

    <a class="ProductCard" href="products.html?product=buta-ring" data-name="Buta Ring" data-category="Ring">
>>>>>>> b4c5a9c09529ecbaff02d7f14bc8223fd0fe3de7
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/ButaRing.png" alt="Buta Ring">
            <span class="ProductBadge">Ring</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Buta Ring</h3>
            <!-- short description -->
            <p class="ProductDescription">A beautifully detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <!-- stock + price info -->
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£129</span>
            </div>
             <!-- quick add-to-cart button -->
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Buta Ring', 1)">Add to Cart</button>
        </div>
    </a>
<<<<<<< HEAD
<!-- product card 2 -->
    <a class="ProductCard" href="product.html?product=threadbare-earrings" data-name="Threadbare Earrings" data-category="Earrings">
=======

<a class="ProductCard" href="products.html?product=Saphire-ring" data-name="Saphire Ring" data-category="Ring">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/saphire-ring.jpg" alt="Saphire Ring">
            <span class="ProductBadge">Ring</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Saphire Ring</h3>
            <p class="ProductDescription">A beautifully Sapphire blue ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£4059</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Saphire Ring', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=rose-gold-ring" data-name="Rose Gold Ring" data-category="Ring">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/rose-gold.jpg" alt="Rose Gold Ring">
            <span class="ProductBadge">Ring</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Rose Gold Ring</h3>
            <p class="ProductDescription">A beautifully Rose gold goldern detailed ring with traditional motifs. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£3049</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Rose Gold Ring', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=vintage-ring" data-name="Vintage Ring" data-category="Ring">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/vintage-ring.jpg" alt="Vintage Ring">
            <span class="ProductBadge">Ring</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Vintage Ring</h3>
            <p class="ProductDescription">A vintage-inspired ring with timeless elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£9302</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Vintage Ring', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=diamond-ring" data-name="diamond Ring" data-category="Ring">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/diamond-ring.jpg" alt="Diamond Ring">
            <span class="ProductBadge">Ring</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Diamond Ring</h3>
            <p class="ProductDescription">A dazzling diamond ring that captures the essence of luxury and elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£1929</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Diamond Ring', 1)">Add to Cart</button>
        </div>
    </a>



    <a class="ProductCard" href="products.html?product=threadbare-earrings" data-name="Threadbare Earrings" data-category="Earrings">
>>>>>>> b4c5a9c09529ecbaff02d7f14bc8223fd0fe3de7
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/ThreadbareEarrings.png" alt="Threadbare Earrings">
            <span class="ProductBadge">Earrings</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Threadbare Earrings</h3>
            <p class="ProductDescription">Lightweight, elegant earrings for everyday wear. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£89</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Threadbare Earrings', 1)">Add to Cart</button>
        </div>
    </a>
<<<<<<< HEAD
 <!-- product card 3 -->
    <a class="ProductCard" href="product.html?product=bleeding-heart-bracelet" data-name="Bleeding Heart Bracelet" data-category="Bracelet">
=======

 <a class="ProductCard" href="products.html?product=diamond-earring" data-name="Diamond Earring" data-category="Earrings">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/diamond-earring.jpg" alt="Diamond Earring">
            <span class="ProductBadge">Earrings</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Diamond chandelier Earring</h3>
            <p class="ProductDescription">A sparkling diamond earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£8309</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Diamond Earring', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=gold-earring" data-name="Gold Hoop Earring" data-category="Earrings">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/gold-hoop.jpg" alt="Gold Earring">
            <span class="ProductBadge">Earrings</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Hoop Earring</h3>
            <p class="ProductDescription">A sparkling gold earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£9309</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Gold Hoop Earring', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=pearl-drop-earring" data-name="Pearl Drop Earring" data-category="Earrings">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/pearl-drop.jpg" alt="Pearl Drop Earring">
            <span class="ProductBadge">Earrings</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Pearl Drop Earring</h3>
            <p class="ProductDescription">Elegant pearl drop earrings that add a touch of sophistication to any outfit. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£9709</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Pearl Drop Earring', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=silver-stud-earring" data-name="Silver Stud Earring" data-category="Earrings">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/silver-stud.jpg" alt="Silver Stud Earring">
            <span class="ProductBadge">Earrings</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Silver Stud Earring</h3>
            <p class="ProductDescription">A sparkling silver stud earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£1209</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Silver Stud Earring', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=bleeding-heart-bracelet" data-name="Bleeding Heart Bracelet" data-category="Bracelet">
>>>>>>> b4c5a9c09529ecbaff02d7f14bc8223fd0fe3de7
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/BleedingHeartBracelet.png" alt="Bleeding Heart Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Bleeding Heart Bracelet</h3>
            <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText low-stock">Low Stock</span>
                <span class="ProductPrice">£149</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Bleeding Heart Bracelet', 1)">Add to Cart</button>
        </div>
    </a>

<<<<<<< HEAD
<!-- product card 4 -->
    <a class="ProductCard" href="product.html?product=handcrafted-jewellry" data-name="Signature Necklace" data-category="Necklace">
=======
<a class="ProductCard" href="products.html?product=gold-bangle-bracelet" data-name="Gold Bangle Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/gold-bangle.jpg" alt="Gold Bangle Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Bangle Bracelet</h3>
            <p class="ProductDescription">Golden baddazzling heavy bangle bracelet perfect for weddings and special occasions. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText low-stock">Low Stock</span>
                <span class="ProductPrice">£16303</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Gold Bangle Bracelet', 1)">Add to Cart</button>
        </div>
    </a>


<a class="ProductCard" href="products.html?product=cuban-bracelet" data-name="Cuban Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/cuban-bracelet.jpg" alt="Cuban Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Cuban Bracelet</h3>
            <p class="ProductDescription">An embezzeling factory made Cuban Bracelet full of luxury. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText low-stock">Low Stock</span>
                <span class="ProductPrice">£8302</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Cuban Bracelet', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=charm-bracelet" data-name="Charm Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/charm-bracelet.jpg" alt="Charm Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Charm Bracelet</h3>
            <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText low-stock">Low Stock</span>
                <span class="ProductPrice">£1419</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Charm Bracelet', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=leather-bracelet" data-name="Leather Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/leather-bracelet.jpg" alt="Leather Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Leather Bracelet</h3>
            <p class="ProductDescription">Handcrafted leather bracelet with a rugged yet refined look. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText low-stock">Low Stock</span>
                <span class="ProductPrice">£1349</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Leather Bracelet', 1)">Add to Cart</button>
        </div>
    </a>

    




    <a class="ProductCard" href="products.html?product=signature-necklace" data-name="Signature Necklace" data-category="Necklace">
>>>>>>> b4c5a9c09529ecbaff02d7f14bc8223fd0fe3de7
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/HandCraftedJewellry.png" alt="Handcrafted Jewelry">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Signature Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£199</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Signature Necklace', 1)">Add to Cart</button>
        </div>
    </a>

<<<<<<< HEAD
<!-- product card 5 -->
    <a class="ProductCard" href="product.html?product=signature-necklace" data-name="Signature Watch" data-category="Watch">
=======

<a class="ProductCard" href="products.html?product=signature-necklace" data-name="Signature Necklace" data-category="Necklace">
>>>>>>> b4c5a9c09529ecbaff02d7f14bc8223fd0fe3de7
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/diamond-choker.jpg" alt="Handcrafted Jewelry">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Diamond Choker Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£280</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Diamond Choker Necklace', 1)">Add to Cart</button>
        </div>
    </a>

<a class="ProductCard" href="products.html?product=pearl-necklace" data-name="Pearl Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/pearl-necklace.jpg" alt="Handcrafted Jewelry">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Pearl Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£240</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Pearl Necklace', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=gold-necklace" data-name="Gold Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/gold-necklace.jpg" alt="Handcrafted Jewelry">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£250</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Gold Necklace', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=layered-necklace" data-name="Layered Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/layered-necklace.jpg" alt="Handcrafted Jewelry">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Layered Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£450</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Layered Necklace', 1)">Add to Cart</button>
        </div>
    </a>

<a class="ProductCard" href="products.html?product=gold-watch" data-name="Gold Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/gold-watch.jpg" alt="Gold Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Watch</h3>
            <p class="ProductDescription">A timeless gold factory watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£1240</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Gold Watch', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=sport-watch" data-name="Sport Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/sport-watch.jpg" alt="Sport Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Sport Watch</h3>
            <p class="ProductDescription">A timeless watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£890</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Sport Watch', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=silver-watch" data-name="Silver Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/silver-watch.jpg" alt="Silver Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Silver Watch</h3>
            <p class="ProductDescription">A timeless factory silver watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£3404</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Silver Watch', 1)">Add to Cart</button>
        </div>
    </a>

    <a class="ProductCard" href="products.html?product=Classic-leather-watch" data-name="Classic Leather Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/classic-leather-watch.jpg" alt="Classic Leather Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Classic Leather Watch</h3>
            <p class="ProductDescription">A timeless classic leather watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£987</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Classic Leather Watch', 1)">Add to Cart</button>
        </div>
    </a>



    <a class="ProductCard" href="products.html?product=signature-watch" data-name="Signature Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="assets/images/Rolexwatch.jpg" alt="Signature Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Luxury Watch</h3>
            <p class="ProductDescription">A timeless watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£1729</span>
            </div>
            <button class="AddToCartButton" onclick="addToCartQuick(event, 'Signature Watch', 1)">Add to Cart</button>
        </div>
    </a>

        </main>

    </div>
 <!-- footer section -->
    <div id="site-footer">
    <footer class="footer">
        <div class="FooterIconsContainer">
            <img src="assets/images/FacebookIcon.png" class="FooterIcons" alt="facebook">
            <img src="assets/images/InstagramIcon.png" class="FooterIcons" alt="instagram">
            <img src="assets/images/YoutubeIcon.png" class="FooterIcons" alt="youtube">
        </div>
        <p class="ContactTitle">© 2025 Luxury Jewelry Store</p>
    </footer>
</div>
<script src="js/index.js" defer></script>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const query = e.target.value.toLowerCase();
    const products = document.querySelectorAll('.ProductCard');
    
    // filter products by name or category
    products.forEach(product => {
        const name = product.getAttribute('data-name').toLowerCase();
        const category = product.getAttribute('data-category').toLowerCase();
        
        if (name.includes(query) || category.includes(query) || query === '') {
            product.style.display = 'block'; // show product
        } else {
            product.style.display = 'none'; // hide product
        }
    });
});
// quick add-to-cart function
function addToCartQuick(e, name, qty){
    e.preventDefault();
    fetch('api/add-to-cart.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({productName: name, quantity: qty})
    }).then(()=>{
        // update cart count if function exists
        if(window.loadCartCount) loadCartCount();
        else if(typeof window.Site !== 'undefined' && window.Site.updateCartCount) window.Site.updateCartCount();
        alert(name + ' added to cart');
    }).catch(()=> alert('Failed to add to cart'));
}
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Our Products</title>
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo%20Skyrose.jpg') }}">
        <style>
            /* Product Detail View Responsive Styles */
            #productDetailView .detail-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 60px;
                align-items: start;
            }
            
            @media (max-width: 900px) {
                #productDetailView .detail-grid {
                    grid-template-columns: 1fr;
                    gap: 30px;
                }
                
                #productDetailView .detail-image-container {
                    position: relative !important;
                    top: auto !important;
                }
            }
        .ProductCardActions { display: flex; gap: 8px; margin-top: 10px; }
        .AddToCartButton { flex: 1; }
        .WishlistBtn {
            background: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s;
            color: #aaa;
            line-height: 1;
        }
        .WishlistBtn:hover, .WishlistBtn.active { color: #e74c3c; border-color: #e74c3c; }
        </style>
</head>
<body>

<div class="page-wrapper">

    <div class="PageContent">

    @include('partials.nav')

<section class="TitleSection">
        <p class="TitleEyebrow">Signature Pieces</p>
        <h1 class="MainTitle">Our Jewellery Collection</h1>
        <p class="TitleDescription">Browse our handmade, luxury jewellery pieces.</p>
    </section>

    <!-- Search Bar -->
    <section class="SearchSection">
        <div class="SearchCard">
            <p class="SearchEyebrow">Search the collection</p>
            <div class="SearchBar">
                <span class="SearchIcon" aria-hidden="true">
                    <img src="{{ asset('images/SearchIcon.png') }}" alt="" aria-hidden="true">
                </span>
                <input type="text" id="searchInput" placeholder="Search products by name or category..." />
            </div>
        </div>
    </section>

<!-- Category links -->
<section class="CategoryLinks" aria-label="Shop by category">
    @include('partials.category-dropdown', ['active' => ''])

</section>


<!-- Products Grid (uses CSS in css/index.css) -->
<main class="ProductsGrid" id="productsGrid" aria-label="Product list">
    <!-- Dynamically generated product cards from database -->
    @foreach($products as $product)
    <a class="ProductCard" href="/products/{{ $product->id }}" data-name="{{ $product->name }}" data-category="{{ $product->category }}">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
            <span class="ProductBadge">{{ $product->category }}</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">{{ $product->name }}</h3>
            <p class="ProductDescription">{{ $product->description }}</p>
            <div class="ProductMeta">
                <span class="StockText {{ $product->stock_quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                    {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>
                <span class="ProductPrice">£{{ number_format($product->price, 0) }}</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label>
                <select id="qty-{{ $product->id }}">
                    @for($i = 1; $i <= min(10, max(1, $product->stock_quantity)); $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="ProductCardActions">
                <button class="AddToCartButton" onclick="addToCartWithQuantity(event, '{{ $product->name }}', 'qty-{{ $product->id }}')">Add to Cart</button>
                <button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button>
            </div>
        </div>
    </a>
    @endforeach
            <h3 class="ProductTitle">Diamond Ring</h3>
            <p class="ProductDescription">A dazzling diamond ring that captures the essence of luxury and elegance. Handcrafted from ethically sourced materials with intricate detailing.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£550</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-diamond-ring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Diamond Ring', 'qty-diamond-ring')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>



    <a class="ProductCard" href="/products?product=threadbare-earrings" data-name="Threadbare Earrings" data-category="Earrings">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/ThreadbareEarrings.png') }}" alt="Threadbare Earrings">
            <span class="ProductBadge">Earrings</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Threadbare Earrings</h3>
            <p class="ProductDescription">Lightweight, elegant earrings for everyday wear. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£120</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-threadbare-earrings"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Threadbare Earrings', 'qty-threadbare-earrings')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
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
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£480</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-diamond-earring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Diamond Earrings', 'qty-diamond-earring')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    <a class="ProductCard" href="/products?product=gold-earring" data-name="Gold Hoop Earring" data-category="Earrings">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/gold-hoop.jpg') }}" alt="Gold Earring">
            <span class="ProductBadge">Earrings</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Hoop Earring</h3>
            <p class="ProductDescription">A sparkling gold earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£195</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-gold-hoop-earring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Gold Hoop', 'qty-gold-hoop-earring')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
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
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£275</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-pearl-drop-earring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Pearl Drop', 'qty-pearl-drop-earring')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
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
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£145</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-silver-stud-earring"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Silver Stud', 'qty-silver-stud-earring')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    <a class="ProductCard" href="/products?product=bleeding-heart-bracelet" data-name="Bleeding Heart Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/BleedingHeartBracelet.png') }}" alt="Bleeding Heart Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Bleeding Heart Bracelet</h3>
            <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£245</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-bleeding-heart-bracelet"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Bleeding Heart Bracelet', 'qty-bleeding-heart-bracelet')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

<a class="ProductCard" href="/products?product=gold-bangle-bracelet" data-name="Gold Bangle Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/gold-bangle.jpg') }}" alt="Gold Bangle Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Bangle Bracelet</h3>
            <p class="ProductDescription">Golden baddazzling heavy bangle bracelet perfect for weddings and special occasions. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText low-stock">Low Stock</span>
                <span class="ProductPrice">£380</span>
            </div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartQuick(event, 'Gold Bangle', 1)">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>


<a class="ProductCard" href="/products?product=cuban-bracelet" data-name="Cuban Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/cuban-bracelet.jpg') }}" alt="Cuban Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Cuban Bracelet</h3>
            <p class="ProductDescription">An embezzeling factory made Cuban Bracelet full of luxury. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£520</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-cuban-bracelet"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Cuban Bracelet', 'qty-cuban-bracelet')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    <a class="ProductCard" href="/products?product=charm-bracelet" data-name="Charm Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/charm-bracelet.jpg') }}" alt="Charm Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Charm Bracelet</h3>
            <p class="ProductDescription">Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£310</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-charm-bracelet"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Charm Bracelet', 'qty-charm-bracelet')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    <a class="ProductCard" href="/products?product=leather-bracelet" data-name="Leather Bracelet" data-category="Bracelet">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/leather-bracelet.jpg') }}" alt="Leather Bracelet">
            <span class="ProductBadge">Bracelet</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Leather Bracelet</h3>
            <p class="ProductDescription">Handcrafted leather bracelet with a rugged yet refined look. A statement piece celebrating love and craftsmanship.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£175</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-leather-bracelet"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Leather Bracelet', 'qty-leather-bracelet')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    



    <a class="ProductCard" href="/products?product=signature-necklace" data-name="Signature Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/HandCraftedJewellry.png') }}" alt="Handcrafted Jewelry">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Signature Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£380</span>
            </div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartQuick(event, 'Signature Necklace', 1)">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>


<a class="ProductCard" href="/products?product=diamond-choker-necklace" data-name="Diamond Choker Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/diamond-choker.jpg') }}" alt="Diamond Choker Necklace">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Diamond Choker Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£720</span>
            </div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartQuick(event, 'Diamond Choker', 1)">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

<a class="ProductCard" href="/products?product=pearl-necklace" data-name="Pearl Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/pearl-necklace.jpg') }}" alt="Pearl Necklace">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Pearl Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£420</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-pearl-necklace"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Pearl Necklace', 'qty-pearl-necklace')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    <a class="ProductCard" href="/products?product=gold-necklace" data-name="Gold Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/gold-necklace.jpg') }}" alt="Gold Necklace">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£540</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-gold-necklace"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Gold Necklace', 'qty-gold-necklace')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    <a class="ProductCard" href="/products?product=layered-necklace" data-name="Layered Necklace" data-category="Necklace">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/layered-necklace.jpg') }}" alt="Layered Necklace">
            <span class="ProductBadge">Necklace</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Layered Necklace</h3>
            <p class="ProductDescription">Statement necklace made by skilled artisans. Designed to elevate any occasion with timeless elegance.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£340</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-layered-necklace"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Layered Necklace', 'qty-layered-necklace')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

<a class="ProductCard" href="/products?product=gold-watch" data-name="Gold Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/gold-watch.jpg') }}" alt="Gold Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Gold Watch</h3>
            <p class="ProductDescription">A timeless gold factory watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£650</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-gold-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Gold Watch', 'qty-gold-watch')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
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
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£290</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-sport-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Sport Watch', 'qty-sport-watch')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
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
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£410</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-silver-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Silver Watch', 'qty-silver-watch')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

    <a class="ProductCard" href="/products?product=classic-leather-watch" data-name="Classic Leather Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/classic-leather-watch.jpg') }}" alt="Classic Leather Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Classic Leather Watch</h3>
            <p class="ProductDescription">A timeless classic leather watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£350</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-classic-leather-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Classic Leather Watch', 'qty-classic-leather-watch')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>



    <a class="ProductCard" href="/products?product=signature-watch" data-name="Signature Watch" data-category="Watch">
        <div class="ProductImageWrap">
            <img class="ProductImage" src="{{ asset('images/Rolexwatch.jpg') }}" alt="Signature Watch">
            <span class="ProductBadge">Watch</span>
        </div>
        <div class="ProductInfo">
            <h3 class="ProductTitle">Luxury Watch</h3>
            <p class="ProductDescription">A timeless watch inspired by classical forms. Precision craftsmanship meets elegant design.</p>
            <div class="ProductMeta">
                <span class="StockText in-stock">In Stock</span>
                <span class="ProductPrice">£850</span>
            </div>
            <div class="QuantitySelector"><label>Qty:</label><select id="qty-signature-watch"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div>
            <div class="ProductCardActions"><button class="AddToCartButton" onclick="addToCartWithQuantity(event, 'Luxury Watch', 'qty-signature-watch')">Add to Cart</button><button type="button" class="WishlistBtn" onclick="toggleWishlist(event, this)" title="Add to wishlist">&#9825;</button></div>
        </div>
    </a>

        </main>

<!-- Product Detail View (initially hidden) -->
<section id="productDetailView" style="display: none; padding: 40px 20px; max-width: 1200px; margin: 0 auto;">
    <a href="/products" style="display: inline-block; margin-bottom: 20px; color: #111; text-decoration: none; font-weight: 500;">&larr; Back to Products</a>
    
    <div class="detail-grid">
        <!-- Product Image -->
        <div class="detail-image-container" style="position: sticky; top: 20px;">
            <img id="detailImage" src="" alt="" style="width: 100%; max-width: 600px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <span id="detailBadge" class="ProductBadge" style="position: absolute; top: 20px; right: 20px;"></span>
        </div>
        
        <!-- Product Info -->
        <div>
            <h1 id="detailTitle" style="font-size: 2.5em; margin-bottom: 10px; color: #111;"></h1>
            <p id="detailDescription" style="font-size: 1.1em; line-height: 1.8; color: #555; margin-bottom: 30px;"></p>
            
            <div style="display: flex; gap: 20px; align-items: center; margin-bottom: 30px; flex-wrap: wrap;">
                <span id="detailStock" class="StockText in-stock"></span>
                <span id="detailPrice" style="font-size: 2em; font-weight: 600; color: #111;"></span>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="font-weight: 500; margin-right: 10px;">Quantity:</label>
                <select id="detailQuantity" style="padding: 10px 20px; font-size: 1em; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            
            <button id="detailAddToCart" class="AddToCartButton" style="padding: 15px 40px; font-size: 1.1em; width: auto; min-width: 200px;">Add to Cart</button>
            <button id="detailWishlistBtn" onclick="toggleDetailWishlist()" style="margin-left:12px;padding:15px 40px;font-size:1.1em;background:transparent;color:#111;border:1px solid #111;border-radius:4px;cursor:pointer;font-weight:600;transition:all 0.2s;">&#9825; Add to Wishlist</button>
            
            <div style="margin-top: 40px; padding-top: 40px; border-top: 1px solid #ddd;">
                <h3 style="margin-bottom: 15px;">Product Details</h3>
                <ul style="line-height: 2; color: #555;">
                    <li>Handcrafted with care and precision</li>
                    <li>Ethically sourced materials</li>
                    <li>Comes with certificate of authenticity</li>
                    <li>30-day return policy</li>
                    <li>Free shipping on orders over £200</li>
                </ul>
            </div>
        </div>
    </div>
</section>

    </div>

    @include('partials.footer')

<script>
// Check if we're viewing a specific product
function showProductDetail() {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product');
    
    if (productId) {
        // Find the product card with matching href
        const productCard = document.querySelector(`.ProductCard[href="/products?product=${productId}"]`);
        
        if (productCard) {
            // Hide the grid view elements
            document.querySelector('.TitleSection').style.display = 'none';
            document.querySelector('.SearchSection').style.display = 'none';
            document.querySelector('.CategoryLinks').style.display = 'none';
            document.getElementById('productsGrid').style.display = 'none';
            
            // Show detail view
            document.getElementById('productDetailView').style.display = 'block';
            
            // Extract product info from the card
            const img = productCard.querySelector('.ProductImage');
            const title = productCard.querySelector('.ProductTitle').textContent;
            const description = productCard.querySelector('.ProductDescription').textContent;
            const price = productCard.querySelector('.ProductPrice').textContent;
            const badge = productCard.querySelector('.ProductBadge').textContent;
            const stockElement = productCard.querySelector('.StockText');
            const stock = stockElement ? stockElement.textContent : 'In Stock';
            const stockClass = stockElement ? stockElement.className : 'StockText in-stock';
            
            // Populate detail view
            document.getElementById('detailImage').src = img.src;
            document.getElementById('detailImage').alt = title;
            document.getElementById('detailTitle').textContent = title;
            document.getElementById('detailDescription').textContent = description;
            document.getElementById('detailPrice').textContent = price;
            document.getElementById('detailBadge').textContent = badge;
            document.getElementById('detailStock').textContent = stock;
            document.getElementById('detailStock').className = stockClass;
            
            // Get the product name for cart (from the onclick attribute or data)
            let productName = title;
            const addToCartBtn = productCard.querySelector('.AddToCartButton');
            if (addToCartBtn && addToCartBtn.getAttribute('onclick')) {
                const onclickStr = addToCartBtn.getAttribute('onclick');
                const match = onclickStr.match(/'([^']+)'/);
                if (match) {
                    productName = match[1];
                }
            }
            
            // Setup wishlist button state
            var wBtn = document.getElementById('detailWishlistBtn');
            if (wBtn && window.wishlist) {
                if (window.wishlist.isInWishlist(productName)) {
                    wBtn.innerHTML = '&#9829; In Wishlist';
                    wBtn.style.background = '#fff0f0';
                    wBtn.style.borderColor = '#e74c3c';
                    wBtn.style.color = '#e74c3c';
                } else {
                    wBtn.innerHTML = '&#9825; Add to Wishlist';
                    wBtn.style.background = 'transparent';
                    wBtn.style.borderColor = '#111';
                    wBtn.style.color = '#111';
                }
            }

            // Store current detail name for toggleDetailWishlist
            window._detailProductName = productName;
            window._detailProductPrice = price;
            window._detailProductImage = img ? img.src : '';
            window._detailProductCategory = badge;

            // Setup add to cart button
            document.getElementById('detailAddToCart').onclick = function(event) {
                const qty = parseInt(document.getElementById('detailQuantity').value);
                
                // Use the existing addToCartQuick function
                if (typeof addToCartQuick === 'function') {
                    addToCartQuick(event, productName, qty);
                } else {
                    // Fallback if function not available
                    alert('Added ' + qty + ' × ' + productName + ' to cart!');
                }
            };
            
            // Scroll to top
            window.scrollTo(0, 0);
        } else {
            // Product not found, redirect to product-notfound.html or show grid
            console.error('Product not found:', productId);
        }
    }
}

// Run on page load
document.addEventListener('DOMContentLoaded', function() {
    showProductDetail();
    // Auto-apply ?q= URL param into the search box
    const qParam = new URLSearchParams(window.location.search).get('q');
    const searchEl = document.getElementById('searchInput');
    if (qParam && searchEl) {
        searchEl.value = qParam;
        searchEl.dispatchEvent(new Event('keyup'));
        searchEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// Search functionality (only run if we're not viewing a specific product)
if (document.getElementById('searchInput')) {
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        const query = e.target.value.toLowerCase();
        const products = document.querySelectorAll('.ProductCard');
        
        // filter products by name or category
        products.forEach(product => {
            const name = product.getAttribute('data-name').toLowerCase();
            const category = product.getAttribute('data-category').toLowerCase();

            // Strip trailing 's' to match both singular and plural (e.g. "rings" â†’ matches "ring")
            // Use word-boundary matching so "rings" doesn't match inside "earrings"
            const escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const stem = escaped.replace(/s$/, '');
            const wordRe = new RegExp('\\b' + stem + 's?\\b');
            const categoryMatch = query === '' || wordRe.test(category);
            const nameMatch = query === '' || wordRe.test(name);

            if (nameMatch || categoryMatch || query === '') {
                product.style.display = 'block'; // show product
            } else {
                product.style.display = 'none'; // hide product
            }
        });
    });
}
</script>

    <script>
    // Prevent card navigation when interacting with quantity selectors or add-to-cart buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure add-to-cart buttons don't trigger navigation
        document.querySelectorAll('.AddToCartButton').forEach(btn => {
            btn.setAttribute('type', 'button');
            btn.addEventListener('click', evt => {
                evt.stopPropagation();
            });
        });

        // Stop select clicks/changes from bubbling to the anchor link
        document.querySelectorAll('.ProductCard select').forEach(sel => {
            sel.addEventListener('click', evt => {
                evt.preventDefault();
                evt.stopPropagation();
            });
            sel.addEventListener('change', evt => {
                evt.stopPropagation();
            });
        });

        // As a fallback, prevent navigation if the click originated from controls
        document.querySelectorAll('.ProductCard').forEach(card => {
            card.addEventListener('click', evt => {
                const t = evt.target;
                if (t.closest('select') || t.closest('.AddToCartButton') || t.closest('.WishlistBtn')) {
                    evt.preventDefault();
                }
            });
        });
    });
    </script>

    <script src="{{ asset('js/wishlist.js') }}"></script>
    <script>
    function toggleDetailWishlist() {
        var wl = window.wishlist;
        if (!wl) return;
        var name     = window._detailProductName  || '';
        var price    = window._detailProductPrice || '';
        var image    = window._detailProductImage || '';
        var category = window._detailProductCategory || '';
        var btn = document.getElementById('detailWishlistBtn');
        if (wl.isInWishlist(name)) {
            wl.removeFromWishlist(name);
            btn.innerHTML = '&#9825; Add to Wishlist';
            btn.style.background = 'transparent';
            btn.style.borderColor = '#111';
            btn.style.color = '#111';
            wl.showToast(name + ' removed from wishlist');
        } else {
            wl.addToWishlist({ name: name, price: price, image: image, link: window.location.href, category: category });
            btn.innerHTML = '&#9829; In Wishlist';
            btn.style.background = '#fff0f0';
            btn.style.borderColor = '#e74c3c';
            btn.style.color = '#e74c3c';
            wl.showToast(name + ' added to wishlist');
        }
    }
    </script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>

    <!-- main stylesheet for the site -->
    <link rel="stylesheet" href="css/index.css">
     <!-- main JavaScript file -->
    <script src="js/index.js" defer></script>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
<!-- top navbar -->
        <div class="TopNav">
    <a href="home.html">Home</a>
    <a href="about.html">About</a>
    <a href="products.html">Products</a>
    <a href="contact.html">Contact</a>
    <!-- icons added by JS if logged in -->
    <div class="IconNav"></div>
</div>
<!-- page title -->
<h1>Your Basket</h1>
<!-- container where cart items will be shown -->
<div id="cartItems"></div>
 <!-- link to checkout page -->
<a href="checkout.html">Go to Checkout</a>

<script>
function loadCart() {
    fetch("api/get-cart.php")
        .then(r => r.json())
        .then(cart => {
            const c = document.getElementById("cartItems");
            c.innerHTML = "";

            if (!cart.items || !cart.items.length) {
                c.innerHTML = "<p>Your basket is empty.</p>";
                return;
            }

            cart.items.forEach(i => {
                c.innerHTML += `
                    <div>
                        <h3>${i.name}</h3>
                        <p>£${i.price}</p>
                        <button onclick="updateQty(${i.id}, -1)">-</button>
                        ${i.quantity}
                        <button onclick="updateQty(${i.id}, 1)">+</button>
                    </div><br>
                `;
            });
        });
}

function updateQty(id, change) {
    fetch("api/update-cart.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({productId: id, change})
    }).then(loadCart);
}

        loadCart();
        </script>

        </div>
<!-- footer area -->
        <div id="site-footer">
            <footer class="footer">
                <!-- social media icons -->
                <div class="FooterIconsContainer">
                    <img src="assets/images/FacebookIcon.png" class="FooterIcons" alt="facebook">
                    <img src="assets/images/InstagramIcon.png" class="FooterIcons" alt="instagram">
                    <img src="assets/images/YoutubeIcon.png" class="FooterIcons" alt="youtube">
                </div>
                <!-- copyright -->
                <p class="ContactTitle">© 2025 Luxury Jewelry Store</p>
            </footer>
        </div>
        <!-- duplicate JS include (can stay, but not necessary) -->
        <script src="js/index.js" defer></script>
    </div>
</body>
</html>

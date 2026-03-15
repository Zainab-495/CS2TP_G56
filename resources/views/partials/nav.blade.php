<div class="TopNav">
    <a class="logo-link" href="/" aria-label="Skyrose Atelier home">
        <img class="header-logo" src="{{ asset('images/logo Skyrose.jpg') }}" alt="Skyrose Atelier logo">
    </a>
    <a href="/">Home</a>
    <a href="/about">About</a>
    <a href="/products">Products</a>
    <a href="/contact">Contact</a>
    <div class="IconNav">
        <a class="NavSearch" href="/products#searchInput" aria-label="Search">
            <img src="{{ asset('images/SearchIcon.png') }}" alt="Search">
        </a>
        <div id="auth-buttons">
            <a href="/login" aria-label="Login"><img src="{{ asset('images/ProfileIcon.png') }}" alt="Login"></a>
            <a href="/cart" aria-label="Cart">
                <img src="{{ asset('images/CartIcon.png') }}" alt="Cart">
                <span id="cart-count" style="display:inline-block;margin-left:6px;color:#111;">0</span>
            </a>
        </div>
    </div>
</div>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- top navigation bar -->
    <div class="page-wrapper">
        <div class="PageContent">
            <header class="TopNav">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ url('/contact') }}">Contact</a>
                 <!-- login/cart icons handled by JS -->
                <div class="IconNav" id="auth-buttons"></div>
            </header>
 <!-- login form area -->
            <div class="AuthPage">
                <div class="AuthCard">
                     <!-- login title -->
        <h1 class="AuthTitle">Login</h1>
        <!-- login form -->
        <form action="{{ route('login.post') }}" method="POST" class="AuthForm" id="login-form">
            @csrf
            <!-- email input -->
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required>
          @error('email')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
          @enderror

<!-- password input -->
          <label for="password">Password</label>
          <input id="password" name="password" type="password" required>
          @error('password')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
          @enderror

<!-- submit button -->
          <button type="submit" class="AuthButton">Login</button>
 <!-- link to registration page -->
          <p class="AuthHelp">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </form>
        <!-- error message box -->
        <div id="error-msg" class="AuthError" aria-live="polite"></div>
      </div>
    </div>

    <!-- Featured Products Section -->
    @if($products && $products->count() > 0)
    <div style="margin-top: 50px; padding: 20px;">
        <h2 style="text-align: center; margin-bottom: 30px;">Featured Products</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            @foreach($products as $product)
            <div style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 15px;">
                    <h3 style="margin: 0 0 10px 0;">{{ $product->name }}</h3>
                    <p style="color: #666; margin: 0 0 10px 0; font-size: 14px;">{{ substr($product->description, 0, 80) }}...</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 18px; font-weight: bold;">£{{ number_format($product->price, 2) }}</span>
                        <span style="background: #f0f0f0; padding: 5px 10px; border-radius: 3px; font-size: 12px;">{{ $product->category }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

 <!-- login request handling -->
    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            
            /* send login details to backend */
            fetch('{{ route("login.post") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    email: formData.get('email'),
                    password: formData.get('password'),
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    document.getElementById('error-msg').textContent = data.error;
                    document.getElementById('error-msg').classList.remove('hidden');
                }
            })
            .catch(err => {
                document.getElementById('error-msg').textContent = 'An error occurred. Please try again.';
                document.getElementById('error-msg').classList.remove('hidden');
            });
        });
    </script>
    
        </div>
 <!-- footer with social icons -->
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

    </div>
     <!-- site-wide JS -->
    <script src="js/index.js" defer></script>
</body>
</html>

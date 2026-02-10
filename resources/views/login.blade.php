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
                <a href="home.html">Home</a>
                <a href="about.html">About</a>
                <a href="products.html">Products</a>
                <a href="contact.html">Contact</a>
                 <!-- login/cart icons handled by JS -->
                <div class="IconNav" id="auth-buttons"></div>
            </header>
 <!-- login form area -->
            <div class="AuthPage">
                <div class="AuthCard">
                     <!-- login title -->
        <h1 class="AuthTitle">Login</h1>
        <!-- login form -->
        <form id="login-form" class="AuthForm">
            <!-- username/email input -->
          <label for="username">Username or Email</label>
          <input id="username" name="username" type="text" required>
<!-- password input -->
          <label for="password">Password</label>
          <input id="password" name="password" type="password" required>
<!-- submit button -->
          <button type="submit" class="AuthButton">Login</button>
 <!-- link to registration page -->
          <p class="AuthHelp">Don't have an account? <a href="register.html">Register</a></p>
        </form>
        <!-- error message box -->
        <div id="error-msg" class="AuthError" aria-live="polite"></div>
      </div>
    </div>
 <!-- login request handling -->
    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault(); // stop default form reload
            const formData = new FormData(e.target);
            
             /* send login details to backend */
            fetch('api/login.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    username: formData.get('username'),
                    password: formData.get('password')
                })
            })
            .then(res => res.json())
            .then(data => {

                // if login successful, redirect user
                if (data.success) {
                    const redirect = new URLSearchParams(window.location.search).get('redirect');
                     // send user back to cart if needed, otherwise home
                    window.location.href = redirect === 'cart' ? 'cart.html' : 'home.html';
                } else {
                     // show error message from backend
                    document.getElementById('error-msg').textContent = data.error;
                    document.getElementById('error-msg').classList.remove('hidden');
                }
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

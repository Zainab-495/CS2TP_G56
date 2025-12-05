<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            <!-- top navigation bar -->
            <header class="TopNav">
                <a href="home.html">Home</a>
                <a href="about.html">About</a>
                <a href="products.html">Products</a>
                <a href="contact.html">Contact</a>
                <div class="IconNav" id="auth-buttons"></div>
            </header>
<!-- registration layout wrapper -->
            <div class="AuthPage">
                <div class="AuthCard">
                      <!-- page title -->
        <h1 class="AuthTitle">Register</h1>
        <!-- registration form -->
        <form id="register-form" class="AuthForm">
             <!-- username field -->
          <label for="r-username">Username</label>
          <input id="r-username" name="username" type="text" required>

          <!-- email field -->
          <label for="r-email">Email</label>
          <input id="r-email" name="email" type="email" required>


          <!-- optional full name field -->
          <label for="r-fullName">Full Name (Optional)</label>
          <input id="r-fullName" name="fullName" type="text">

          <!-- password field -->
          <label for="r-password">Password</label>
          <input id="r-password" name="password" type="password" required>

          <!-- submit button -->
          <button type="submit" class="AuthButton">Register</button>

          <!-- link to login page -->
          <p class="AuthHelp">Already have an account? <a href="login.html">Login</a></p>
        </form>

        <!-- area to show validation / server error messages -->
        <div id="error-msg" class="AuthError" aria-live="polite"></div>
      </div>
    </div>

    <script>
         // handle registration form submit
        document.getElementById('register-form').addEventListener('submit', function(e) {
            e.preventDefault(); // stop normal form submit / page reload
            const formData = new FormData(e.target);
            
            // send form data to backend register API
            fetch('api/register.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    username: formData.get('username'),
                    email: formData.get('email'),
                    password: formData.get('password'),
                    fullName: formData.get('fullName')
                })
            })
            .then(res => res.json())
            .then(data => {
                // if registration is successful, go to home page
                if (data.success) {
                    window.location.href = 'home.html';
                } else {
                    // otherwise show error message from server
                    document.getElementById('error-msg').textContent = data.error;
                    document.getElementById('error-msg').classList.remove('hidden');
                }
            });
        });
        </script>

        </div>
 <!-- footer section -->
        <div id="site-footer">
            <footer class="footer">
                <!-- social icons -->
                <div class="FooterIconsContainer">
                    <img src="assets/images/FacebookIcon.png" class="FooterIcons" alt="facebook">
                    <img src="assets/images/InstagramIcon.png" class="FooterIcons" alt="instagram">
                    <img src="assets/images/YoutubeIcon.png" class="FooterIcons" alt="youtube">
                </div>
                <!-- copyright -->
                <p class="ContactTitle">© 2025 Luxury Jewelry Store</p>
            </footer>
        </div>

    </div>
    <!-- main JS for site (header/cart etc.) -->
    <script src="js/index.js" defer></script>
</body>
</html>

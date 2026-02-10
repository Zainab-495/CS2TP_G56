<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<div class="page-wrapper">
  <div class="PageContent">

    <div class="TopNav">
        <a href="home.html">Home</a>
        <a href="about.html">About</a>
        <a href="products.html">Products</a>
        <a href="contact.html">Contact</a>
        <div class="IconNav"></div>
    </div>
<!-- main content section -->
    <main style="padding: 24px; max-width: 900px; margin: 0 auto;">
      <h1>Contact Us</h1>

<!-- contact form for user to send message -->
      <form id="contactForm" style="max-width:400px;">
        <!-- name input -->
          <label>Name:</label>
          <input type="text" id="name" required><br><br>
        <!-- email input -->
          <label>Email:</label>
          <input type="email" id="email" required><br><br>
        <!-- message box -->
          <label>Message:</label>
          <textarea id="message" required></textarea><br><br>
        <!-- submit button -->
          <button type="submit">Send Message</button>
      </form>
        <!-- feedback message after sending -->
      <p id="response"></p>
    </main>

  </div>
<!-- social media icons -->
  <div id="site-footer">
    <footer class="footer">
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

<script>
  /* handle form submit without refreshing the page */
document.getElementById("contactForm").addEventListener("submit", e => {
    e.preventDefault(); // stop normal form submission


 /* send the form data to the backend API */
    fetch("api/contact.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({
            name: name.value,
            email: email.value,
            message: message.value
        })
    })
    .then(r => r.json())
    .then(d => {
      // show success or error message from backend
        response.textContent = d.message;
    })
     // fallback message if something fails
    .catch(()=>{ response.textContent = 'Failed to send message.'; });
});
</script>
<!-- general site JavaScript -->
<script src="js/index.js" defer></script>
</body>
</html>

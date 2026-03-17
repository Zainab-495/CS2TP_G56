<!DOCTYPE html>
<html lang="en">

   <style>
        /* ========ZAk styling ======== */
        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            background: #ffffff;
            color: #222222;
            line-height: 1.7;
        }

        h1,
        h2,
        h3 {
            font-family: "Playfair Display", serif;
            margin: 0;
        }

        .section-title {
            font-size: 2.4rem;
            text-align: center;
            margin-bottom: 10px;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto 30px;
            color: #555;
        }

        /* ======== Dashboard Boxes ======== */
        .dashboard-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .dashboard-box {
            background: white;
            padding: 40px;
            border-radius: 8px;
            border: 1px solid #eee;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dashboard-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .dashboard-box h2 {
            font-size: 1.8rem;
            color: #b89b5e;
            margin-bottom: 15px;
        }

        .dashboard-box p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 25px;
        }

        .dashboard-box a {
            background: #b89b5e;
            color: white;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
            display: inline-block;
        }

        .dashboard-box a:hover {
            background: #a58954;
        }

        /* ======== zak Navbar  ======== */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 60px;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            background: #ffffff;
            z-index: 1000;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .nav-links li {
            display: inline-block;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 6px 10px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #b89b5e;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 18px 25px;
            }

            .dashboard-container {
                padding: 40px 15px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.9rem;
            }
        }
    </style>
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<div class="page-wrapper">
  <div class="PageContent">

    <div class="TopNav">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/about') }}">About</a>
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('contact.show') }}">Contact</a>
        <div class="IconNav"></div>
    </div>
<!-- main content section -->
    <main style="padding: 24px; max-width: 900px; margin: 0 auto;">
      <h1>Contact Us</h1>

<!-- contact form for user to send message -->
      <form action="{{ route('contact.submit') }}" method="POST" id="contactForm" style="max-width:400px;">
        @csrf
        <!-- name input -->
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required value="{{ old('name') }}">
          @error('name')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
          @enderror
          <br><br>
        <!-- email input -->
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required value="{{ old('email') }}">
          @error('email')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
          @enderror
          <br><br>
        <!-- message box -->
          <label for="message">Message:</label>
          <textarea id="message" name="message" required style="min-height: 150px;">{{ old('message') }}</textarea>
          @error('message')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
          @enderror
          <br><br>
        <!-- submit button -->
          <button type="submit" style="padding: 10px 20px; background: #333; color: white; border: none; border-radius: 3px; cursor: pointer;">Send Message</button>
      </form>
        <!-- feedback message after sending -->
      <p id="response" style="margin-top: 20px; padding: 10px; border-radius: 3px;"></p>
    </main>

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
                    <a href="{{ route('products.show', $product->id) }}" style="display: block; margin-top: 10px; padding: 8px; background: #333; color: white; text-decoration: none; border-radius: 3px; text-align: center;">View Product</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

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
    e.preventDefault();

    const formData = new FormData(e.target);

    /* send the form data to the backend API */
    fetch("{{ route('contact.submit') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            name: formData.get('name'),
            email: formData.get('email'),
            message: formData.get('message'),
            _token: "{{ csrf_token() }}"
        })
    })
    .then(r => r.json())
    .then(d => {
      // show success or error message from backend
        const responseEl = document.getElementById('response');
        if (d.success) {
            responseEl.textContent = d.message;
            responseEl.style.background = '#d4edda';
            responseEl.style.color = '#155724';
            document.getElementById('contactForm').reset();
        } else {
            responseEl.textContent = d.error || 'An error occurred';
            responseEl.style.background = '#f8d7da';
            responseEl.style.color = '#721c24';
        }
    })
     // fallback message if something fails
    .catch(err => {
        const responseEl = document.getElementById('response');
        responseEl.textContent = 'Failed to send message.';
        responseEl.style.background = '#f8d7da';
        responseEl.style.color = '#721c24';
    });
});
</script>
<!-- general site JavaScript -->
<script src="js/index.js" defer></script>
</body>
</html>

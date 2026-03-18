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
    <title>Contact Us &ndash; Skyrose Atelier</title>
    @include('partials.head')
</head>
<body>
<div class="page-wrapper">
    <div class="PageContent">
        @include('partials.nav')

        <main class="contact-page">
            <section class="contact-info-strip">
                <div class="contact-info-card">
                    <div class="contact-info-icon"><img src="{{ asset('images/MailIcon.png') }}"></div>
                    <div class="contact-info-text">
                        <h3>Email</h3>
                        <p>hello@SkyroseAtelier.com</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon"><img src="{{ asset('images/PhoneIcon.png') }}"></div>
                    <div class="contact-info-text">
                        <h3>Phone</h3>
                        <p>+44 0000 000 000</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon"><img src="{{ asset('images/LocationIcon.png') }}"></div>
                    <div class="contact-info-text">
                        <h3>Location</h3>
                        <p>Birmingham, United Kingdom</p>
                    </div>
                </div>
            </section>

            <section class="contact-main-section">
                <div class="contact-form-card">
                    <h1>Contact Us</h1>
                    <form id="contactForm">
                        <div class="form-row two-cols">
                            <div class="field">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" placeholder="Enter your name" required>
                            </div>
                            <div class="field">
                                <label for="email">Email</label>
                                <input type="email" id="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                        <div class="field">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" placeholder="Enter your number">
                        </div>
                        <div class="field">
                            <label for="message">Message</label>
                            <textarea id="message" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="contact-submit">Send Message</button>
                    </form>
                    <p id="response" class="contact-response"></p>
                </div>
                <div class="contact-image-card">
                    <img src="{{ asset('images/MapIcon.png') }}" alt="Map showing our location" class="contact-main-image">
                </div>
            </section>
        </main>
    </div>

    @include('partials.footer')
</div>

<script>
const contactForm  = document.getElementById('contactForm');
const nameInput    = document.getElementById('name');
const emailInput   = document.getElementById('email');
const messageInput = document.getElementById('message');
const responseEl   = document.getElementById('response');
const csrfToken    = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

contactForm.addEventListener('submit', e => {
    e.preventDefault();
    fetch('/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ name: nameInput.value, email: emailInput.value, message: messageInput.value })
    })
    .then(r => r.json())
    .then(d => { responseEl.textContent = d.message || 'Message sent!'; })
    .catch(() => { responseEl.textContent = 'Failed to send message.'; });
});
</script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
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
                        <p>hello@SykroseAtelier.com</p>
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



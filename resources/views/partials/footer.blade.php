<div id="site-footer">
    <footer class="footer" role="contentinfo">
        <div class="footer-inner">
            <div class="footer-brand">
                <p class="footer-eyebrow">Skyrose Atelier</p>
                <h2 class="footer-title">Timeless pieces, crafted to be lived in.</h2>
                <p class="footer-tagline">Fine jewelry designed in the heart of Birmingham and made to celebrate every chapter of your story.</p>
                <div class="FooterIconsContainer">
                    <a href="#" aria-label="Visit our Facebook">
                        <img class="FooterIcons" src="{{ asset('images/FacebookIcon.png') }}" alt="Facebook">
                    </a>
                    <a href="#" aria-label="Visit our Instagram">
                        <img class="FooterIcons" src="{{ asset('images/InstagramIcon.png') }}" alt="Instagram">
                    </a>
                    <a href="#" aria-label="Visit our YouTube">
                        <img class="FooterIcons" src="{{ asset('images/YoutubeIcon.png') }}" alt="YouTube">
                    </a>
                </div>
            </div>

            <div class="footer-column">
                <h3>Visit &amp; Contact</h3>
                <ul class="footer-list">
                    <li>
                        <img src="{{ asset('images/LocationIcon.png') }}" alt="" class="footer-list-icon">
                        <span>Birmingham, United Kingdom</span>
                    </li>
                    <li>
                        <img src="{{ asset('images/PhoneIcon.png') }}" alt="" class="footer-list-icon">
                        <a href="tel:+440000000000">+44 0000 000 000</a>
                    </li>
                    <li>
                        <img src="{{ asset('images/MailIcon.png') }}" alt="" class="footer-list-icon">
                        <a href="mailto:hello@SykroseAtelier.com">hello@SykroseAtelier.com</a>
                    </li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Customer Care</h3>
                <ul class="footer-list">
                    <li class="footer-inline-links">
                        <a href="/contact">Consultations</a>
                        <span aria-hidden="true">•</span>
                        <a href="/wishlist">Wishlist</a>
                        <span aria-hidden="true">•</span>
                        <a href="/products">Products</a>
                        <span aria-hidden="true">•</span>
                        <a href="/">Home</a>
                    </li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Hours</h3>
                <ul class="footer-list">
                    <li class="footer-hours">
                        <span class="footer-hours-day">Mon–Fri</span>
                        <span class="footer-hours-time">10:00–18:00</span>
                    </li>
                    <li class="footer-hours">
                        <span class="footer-hours-day">Saturday</span>
                        <span class="footer-hours-time">10:00–16:00</span>
                    </li>
                    <li class="footer-hours">
                        <span class="footer-hours-day">Sunday</span>
                        <span class="footer-hours-time">Closed</span>
                    </li>
                </ul>
                <a class="footer-cta" href="/contact">Plan your visit</a>
            </div>
        </div>

        <div class="FooterCopyright">
            <span>&copy; <span id="year"></span> Skyrose Atelier. Handcrafted with care.</span>
        </div>
    </footer>
</div>
<script>try { document.getElementById('year').textContent = new Date().getFullYear(); } catch(e){}</script>
<script src="{{ asset('js/index.js') }}" defer></script>

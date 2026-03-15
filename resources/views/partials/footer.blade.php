<div id="site-footer">
    <footer class="footer" role="contentinfo">
        <div class="ContactUs">
            <h2 class="ContactTitle">Contact Skyrose Atelier</h2>
            <a href="/contact">Contact Us</a>
            <div class="FooterIconsContainer">
                <img class="FooterIcons" src="{{ asset('images/FacebookIcon.png') }}" alt="Facebook">
                <img class="FooterIcons" src="{{ asset('images/InstagramIcon.png') }}" alt="Instagram">
                <img class="FooterIcons" src="{{ asset('images/YoutubeIcon.png') }}" alt="YouTube">
            </div>
        </div>
        <div class="FooterCopyright">&copy; <span id="year"></span> Skyrose Atelier</div>
    </footer>
</div>
<script>try { document.getElementById('year').textContent = new Date().getFullYear(); } catch(e){}</script>
<script src="{{ asset('js/index.js') }}" defer></script>



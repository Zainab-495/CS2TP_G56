// Central site JS: footer loader + small shared behaviors
(function(){
  // Footer loading removed — pages include an inline footer to avoid duplicates

  // --- Auth UI injection ---
  function initAuth(){
    fetch('api/check-auth.php')
      .then(r => r.json())
      .then(data => {
        const iconNav = document.querySelector('.IconNav') || document.querySelector('#auth-buttons');
        if (!iconNav) return;
        if (data.loggedIn) {
          iconNav.innerHTML = `<span style="margin-right:16px;color:#111;">Hello, ${escapeHtml(data.username)}</span>
                               <a href="#" id="logoutBtn" style="margin-right:10px">Logout</a>
                               <a href="cart.html"><img src="assets/images/CartIcon.png" alt="Cart"></a>`;
          const lb = document.getElementById('logoutBtn');
          if (lb) lb.addEventListener('click', e => {
            e.preventDefault();
            if (window.logout) window.logout();
            else fetch('api/logout.php').then(()=> location.reload());
          });
        } else {
          iconNav.innerHTML = `<a href="login.html"><img src="assets/images/ProfileIcon.png" alt="Login"></a>
                               <a href="register.html" style="margin-left:8px">Register</a>
                               <a href="cart.html"><img src="assets/images/CartIcon.png" alt="Cart"></a>`;
        }
      })
      .catch(()=>{});
    function escapeHtml(s){ return String(s).replace(/[&<>"']/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c])); }
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', function(){ initAuth(); });
  else { initAuth(); }

  // fallback global logout if page doesn't define one
  if (!window.logout){
    window.logout = function(){
      fetch('api/logout.php').then(()=> location.reload());
    };
  }
})();

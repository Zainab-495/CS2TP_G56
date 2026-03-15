// Central site JS: auth UI + shared behaviors
(function(){
  // Get CSRF token from meta tag (required for Laravel POST requests)
  function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
  }

  // --- Session initialization (get cart count) ---
  function initSession(){
    fetch('/session/init', { credentials: 'include' })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          const cartCountEl = document.getElementById('cart-count');
          if (cartCountEl && data.cartCount !== undefined) {
            cartCountEl.textContent = data.cartCount;
          }
        }
      })
      .catch(err => console.error('Session init error:', err));
  }

  // --- Auth UI injection ---
  function initAuth(){
    fetch('/auth/status', { credentials: 'include' })
      .then(r => r.json())
      .then(data => {
        const iconNav = document.getElementById('auth-buttons') || document.querySelector('.IconNav');
        if (!iconNav) return;
        if (data.loggedIn) {
          iconNav.innerHTML = `<span style="margin-right:16px;color:#111;">Hello, ${escapeHtml(data.username)}</span>
                               <a href="/profile" aria-label="My Profile" style="margin-right:10px"><img src="/images/ProfileIcon.png" alt="Profile" style="width:28px;height:28px;vertical-align:middle;"></a>
                               <a href="#" id="logoutBtn" style="margin-right:10px">Logout</a>
                               <a href="/cart"><img src="/images/CartIcon.png" alt="Cart"><span id="cart-count" style="display:inline-block;margin-left:6px;color:#111;">0</span></a>`;
          const lb = document.getElementById('logoutBtn');
          if (lb) lb.addEventListener('click', e => {
            e.preventDefault();
            fetch('/logout', {
              method: 'POST',
              credentials: 'include',
              headers: { 'X-CSRF-TOKEN': getCsrfToken(), 'Content-Type': 'application/json' }
            }).then(() => location.href = '/');
          });
        } else {
          iconNav.innerHTML = `<a href="/login"><img src="/images/ProfileIcon.png" alt="Login"></a>
                               <a href="/register" style="margin-left:8px">Register</a>
                               <a href="/cart"><img src="/images/CartIcon.png" alt="Cart"><span id="cart-count" style="display:inline-block;margin-left:6px;color:#111;">0</span></a>`;
        }
      })
      .catch(()=>{});
    function escapeHtml(s){ return String(s).replace(/[&<>"']/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c])); }
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', function(){ initSession(); initAuth(); });
  else { initSession(); initAuth(); }

  // fallback global logout
  if (!window.logout){
    window.logout = function(){
      fetch('/logout', {
        method: 'POST',
        credentials: 'include',
        headers: { 'X-CSRF-TOKEN': getCsrfToken(), 'Content-Type': 'application/json' }
      }).then(() => location.href = '/');
    };
  }
})();

// Product price database
const productPrices = {
  'Buta Ring': 185,
  'Saphire Ring': 420,
  'Rose Gold Ring': 385,
  'Vintage Ring': 650,
  'Diamond Ring': 550,
  'Threadbare Earrings': 120,
  'Diamond Earrings': 480,
  'Gold Hoop': 195,
  'Pearl Drop': 275,
  'Silver Stud': 145,
  'Bleeding Heart Bracelet': 245,
  'Gold Bangle': 380,
  'Cuban Bracelet': 520,
  'Charm Bracelet': 310,
  'Leather Bracelet': 175,
  'Signature Necklace': 380,
  'Diamond Choker': 720,
  'Pearl Necklace': 420,
  'Gold Necklace': 540,
  'Layered Necklace': 340,
  'Gold Watch': 650,
  'Sport Watch': 290,
  'Silver Watch': 410,
  'Classic Leather Watch': 350,
  'Luxury Watch': 850
};

function getCsrfToken() {
  const meta = document.querySelector('meta[name="csrf-token"]');
  return meta ? meta.getAttribute('content') : '';
}

// Quick add to cart function
function addToCartQuick(event, productName, quantity) {
  event.preventDefault();
  event.stopPropagation();

  const price = productPrices[productName] || 0;
  if (price === 0) {
    alert('Error: Product price not found for "' + productName + '".');
    return;
  }

  const payload = {
    productName: productName,
    quantity: quantity || 1,
    price: price
  };

  fetch('/cart/add', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCsrfToken()
    },
    credentials: 'include',
    body: JSON.stringify(payload)
  })
  .then(r => {
    if (!r.ok) return r.text().then(text => { throw new Error('HTTP ' + r.status + ': ' + text); });
    return r.json();
  })
  .then(data => {
    if (data.success) {
      const btn = event.target;
      const originalText = btn.textContent;
      btn.textContent = '✓ Added!';
      btn.style.background = '#2e7d32';
      btn.style.color = 'white';
      setTimeout(() => {
        btn.textContent = originalText;
        btn.style.background = '';
        btn.style.color = '';
      }, 2000);
      const cartCount = document.getElementById('cart-count');
      if (cartCount && data.cartCount) cartCount.textContent = data.cartCount;
      alert(productName + ' added to basket!');
    } else {
      alert('Error: ' + (data.error || 'Failed to add to basket'));
    }
  })
  .catch(err => {
    console.error('Fetch error:', err);
    alert('Error adding to basket: ' + err.message);
  });
}

window.addToCartWithQuantity = function(event, productName, quantitySelectId) {
  event.preventDefault();
  event.stopPropagation();
  const quantitySelect = document.getElementById(quantitySelectId);
  if (!quantitySelect) { alert('Quantity selector not found'); return; }
  const quantity = parseInt(quantitySelect.value) || 1;
  addToCartQuick(event, productName, quantity);
};

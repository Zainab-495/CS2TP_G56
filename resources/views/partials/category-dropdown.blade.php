@php $active = $active ?? ''; @endphp
<style>
    .CategoryDropdownWrap {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 24px;
        margin-top: 40px;
        background: #fff;
        border-bottom: 1px solid #e8e0d0;
    }
    .CategoryDropdownLabel {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        white-space: nowrap;
    }
    .CategoryDropdown {
        position: relative;
        display: inline-block;
    }
    .CategoryDropdownBtn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        background: #111;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        letter-spacing: 0.3px;
        transition: background 0.2s;
    }
    .CategoryDropdownBtn:hover { background: #333; }
    .CategoryDropdownBtn svg { transition: transform 0.2s; }
    .CategoryDropdownBtn.open svg { transform: rotate(180deg); }
    .CategoryDropdownMenu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        min-width: 160px;
        background: #fff;
        border: 1px solid #e8e0d0;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.10);
        z-index: 200;
        overflow: hidden;
    }
    .CategoryDropdownMenu.open { display: block; }
    .CategoryDropdownMenu a {
        display: block;
        padding: 11px 18px;
        font-size: 14px;
        color: #222;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
    }
    .CategoryDropdownMenu a:hover,
    .CategoryDropdownMenu a.active {
        background: #f5f0e8;
        color: #d4af37;
        font-weight: 700;
    }
    .CategoryDropdownMenu a + a { border-top: 1px solid #f0ebe0; }
</style>

<div class="CategoryDropdownWrap">
    <span class="CategoryDropdownLabel">Shop By Category</span>
    <div class="CategoryDropdown" id="categoryDropdown">
        <button class="CategoryDropdownBtn" id="categoryDropdownBtn" type="button" aria-haspopup="true" aria-expanded="false">
            {{ ucfirst($active ?: 'All Categories') }}
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="CategoryDropdownMenu" id="categoryDropdownMenu" role="menu">
            <a href="/products"              role="menuitem" class="{{ $active === ''          ? 'active' : '' }}">All</a>
            <a href="/category/rings"        role="menuitem" class="{{ $active === 'rings'     ? 'active' : '' }}">Rings</a>
            <a href="/category/earrings"     role="menuitem" class="{{ $active === 'earrings'  ? 'active' : '' }}">Earrings</a>
            <a href="/category/bracelets"    role="menuitem" class="{{ $active === 'bracelets' ? 'active' : '' }}">Bracelets</a>
            <a href="/category/necklaces"    role="menuitem" class="{{ $active === 'necklaces' ? 'active' : '' }}">Necklaces</a>
            <a href="/category/watches"      role="menuitem" class="{{ $active === 'watches'   ? 'active' : '' }}">Watches</a>
        </div>
    </div>
</div>

<script>
    (function() {
        var btn  = document.getElementById('categoryDropdownBtn');
        var menu = document.getElementById('categoryDropdownMenu');
        if (!btn || !menu) return;
        btn.addEventListener('click', function() {
            var open = menu.classList.toggle('open');
            btn.classList.toggle('open', open);
            btn.setAttribute('aria-expanded', open);
        });
        document.addEventListener('click', function(e) {
            if (!document.getElementById('categoryDropdown').contains(e.target)) {
                menu.classList.remove('open');
                btn.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>

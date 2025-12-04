// Loads footer partial into #site-footer
(function(){
  const placeholderId = 'site-footer';
  function loadFooter(){
    fetch('partials/footer.html')
      .then(r => {
        if (!r.ok) throw new Error('Footer not found');
        return r.text();
      })
      .then(html => {
        let el = document.getElementById(placeholderId);
        if (!el){
          el = document.createElement('div');
          el.id = placeholderId;
          document.body.appendChild(el);
        }
        el.innerHTML = html;
      })
      .catch(err => {
        // fallback: nothing
        console.warn('Failed to load footer:', err);
      });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', loadFooter);
  else loadFooter();
})();

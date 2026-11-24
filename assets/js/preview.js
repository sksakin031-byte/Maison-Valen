(() => {
  const toggle = document.querySelector('.mv-mobile-toggle');
  const drawer = document.getElementById('mv-mobile-drawer');
  if (toggle && drawer) {
    const closeMenu = () => {
      toggle.setAttribute('aria-expanded', 'false');
      drawer.hidden = true;
    };
    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!isOpen));
      drawer.hidden = isOpen;
    });
    drawer.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') closeMenu();
    });
  }
  document.querySelectorAll('[data-current-year]').forEach((node) => {
    node.textContent = String(new Date().getFullYear());
  });
})();

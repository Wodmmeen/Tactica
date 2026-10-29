(function () {
  'use strict';

  // === Mobile menu ===
  const mobileMenu = document.querySelector('[data-mobile-menu]');
  const burgerBtn = document.querySelector('[data-action="mobile-menu"]');

  if (burgerBtn && mobileMenu) {
    const close = () => {
      mobileMenu.setAttribute('hidden', '');
      document.body.style.overflow = '';
      burgerBtn.setAttribute('aria-expanded', 'false');
    };
    burgerBtn.addEventListener('click', () => {
      const isHidden = mobileMenu.hasAttribute('hidden');
      if (isHidden) {
        mobileMenu.removeAttribute('hidden');
        document.body.style.overflow = 'hidden';
        burgerBtn.setAttribute('aria-expanded', 'true');
      } else {
        close();
      }
    });
    mobileMenu.querySelectorAll('a').forEach((a) => a.addEventListener('click', close));
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !mobileMenu.hasAttribute('hidden')) close();
    });
  }

  // === Scroll reveal ===
  const revealTargets = document.querySelectorAll('.section__header, .category-card, .product-card, .blog-card');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    revealTargets.forEach((el) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(16px)';
      el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      observer.observe(el);
    });
  }

  console.log('[TACTICA] Build 1.2.0 — ready.');
})();
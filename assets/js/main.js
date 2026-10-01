(function () {
  'use strict';

  // === Mobile menu ===
  const mobileMenu = document.querySelector('[data-mobile-menu]');
  const burgerBtn = document.querySelector('[data-action="mobile-menu"]');

  if (burgerBtn && mobileMenu) {
    burgerBtn.addEventListener('click', () => {
      const isHidden = mobileMenu.hasAttribute('hidden');
      if (isHidden) {
        mobileMenu.removeAttribute('hidden');
        document.body.style.overflow = 'hidden';
      } else {
        mobileMenu.setAttribute('hidden', '');
        document.body.style.overflow = '';
      }
    });
  }

  // === Quick add to cart (демо) ===
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action="quick-add"]');
    if (!btn) return;

    const card = btn.closest('[data-product-id]');
    if (!card) return;

    const productId = card.dataset.productId;

    // Демо: просто визуальный фидбек
    btn.classList.add('is-added');
    btn.style.backgroundColor = 'var(--color-success)';

    // Обновляем счётчик корзины
    const counter = document.querySelector('.header__cart-count');
    if (counter) {
      counter.textContent = String(parseInt(counter.textContent || '0', 10) + 1);
    }

    setTimeout(() => {
      btn.style.backgroundColor = '';
      btn.classList.remove('is-added');
    }, 1200);

    console.log('[TACTICA] Quick add product #' + productId);
  });

  // === Favorite (демо) ===
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action="favorite"]');
    if (!btn) return;
    btn.classList.toggle('is-active');
    btn.style.color = btn.classList.contains('is-active') ? 'var(--color-danger)' : '';
  });

  // === Scenario hover (quiz cta) ===
  const scenarios = document.querySelectorAll('[data-scenario]');
  scenarios.forEach((scenario) => {
    scenario.addEventListener('mouseenter', () => {
      scenarios.forEach((s) => s.classList.remove('is-active'));
      scenario.classList.add('is-active');
    });
  });

  // === Scroll reveal (простая анимация появления) ===
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

  console.log('[TACTICA] Build 1.0.4 — ready.');
})();
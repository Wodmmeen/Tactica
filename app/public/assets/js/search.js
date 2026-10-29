(function () {
  'use strict';

  const modal = document.getElementById('search-modal');
  if (!modal) return;

  const input = modal.querySelector('.search-modal__input');
  const results = document.getElementById('search-results');

  let allProducts = null;

  function collectFromDom() {
    const cards = document.querySelectorAll('[data-product-id]');
    const out = [];
    cards.forEach((c) => {
      if (c.dataset.title) {
        out.push({
          id: c.dataset.productId,
          title: c.dataset.title,
          price: Number(c.dataset.price || 0),
          image: c.dataset.image || '',
          slug: c.dataset.slug || '',
        });
      }
    });
    return out;
  }

  async function fetchProducts() {
    if (allProducts) return allProducts;
    const fromDom = collectFromDom();
    if (fromDom.length >= 10) {
      allProducts = fromDom;
      return allProducts;
    }
    try {
      const res = await fetch('/catalog');
      const html = await res.text();
      const doc = new DOMParser().parseFromString(html, 'text/html');
      const cards = doc.querySelectorAll('[data-product-id]');
      const out = [];
      cards.forEach((c) => {
        if (c.dataset.title) {
          out.push({
            id: c.dataset.productId,
            title: c.dataset.title,
            price: Number(c.dataset.price || 0),
            image: c.dataset.image || '',
            slug: c.dataset.slug || '',
          });
        }
      });
      allProducts = out;
    } catch (e) {
      allProducts = [];
    }
    return allProducts;
  }

  async function doSearch(q) {
    const query = q.trim().toLowerCase();
    if (query.length < 2) {
      results.innerHTML = '';
      return;
    }
    const items = await fetchProducts();
    const found = items.filter((p) => p.title.toLowerCase().includes(query)).slice(0, 8);

    if (!found.length) {
      results.innerHTML = '<p class="tech-label">[NO RESULTS]</p>';
      return;
    }

    results.innerHTML = found.map((p) => `
      <a href="/product/${p.slug}" class="search-result">
        <img src="${p.image}" alt="">
        <span class="search-result__title">${p.title}</span>
        <span class="search-result__price">${new Intl.NumberFormat('ru-RU').format(p.price)} ₽</span>
      </a>
    `).join('');
  }

  function open() {
    modal.removeAttribute('hidden');
    document.body.style.overflow = 'hidden';
    setTimeout(() => input.focus(), 50);
  }
  function close() {
    modal.setAttribute('hidden', '');
    document.body.style.overflow = '';
    input.value = '';
    results.innerHTML = '';
  }

  document.addEventListener('click', (e) => {
    if (e.target.closest('[data-action="search-toggle"]')) {
      open();
      return;
    }
    if (e.target.closest('[data-action="search-close"]')) {
      close();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.hasAttribute('hidden')) close();
    if ((e.key === 'k' || e.key === 'K') && (e.metaKey || e.ctrlKey)) {
      e.preventDefault();
      open();
    }
  });

  let t = null;
  input.addEventListener('input', (e) => {
    clearTimeout(t);
    t = setTimeout(() => doSearch(e.target.value), 200);
  });
})();
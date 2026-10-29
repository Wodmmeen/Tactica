// TACTICA — Favorites (objects in localStorage)
(function () {
  'use strict';

  const KEY = 'tactica_favorites';

  function read() {
    try { return JSON.parse(localStorage.getItem(KEY) || '[]'); } catch (e) { return []; }
  }

  function write(items) {
    localStorage.setItem(KEY, JSON.stringify(items));
    document.dispatchEvent(new CustomEvent('fav:updated', { detail: items }));
    updateHearts();
  }

  function has(id) {
    return read().some((i) => String(i.id) === String(id));
  }

  function toggle(product) {
    const items = read();
    const idx = items.findIndex((i) => String(i.id) === String(product.id));
    if (idx >= 0) {
      items.splice(idx, 1);
    } else {
      items.push(product);
    }
    write(items);
  }

  function remove(id) {
    write(read().filter((i) => String(i.id) !== String(id)));
  }

  function updateHearts() {
    document.querySelectorAll('[data-action="favorite"]').forEach((btn) => {
      const card = btn.closest('[data-product-id]');
      if (!card) return;
      const active = has(card.dataset.productId);
      btn.classList.toggle('is-active', active);
      btn.style.color = active ? 'var(--color-danger)' : '';
      btn.style.borderColor = active ? 'var(--color-danger)' : '';
    });
  }

  // Клик по сердечку — собираем объект из data-*
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action="favorite"]');
    if (!btn) return;
    const card = btn.closest('[data-product-id]');
    if (!card) return;
    toggle({
      id: card.dataset.productId,
      title: card.dataset.title || '',
      price: Number(card.dataset.price || 0),
      image: card.dataset.image || '',
      slug: card.dataset.slug || '',
      category: card.dataset.category || '',
    });
  });

  document.addEventListener('DOMContentLoaded', updateHearts);
  document.addEventListener('fav:updated', updateHearts);

  window.TacticaFavorites = { read, write, has, toggle, remove, updateHearts };
})();
// TACTICA — Compare module
(function () {
  'use strict';

  const STORAGE_KEY = 'tactica_compare';
  const MAX = 4;

  function read() {
    try {
      const raw = localStorage.getItem(STORAGE_KEY);
      return raw ? JSON.parse(raw) : [];
    } catch (e) { return []; }
  }

  function write(ids) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
    document.dispatchEvent(new CustomEvent('compare:updated', { detail: ids }));
    updateBadge();
  }

  function toggle(id) {
    let ids = read();
    const s = String(id);
    if (ids.includes(s)) {
      ids = ids.filter((x) => x !== s);
    } else {
      if (ids.length >= MAX) {
        alert('Можно сравнить не более ' + MAX + ' товаров');
        return ids;
      }
      ids.push(s);
    }
    write(ids);
    return ids;
  }

  function has(id) {
    return read().includes(String(id));
  }

  function updateBadge() {
    const ids = read();
    // подсветка кнопок compare на карточках
    document.querySelectorAll('[data-action="compare"]').forEach((btn) => {
      const card = btn.closest('[data-product-id]');
      if (!card) return;
      const isActive = ids.includes(String(card.dataset.productId));
      btn.style.color = isActive ? 'var(--color-accent)' : '';
      btn.style.borderColor = isActive ? 'var(--color-accent)' : '';
    });
  }

  document.addEventListener('compare:updated', updateBadge);
  document.addEventListener('DOMContentLoaded', updateBadge);

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action="compare"]');
    if (!btn) return;
    const card = btn.closest('[data-product-id]');
    if (!card) return;
    toggle(card.dataset.productId);
  });

  window.TacticaCompare = { read, toggle, has, updateBadge };
})();
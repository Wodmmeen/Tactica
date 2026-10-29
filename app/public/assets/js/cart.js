(function () {
  'use strict';

  const STORAGE_KEY = 'tactica_cart';

  function read() {
    try {
      const raw = localStorage.getItem(STORAGE_KEY);
      return raw ? JSON.parse(raw) : [];
    } catch (e) {
      return [];
    }
  }

  function write(items) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    document.dispatchEvent(new CustomEvent('cart:updated', { detail: items }));
  }

  function add(product) {
    const items = read();
    const existing = items.find((i) => String(i.id) === String(product.id));
    if (existing) {
      existing.qty += 1;
    } else {
      items.push({
        id: product.id,
        title: product.title,
        price: Number(product.price),
        image: product.image,
        slug: product.slug,
        qty: 1,
      });
    }
    write(items);
    return items;
  }

  function remove(id) {
    const items = read().filter((i) => String(i.id) !== String(id));
    write(items);
    return items;
  }

  function setQty(id, qty) {
    const items = read();
    const item = items.find((i) => String(i.id) === String(id));
    if (!item) return items;
    item.qty = Math.max(1, Math.min(99, parseInt(qty, 10) || 1));
    write(items);
    return items;
  }

  function clear() {
    write([]);
  }

  function count() {
    return read().reduce((sum, i) => sum + i.qty, 0);
  }

  function total() {
    return read().reduce((sum, i) => sum + i.price * i.qty, 0);
  }

  function updateBadge() {
    const el = document.querySelector('.header__cart-count');
    if (!el) return;
    const n = count();
    el.textContent = String(n);
    el.style.display = n > 0 ? '' : 'none';
    el.style.transform = 'scale(1.4)';
    setTimeout(() => { el.style.transform = 'scale(1)'; }, 150);
  }

  document.addEventListener('cart:updated', updateBadge);
  document.addEventListener('DOMContentLoaded', updateBadge);

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action="add-to-cart"], [data-action="quick-add"]');
    if (!btn || btn.disabled) return;

    const card = btn.closest('[data-product-id]');
    if (!card) return;

    const data = card.dataset;
    add({
      id: data.productId,
      title: data.title || '',
      price: data.price || 0,
      image: data.image || '',
      slug: data.slug || '',
    });

    const originalBg = btn.style.backgroundColor;
    btn.style.backgroundColor = 'var(--color-success)';
    setTimeout(() => { btn.style.backgroundColor = originalBg; }, 800);
  });

  window.TacticaCart = { read, add, remove, setQty, clear, count, total, updateBadge };
})();
<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Корзина — TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container">
      <div class="section__header">
        <h1 class="section__title">КОРЗИНА</h1>
        <span class="tech-label" id="cart-count-label">[0 ITEMS]</span>
      </div>

      <div id="cart-root">
        <div class="skeleton" style="height:80px;margin-bottom:16px;"></div>
        <div class="skeleton" style="height:80px;margin-bottom:16px;"></div>
        <div class="skeleton" style="height:80px;"></div>
      </div>

      <div id="cart-summary" style="display:none;margin-top:32px;padding-top:24px;border-top:1px solid var(--color-border-light);">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;">
          <div>
            <p class="footer__heading" style="color:var(--color-text-muted);">Итого</p>
            <p style="font-family:var(--font-mono);font-size:32px;font-weight:600;" id="cart-total">0 ₽</p>
          </div>
          <div style="display:flex;gap:12px;">
            <button class="btn btn--secondary" id="cart-clear">Очистить</button>
            <button class="btn btn--primary" id="cart-checkout">Оформить заказ</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>

  <script src="/assets/js/theme.js"></script>
  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/favorites.js"></script>
  <script src="/assets/js/compare.js"></script>
  <script src="/assets/js/search.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    (function () {
      const root = document.getElementById('cart-root');
      const summary = document.getElementById('cart-summary');
      const totalEl = document.getElementById('cart-total');
      const countLabel = document.getElementById('cart-count-label');

      function render() {
        const items = TacticaCart.read();
        countLabel.textContent = '[' + items.reduce((s, i) => s + i.qty, 0) + ' ITEMS]';

        if (!items.length) {
          root.innerHTML = '<p class="tech-label">[EMPTY] / Корзина пуста. <a href="/catalog" class="section__link">В каталог →</a></p>';
          summary.style.display = 'none';
          return;
        }

        summary.style.display = '';
        totalEl.textContent = new Intl.NumberFormat('ru-RU').format(TacticaCart.total()) + ' ₽';

        root.innerHTML = items.map((i) => `
          <div class="cart-item" data-id="${i.id}" style="display:grid;grid-template-columns:80px 1fr auto;gap:16px;align-items:center;padding:16px 0;border-bottom:1px solid var(--color-border-light);">
            <img src="${i.image}" alt="" style="width:80px;height:80px;object-fit:cover;background:var(--color-bg-surface);border:1px solid var(--color-border-light);">
            <div>
              <a href="/product/${i.slug}" style="font-weight:600;color:var(--color-text-primary);">${i.title}</a>
              <p style="font-family:var(--font-mono);font-size:12px;color:var(--color-text-muted);margin-top:4px;">${new Intl.NumberFormat('ru-RU').format(i.price)} ₽ / шт</p>
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
              <button class="btn btn--secondary btn--icon" data-qty="-1" style="width:32px;height:32px;">−</button>
              <span style="font-family:var(--font-mono);min-width:32px;text-align:center;">${i.qty}</span>
              <button class="btn btn--secondary btn--icon" data-qty="1" style="width:32px;height:32px;">+</button>
              <button class="btn btn--ghost" data-remove style="margin-left:8px;color:var(--color-danger);">✕</button>
            </div>
          </div>
        `).join('');
      }

      root.addEventListener('click', (e) => {
        const row = e.target.closest('.cart-item');
        if (!row) return;
        const id = row.dataset.id;

        const qtyBtn = e.target.closest('[data-qty]');
        if (qtyBtn) {
          const delta = parseInt(qtyBtn.dataset.qty, 10);
          const item = TacticaCart.read().find((i) => String(i.id) === id);
          if (item) TacticaCart.setQty(id, item.qty + delta);
          render();
          return;
        }

        if (e.target.closest('[data-remove]')) {
          TacticaCart.remove(id);
          render();
        }
      });

      document.getElementById('cart-clear').addEventListener('click', () => {
        if (confirm('Очистить корзину?')) {
          TacticaCart.clear();
          render();
        }
      });

      document.getElementById('cart-checkout').addEventListener('click', () => {
        alert('[DEMO] Заказ оформлен. В проде — редирект на /checkout.');
      });

      document.addEventListener('cart:updated', render);
      render();
    })();
  </script>
</body>
</html>
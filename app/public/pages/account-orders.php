<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Мои заказы — TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container">
      <div class="section__header">
        <h1 class="section__title">МОИ ЗАКАЗЫ</h1>
        <span class="tech-label" id="orders-count">[0 ORDERS]</span>
      </div>

      <div id="orders-root">
        <div class="skeleton" style="height:150px;margin-bottom:16px;"></div>
        <div class="skeleton" style="height:150px;"></div>
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
      const root = document.getElementById('orders-root');
      const countEl = document.getElementById('orders-count');

      function fmt(n) { return new Intl.NumberFormat('ru-RU').format(n) + ' ₽'; }
      function fmtDate(iso) {
        try {
          return new Date(iso).toLocaleString('ru-RU', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        } catch (e) { return iso; }
      }

      function render() {
        let orders = [];
        try { orders = JSON.parse(localStorage.getItem('tactica_orders') || '[]'); } catch (e) {}

        countEl.textContent = '[' + orders.length + ' ORDERS]';

        if (!orders.length) {
          root.innerHTML = '<p class="tech-label">[EMPTY] / Заказов пока нет. <a href="/catalog" class="section__link">В каталог →</a></p>';
          return;
        }

        root.innerHTML = orders.map((o) => `
          <div style="background:var(--color-bg-surface);border:1px solid var(--color-border-light);padding:24px;margin-bottom:16px;">
            <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid var(--color-border-light);">
              <div>
                <p style="font-family:var(--font-mono);font-weight:600;">${o.id}</p>
                <p class="tech-label" style="margin-top:4px;">[${fmtDate(o.date)}]</p>
              </div>
              <div style="text-align:right;">
                <p class="footer__heading" style="color:var(--color-text-muted);">Сумма</p>
                <p style="font-family:var(--font-mono);font-size:18px;font-weight:600;">${fmt(o.total)}</p>
              </div>
            </div>
            <div style="font-family:var(--font-mono);font-size:13px;">
              ${(o.items || []).map((i) => `<div style="display:flex;justify-content:space-between;padding:4px 0;"><span>${i.title} × ${i.qty}</span><span>${fmt(i.price * i.qty)}</span></div>`).join('')}
            </div>
            <div style="margin-top:16px;padding-top:16px;border-top:1px solid var(--color-border-light);font-family:var(--font-mono);font-size:12px;color:var(--color-text-muted);">
              ${o.customer && o.customer.name ? 'Получатель: ' + o.customer.name : ''}
              ${o.customer && o.customer.address ? '<br>' + o.customer.address : ''}
            </div>
          </div>
        `).join('');
      }

      render();
    })();
  </script>
</body>
</html>
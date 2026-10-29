<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Оформление — TACTICA</title>
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
        <h1 class="section__title">ОФОРМЛЕНИЕ</h1>
        <span class="tech-label">[CHECKOUT]</span>
      </div>

      <div id="checkout-empty" style="display:none;">
        <p class="tech-label">[EMPTY] / Корзина пуста. <a href="/catalog" class="section__link">В каталог →</a></p>
      </div>

      <div id="checkout-root" style="display:grid;grid-template-columns:1.4fr 1fr;gap:32px;align-items:start;">
        <form id="checkout-form" style="display:flex;flex-direction:column;gap:16px;">
          <div>
            <label class="footer__heading" style="color:var(--color-text-muted);display:block;margin-bottom:6px;">Имя и фамилия</label>
            <input type="text" name="name" class="input" required placeholder="Иван Иванов">
          </div>
          <div>
            <label class="footer__heading" style="color:var(--color-text-muted);display:block;margin-bottom:6px;">Email</label>
            <input type="email" name="email" class="input" required placeholder="you@example.com">
          </div>
          <div>
            <label class="footer__heading" style="color:var(--color-text-muted);display:block;margin-bottom:6px;">Телефон</label>
            <input type="tel" name="phone" class="input" required placeholder="+7 (___) ___-__-__">
          </div>
          <div>
            <label class="footer__heading" style="color:var(--color-text-muted);display:block;margin-bottom:6px;">Адрес доставки</label>
            <textarea name="address" class="input" rows="3" required placeholder="Город, улица, дом, квартира"></textarea>
          </div>
          <div>
            <label class="footer__heading" style="color:var(--color-text-muted);display:block;margin-bottom:6px;">Комментарий</label>
            <textarea name="comment" class="input" rows="2" placeholder="Необязательно"></textarea>
          </div>

          <div>
            <p class="footer__heading" style="color:var(--color-text-muted);margin-bottom:8px;">Оплата</p>
            <label style="display:block;font-family:var(--font-mono);font-size:13px;margin-bottom:6px;">
              <input type="radio" name="payment" value="card" checked> Картой онлайн
            </label>
            <label style="display:block;font-family:var(--font-mono);font-size:13px;margin-bottom:6px;">
              <input type="radio" name="payment" value="cash"> При получении
            </label>
          </div>

          <button type="submit" class="btn btn--primary" style="margin-top:8px;">Подтвердить заказ</button>
        </form>

        <aside style="background:var(--color-bg-surface);border:1px solid var(--color-border-light);padding:24px;">
          <p class="footer__heading" style="color:var(--color-text-muted);margin-bottom:16px;">ВАШ ЗАКАЗ</p>
          <div id="checkout-items" style="margin-bottom:16px;"></div>
          <div style="display:flex;justify-content:space-between;padding-top:16px;border-top:1px solid var(--color-border-light);">
            <span class="footer__heading" style="color:var(--color-text-muted);">Итого</span>
            <span style="font-family:var(--font-mono);font-size:20px;font-weight:600;" id="checkout-total">0 ₽</span>
          </div>
        </aside>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>

  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    (function () {
      const itemsEl = document.getElementById('checkout-items');
      const totalEl = document.getElementById('checkout-total');
      const form = document.getElementById('checkout-form');
      const root = document.getElementById('checkout-root');
      const empty = document.getElementById('checkout-empty');

      function render() {
        const items = TacticaCart.read();
        if (!items.length) {
          root.style.display = 'none';
          empty.style.display = '';
          return;
        }
        root.style.display = '';
        empty.style.display = 'none';

        itemsEl.innerHTML = items.map((i) => `
          <div style="display:flex;justify-content:space-between;gap:12px;padding:8px 0;font-family:var(--font-mono);font-size:13px;">
            <span>${i.title} × ${i.qty}</span>
            <span>${new Intl.NumberFormat('ru-RU').format(i.price * i.qty)} ₽</span>
          </div>
        `).join('');

        totalEl.textContent = new Intl.NumberFormat('ru-RU').format(TacticaCart.total()) + ' ₽';
      }

      form.addEventListener('submit', (e) => {
        e.preventDefault();
        // Демо: сохраняем заказ в localStorage
        const fd = new FormData(form);
        const order = {
          id: 'ORD-' + Date.now(),
          date: new Date().toISOString(),
          customer: Object.fromEntries(fd.entries()),
          items: TacticaCart.read(),
          total: TacticaCart.total(),
        };
        const orders = JSON.parse(localStorage.getItem('tactica_orders') || '[]');
        orders.unshift(order);
        localStorage.setItem('tactica_orders', JSON.stringify(orders));
        localStorage.setItem('tactica_last_order', JSON.stringify(order));
        TacticaCart.clear();
        window.location.href = '/checkout/success';
      });

      document.addEventListener('cart:updated', render);
      render();
    })();
  </script>
  <script src="/assets/js/favorites.js"></script>
</body>
</html>

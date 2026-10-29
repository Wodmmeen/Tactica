<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Заказ оформлен — TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container" style="text-align:center;max-width:640px;">
      <p class="tech-label" style="margin-bottom:16px;">[ORDER ACCEPTED]</p>
      <h1 class="section__title" style="margin-bottom:16px;">ЗАКАЗ ОФОРМЛЕН</h1>
      <p style="color:var(--color-text-secondary);margin-bottom:8px;">Номер заказа: <strong id="order-id" style="font-family:var(--font-mono);">—</strong></p>
      <p style="color:var(--color-text-secondary);margin-bottom:32px;">Мы свяжемся с вами в течение дня для подтверждения.</p>
      <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
        <a href="/catalog" class="btn btn--primary">Продолжить покупки</a>
        <a href="/" class="btn btn--secondary">На главную</a>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <script>
    (function () {
      try {
        const order = JSON.parse(localStorage.getItem('tactica_last_order') || 'null');
        if (order && order.id) {
          document.getElementById('order-id').textContent = order.id;
        }
      } catch (e) {}
    })();
  </script>
  <script src="/assets/js/favorites.js"></script>
</body>
</html>
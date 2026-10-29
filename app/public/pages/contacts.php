<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>КОнтакты— TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container" style="max-width:800px;">
      <p class="tech-label" style="margin-bottom:16px;">[ABOUT] / [EST. 2024]</p>
      <h1 class="section__title" style="margin-bottom:24px;">О НАС</h1>

      <div style="font-size:var(--text-lg);line-height:1.8;color:var(--color-text-primary);">
        <h2 style="font-size:var(--text-2xl);margin-bottom:16px;">Контакты</h2>
        <p style="margin-bottom:16px;">Email: <a href="mailto:info@tactica.ru" style="color:var(--color-accent);">info@tactica.ru</a></p>
        <p style="margin-bottom:16px;">Телефон: <a href="tel:+78001234567" style="color:var(--color-accent);">+7 (800) 123-45-67</a></p>
        <p style="margin-bottom:16px;">Telegram: <a href="#" style="color:var(--color-accent);">@tactica</a></p>
        <p>Москва, ул. Примерная, 1. Пн–Сб, 10:00–20:00.</p>
      </div>

      <p style="margin-top:32px;">
        <a href="/contacts" class="btn btn--primary">Связаться</a>
      </p>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/favorites.js"></script>
</body>
</html>
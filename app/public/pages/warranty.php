<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Вараны — TACTICA</title>
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
       <h2 style="font-size:var(--text-2xl);margin-bottom:16px;">Гарантия</h2>
        <p style="margin-bottom:16px;">На всё снаряжение — гарантия производителя от 1 года.</p>
        <p style="margin-bottom:16px;">Возврат в течение 14 дней с момента получения, если товар не использовался.</p>
        <p>Брак — замена или возврат за наш счёт.</p>
      </div>

      <p style="margin-top:32px;">
        <a href="/contacts" class="btn btn--primary">Связаться</a>
      </p>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <script src="/assets/js/theme.js"></script>
  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/favorites.js"></script>
  <script src="/assets/js/compare.js"></script>
  <script src="/assets/js/search.js"></script>
  <script src="/assets/js/main.js"></script>
</body>
</html>
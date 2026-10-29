<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>О нас — TACTICA</title>
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
        <p style="margin-bottom:16px;">TACTICA — это магазин тактического снаряжения и EDC для тех, кто понимает, зачем ему нож, фонарь или мультитул.</p>
        <p style="margin-bottom:16px;">Мы отбираем товары вручную: тестируем, сравниваем, отбрасываем маркетинг. В каталоге — только то, что сами носим.</p>
        <p style="margin-bottom:16px;">Наша команда — бывшие военные, страйкболисты и просто люди, которые ценят надёжность. Мы знаем разницу между S30V и D2, и объясним её вам.</p>
        <p>Если сомневаетесь в выборе — напишите. Подберём под задачу и бюджет.</p>
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
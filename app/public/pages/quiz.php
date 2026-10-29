<?php
/** @var array $data */
$scenario = $_GET['scenario'] ?? null;
$budget = isset($_GET['budget']) ? (int)$_GET['budget'] : null;

$scenarios = [
    'edc' => ['key' => '[EDC]', 'title' => 'Нож на каждый день', 'desc' => 'Лёгкий, компактный, для города.'],
    'airsoft' => ['key' => '[AIRSOFT]', 'title' => 'Снаряжение для игры', 'desc' => 'Приводы, защита, аксессуары.'],
    'urban' => ['key' => '[URBAN]', 'title' => 'Городской выживальщик', 'desc' => 'Мультитул, фонарь, нож — всё с собой.'],
];

$results = [];
if ($scenario && isset($scenarios[$scenario])) {
    // Простой скоринг: категория → вес → цена.
    $scores = [];
    foreach (get_products() as $p) {
        $score = 0;
        $cat = $p['category_slug'];
        $w = (int)$p['weight_g'];
        $price = (int)$p['price'];

        if ($scenario === 'edc') {
            if ($cat === 'blades') $score += 5;
            if ($cat === 'flashlights') $score += 3;
            if ($w > 0 && $w < 120) $score += 3;
            if ($price < 15000) $score += 2;
        } elseif ($scenario === 'airsoft') {
            if ($cat === 'airsoft') $score += 5;
            if ($cat === 'accessories') $score += 3;
            if ($price < 40000) $score += 2;
        } elseif ($scenario === 'urban') {
            if ($cat === 'multitools') $score += 5;
            if ($cat === 'flashlights') $score += 3;
            if ($cat === 'blades') $score += 2;
            if ($w > 0 && $w < 250) $score += 2;
        }
        if ($budget) {
            if ($price <= $budget) $score += 2;
            else $score -= 3;
        }
        $scores[] = ['product' => $p, 'score' => $score];
    }
    usort($scores, fn($a, $b) => $b['score'] <=> $a['score']);
    $results = array_slice($scores, 0, 6);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Подбор — TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container">
      <div class="section__header">
        <h1 class="section__title">ПОДБОР СНАРЯЖЕНИЯ</h1>
        <span class="tech-label">[SMART PICK]</span>
      </div>

      <?php if (!$scenario): ?>
        <!-- Шаг 1: сценарий -->
        <p style="margin-bottom:24px;color:var(--color-text-secondary);">Выбери сценарий — покажем топ-6 под него.</p>
        <div class="quiz-cta__scenarios" style="max-width:600px;">
          <?php foreach ($scenarios as $slug => $s): ?>
            <a href="/quiz?scenario=<?= e($slug) ?>" class="scenario">
              <span class="scenario__key"><?= e($s['key']) ?></span>
              <span class="scenario__title"><?= e($s['title']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      <?php elseif (!isset($scenarios[$scenario])): ?>
        <p class="tech-label">[ERROR] / Неизвестный сценарий. <a href="/quiz" class="section__link">Назад</a></p>
      <?php else: ?>
        <!-- Шаг 2: бюджет -->
        <p style="margin-bottom:16px;color:var(--color-text-secondary);">
          Сценарий: <strong><?= e($scenarios[$scenario]['title']) ?></strong>
        </p>
        <form method="get" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:32px;align-items:end;">
          <input type="hidden" name="scenario" value="<?= e($scenario) ?>">
          <div>
            <label class="footer__heading" style="color:var(--color-text-muted);display:block;margin-bottom:6px;">Бюджет, ₽ (необязательно)</label>
            <input type="number" name="budget" class="input" style="max-width:220px;" value="<?= $budget ?: '' ?>" placeholder="напр. 20000">
          </div>
          <button class="btn btn--primary">Показать</button>
          <a href="/quiz" class="btn btn--secondary">Сбросить</a>
        </form>

        <div class="section__header">
          <h2 class="section__title" style="font-size:var(--text-2xl);">РЕКОМЕНДАЦИИ</h2>
          <span class="tech-label">[<?= count($results) ?> ITEMS]</span>
        </div>

        <?php if (!$results): ?>
          <p class="tech-label">[NO RESULTS]</p>
        <?php else: ?>
          <div class="products-grid">
            <?php foreach ($results as $row): ?>
              <?php $product = $row['product']; ?>
              <?php include __DIR__ . '/../partials/product-card.php'; ?>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
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
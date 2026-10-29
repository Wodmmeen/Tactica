<?php
/** @var array $data */
$idsParam = $_GET['ids'] ?? '';
$ids = array_filter(array_map('trim', explode(',', $idsParam)));

$products = [];
foreach ($ids as $id) {
    foreach (get_products() as $p) {
        if ((string)$p['id'] === (string)$id) { $products[] = $p; break; }
    }
}

// Объединяем ключи specs для строк таблицы
$specKeys = [];
foreach ($products as $p) {
    foreach (array_keys($p['specs'] ?? []) as $k) {
        $specKeys[$k] = true;
    }
}
$specKeys = array_keys($specKeys);

$baseFields = [
    'Бренд' => 'brand',
    'Категория' => 'category_title',
    'Вес, г' => 'weight_g',
    'Длина, мм' => 'length_mm',
    'Клинок, мм' => 'blade_mm',
    'Замок' => 'lock',
    'Сталь' => 'steel',
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Сравнение — TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container">
      <div class="section__header">
        <h1 class="section__title">СРАВНЕНИЕ</h1>
        <span class="tech-label">[<?= count($products) ?> ITEMS]</span>
      </div>

      <?php if (!$products): ?>
        <p class="tech-label">[EMPTY] / Не выбрано ни одного товара.</p>
        <p style="margin-top:16px;">
          <a href="/catalog" class="btn btn--primary">В каталог</a>
        </p>
      <?php else: ?>
        <div style="overflow-x:auto;">
          <table style="width:100%;border-collapse:collapse;font-family:var(--font-mono);font-size:14px;min-width:600px;">
            <thead>
              <tr>
                <th style="text-align:left;padding:16px;border-bottom:1px solid var(--color-border);width:180px;"></th>
                <?php foreach ($products as $p): ?>
                  <th style="text-align:left;padding:16px;border-bottom:1px solid var(--color-border);min-width:200px;">
                    <a href="/product/<?= e($p['slug']) ?>" style="display:block;">
                      <img src="<?= e($p['image']) ?>" alt="" style="width:100%;max-width:160px;aspect-ratio:1/1;object-fit:cover;background:var(--color-bg-surface);border:1px solid var(--color-border-light);margin-bottom:12px;">
                      <span style="font-family:var(--font-display);font-weight:600;font-size:15px;color:var(--color-text-primary);"><?= e($p['title']) ?></span>
                    </a>
                    <p style="margin-top:8px;font-size:18px;font-weight:600;"><?= money($p['price']) ?></p>
                  </th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($baseFields as $label => $key): ?>
                <tr>
                  <td style="padding:12px 16px;color:var(--color-text-muted);border-bottom:1px solid var(--color-border-light);"><?= e($label) ?></td>
                  <?php foreach ($products as $p): ?>
                    <td style="padding:12px 16px;border-bottom:1px solid var(--color-border-light);">
                      <?= e((string)($p[$key] ?? '—')) ?>
                    </td>
                  <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>

              <?php if ($specKeys): ?>
                <tr>
                  <td colspan="<?= count($products) + 1 ?>" style="padding:16px;font-weight:600;color:var(--color-text-primary);border-bottom:1px solid var(--color-border);background:var(--color-bg-elevated);">
                    Характеристики
                  </td>
                </tr>
                <?php foreach ($specKeys as $k): ?>
                  <tr>
                    <td style="padding:12px 16px;color:var(--color-text-muted);border-bottom:1px solid var(--color-border-light);"><?= e($k) ?></td>
                    <?php foreach ($products as $p): ?>
                      <td style="padding:12px 16px;border-bottom:1px solid var(--color-border-light);">
                        <?= e((string)($p['specs'][$k] ?? '—')) ?>
                      </td>
                    <?php endforeach; ?>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>

              <tr>
                <td style="padding:16px;"></td>
                <?php foreach ($products as $p): ?>
                  <td style="padding:16px;">
                    <button class="btn btn--primary" data-product-id="<?= (int)$p['id'] ?>" data-title="<?= e($p['title']) ?>" data-price="<?= (int)$p['price'] ?>" data-image="<?= e($p['image']) ?>" data-slug="<?= e($p['slug']) ?>" data-action="add-to-cart">
                      В корзину
                    </button>
                  </td>
                <?php endforeach; ?>
              </tr>
            </tbody>
          </table>
        </div>

        <p style="margin-top:24px;">
          <a href="/compare" class="section__link">Очистить сравнение</a>
        </p>
      <?php endif; ?>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/favorites.js"></script>
</body>
</html>
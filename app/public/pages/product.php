<?php
/** @var array $data */
$product = find_product((string)$slug);

if (!$product) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$related = array_values(array_filter(
    get_products(),
    fn($p) => $p['category_slug'] === $product['category_slug'] && $p['id'] !== $product['id']
));
$related = array_slice($related, 0, 4);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($product['title']) ?> — TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container">
      <p class="tech-label" style="margin-bottom:16px;">[PRODUCT] / <?= e($product['category_title'] ?? '') ?></p>

      <div class="product-page-grid">
        <div class="hero__visual" style="aspect-ratio:1/1;">
          <img src="<?= e($product['image']) ?>" alt="<?= e($product['title']) ?>">
        </div>

        <div
          data-product
          data-product-id="<?= (int)$product['id'] ?>"
          data-title="<?= e($product['title']) ?>"
          data-price="<?= (int)$product['price'] ?>"
          data-image="<?= e($product['image']) ?>"
          data-slug="<?= e($product['slug']) ?>"
        >
          <h1 class="section__title" style="margin-bottom:16px;"><?= e($product['title']) ?></h1>
          <p class="product-card__price" style="font-size:32px;margin-bottom:24px;">
            <?php if (!empty($product['old_price'])): ?>
              <span class="product-card__price--old"><?= money($product['old_price']) ?></span>
            <?php endif; ?>
            <?= money($product['price']) ?>
          </p>

          <table style="width:100%;margin-bottom:24px;font-family:var(--font-mono);font-size:14px;">
            <?php foreach ($product['specs'] as $k => $v): ?>
              <tr>
                <td style="padding:8px 0;color:var(--color-text-muted);"><?= e((string)$k) ?></td>
                <td style="padding:8px 0;"><?= e((string)$v) ?></td>
              </tr>
            <?php endforeach; ?>
          </table>

          <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <button
              class="btn btn--primary"
              data-action="add-to-cart"
              <?= !empty($product['in_stock']) ? '' : 'disabled style="opacity:.4;cursor:not-allowed;"' ?>
            >
              Добавить в корзину
            </button>
            <button
              class="btn btn--secondary"
              data-action="compare"
              data-product-id="<?= (int)$product['id'] ?>"
            >
              Сравнить
            </button>
          </div>
        </div>
      </div>

      <?php if ($related): ?>
        <div class="section__header" style="margin-top:64px;">
          <h2 class="section__title" style="font-size:var(--text-2xl);">ПОХОЖИЕ</h2>
          <a href="/catalog/<?= e($product['category_slug']) ?>" class="section__link">Все в категории →</a>
        </div>
        <div class="products-grid">
          <?php foreach ($related as $product): ?>
            <?php include __DIR__ . '/../partials/product-card.php'; ?>
          <?php endforeach; ?>
        </div>
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
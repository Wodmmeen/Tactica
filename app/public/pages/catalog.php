<?php
/** @var array $data */
$categorySlug = $slug;
$categories = get_categories();

$base = products_by_category($categorySlug);

$filters = [
    'steel'      => $_GET['steel'] ?? null,
    'brand'      => $_GET['brand'] ?? null,
    'weight_max' => $_GET['weight_max'] ?? null,
    'price_min'  => $_GET['price_min'] ?? null,
    'price_max'  => $_GET['price_max'] ?? null,
    'in_stock'   => !empty($_GET['in_stock']),
];
$filtered = filter_products($base, $filters);

$sort = $_GET['sort'] ?? 'popular';
$products = sort_products($filtered, $sort);

$catTitle = 'Каталог';
foreach ($categories as $c) {
    if ($c['slug'] === $categorySlug) { $catTitle = $c['title']; break; }
}

$steels = array_unique(array_filter(array_column($base, 'steel')));
$brands = array_unique(array_column($base, 'brand'));
sort($steels); sort($brands);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($catTitle) ?> — TACTICA</title>
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
        <h1 class="section__title"><?= e($catTitle) ?></h1>
        <span class="tech-label">[<?= count($products) ?> / <?= count($base) ?> ITEMS]</span>
      </div>

      <div class="catalog-layout" style="display:grid;grid-template-columns:240px 1fr;gap:32px;align-items:start;">
        <aside class="catalog-filters">
          <form method="get">
            <?php if ($categorySlug): ?>
              <input type="hidden" name="x" value="">
            <?php endif; ?>

            <div style="margin-bottom:24px;">
              <p class="footer__heading" style="color:var(--color-text-muted);">Сортировка</p>
              <select name="sort" class="input" onchange="this.form.submit()">
                <option value="popular"   <?= $sort==='popular'?'selected':'' ?>>По популярности</option>
                <option value="price_asc" <?= $sort==='price_asc'?'selected':'' ?>>Сначала дешевле</option>
                <option value="price_desc"<?= $sort==='price_desc'?'selected':'' ?>>Сначала дороже</option>
                <option value="new"       <?= $sort==='new'?'selected':'' ?>>Новинки</option>
                <option value="weight_asc"<?= $sort==='weight_asc'?'selected':'' ?>>Легче</option>
              </select>
            </div>

            <?php if ($steels): ?>
            <div style="margin-bottom:24px;">
              <p class="footer__heading" style="color:var(--color-text-muted);">Сталь</p>
              <?php foreach ($steels as $s): ?>
                <label style="display:block;font-family:var(--font-mono);font-size:12px;margin-bottom:6px;">
                  <input type="radio" name="steel" value="<?= e($s) ?>" <?= ($filters['steel']===$s)?'checked':'' ?> onchange="this.form.submit()">
                  <?= e($s) ?>
                </label>
              <?php endforeach; ?>
              <?php if ($filters['steel']): ?>
                <a href="?<?= http_build_query(array_diff_key($_GET, ['steel'=>''])) ?>" class="section__link" style="font-size:11px;">Сбросить</a>
              <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if ($brands): ?>
            <div style="margin-bottom:24px;">
              <p class="footer__heading" style="color:var(--color-text-muted);">Бренд</p>
              <?php foreach ($brands as $b): ?>
                <label style="display:block;font-family:var(--font-mono);font-size:12px;margin-bottom:6px;">
                  <input type="radio" name="brand" value="<?= e($b) ?>" <?= ($filters['brand']===$b)?'checked':'' ?> onchange="this.form.submit()">
                  <?= e($b) ?>
                </label>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div style="margin-bottom:24px;">
              <p class="footer__heading" style="color:var(--color-text-muted);">Вес до, г</p>
              <input type="number" name="weight_max" class="input" value="<?= e((string)($filters['weight_max'] ?? '')) ?>" placeholder="напр. 200" onchange="this.form.submit()">
            </div>

            <div style="margin-bottom:24px;">
              <p class="footer__heading" style="color:var(--color-text-muted);">Цена, ₽</p>
              <div style="display:flex;gap:8px;">
                <input type="number" name="price_min" class="input" value="<?= e((string)($filters['price_min'] ?? '')) ?>" placeholder="от" onchange="this.form.submit()">
                <input type="number" name="price_max" class="input" value="<?= e((string)($filters['price_max'] ?? '')) ?>" placeholder="до" onchange="this.form.submit()">
              </div>
            </div>

            <label style="display:flex;align-items:center;gap:8px;font-family:var(--font-mono);font-size:12px;">
              <input type="checkbox" name="in_stock" value="1" <?= $filters['in_stock']?'checked':'' ?> onchange="this.form.submit()">
              Только в наличии
            </label>

            <noscript><button class="btn btn--primary" style="margin-top:16px;">Применить</button></noscript>
          </form>
        </aside>

        <div>
          <?php if (!$products): ?>
            <p class="tech-label">[NO ITEMS] / Ничего не найдено. <a href="?" class="section__link">Сбросить фильтры</a></p>
          <?php else: ?>
            <div class="products-grid">
              <?php foreach ($products as $product): ?>
                <?php include __DIR__ . '/../partials/product-card.php'; ?>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <a href="/compare" class="btn btn--secondary" style="position:fixed;bottom:24px;right:24px;z-index:50;">
      Сравнить
    </a>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>

  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/compare.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/favorites.js"></script>
</body>
</html>
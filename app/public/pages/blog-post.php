<?php
/** @var array $data */
$post = null;
foreach (get_blog_posts() as $p) {
    if ($p['slug'] === $slug) { $post = $p; break; }
}

if (!$post) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

// «Похожие» — другие статьи
$related = array_values(array_filter(get_blog_posts(), fn($p) => $p['slug'] !== $post['slug']));
$related = array_slice($related, 0, 3);

// Простой markdown: **bold** → <strong>, \n\n → <p>
function render_blog_content(string $text): string {
    $paras = preg_split("/\n\s*\n/", trim($text));
    $out = '';
    foreach ($paras as $p) {
        $p = htmlspecialchars($p, ENT_QUOTES, 'UTF-8');
        $p = preg_replace('/\*\*(.+?)\*\*/u', '<strong>$1</strong>', $p);
        $out .= '<p style="margin-bottom:16px;line-height:1.8;">' . nl2br($p) . '</p>';
    }
    return $out;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($post['title']) ?> — TACTICA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main class="section">
    <div class="container" style="max-width:800px;">
      <p class="tech-label" style="margin-bottom:16px;">
        [<?= e($post['tag']) ?>] / <?= e($post['date']) ?> / [<?= e($post['read_time'] ?? '5 мин') ?>]
      </p>

      <h1 class="section__title" style="margin-bottom:24px;"><?= e($post['title']) ?></h1>

      <div class="blog-card__image-wrapper" style="aspect-ratio:16/9;margin-bottom:32px;">
        <img src="<?= e($post['image']) ?>" alt="<?= e($post['title']) ?>" loading="eager">
      </div>

      <div style="font-size:var(--text-lg);color:var(--color-text-primary);">
        <?= render_blog_content($post['content'] ?? '') ?>
      </div>

      <p style="margin-top:32px;">
        <a href="/blog" class="section__link">← Все статьи</a>
      </p>

      <?php if ($related): ?>
        <div class="section__header" style="margin-top:64px;">
          <h2 class="section__title" style="font-size:var(--text-2xl);">ЧИТАЙТЕ ТАКЖЕ</h2>
        </div>
        <div class="blog-grid">
          <?php foreach ($related as $r): ?>
            <article class="blog-card">
              <a href="/blog/<?= e($r['slug']) ?>" class="blog-card__link">
                <div class="blog-card__image-wrapper">
                  <img src="<?= e($r['image']) ?>" alt="<?= e($r['title']) ?>" loading="lazy" width="400" height="240">
                </div>
                <div class="blog-card__body">
                  <p class="tech-label">[<?= e($r['tag']) ?>] / <?= e($r['date']) ?></p>
                  <h3 class="blog-card__title"><?= e($r['title']) ?></h3>
                </div>
              </a>
            </article>
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
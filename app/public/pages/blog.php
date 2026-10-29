<?php
/** @var array $data */
$posts = get_blog_posts();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Блог — TACTICA</title>
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
        <h1 class="section__title">БЛОГ</h1>
        <span class="tech-label">[<?= count($posts) ?> POSTS]</span>
      </div>

      <div class="blog-grid">
        <?php foreach ($posts as $post): ?>
          <article class="blog-card">
            <a href="/blog/<?= e($post['slug']) ?>" class="blog-card__link">
              <div class="blog-card__image-wrapper">
                <img src="<?= e($post['image']) ?>" alt="<?= e($post['title']) ?>" loading="lazy" width="400" height="240">
              </div>
              <div class="blog-card__body">
                <p class="tech-label">[<?= e($post['tag']) ?>] / <?= e($post['date']) ?></p>
                <h3 class="blog-card__title"><?= e($post['title']) ?></h3>
                <p class="blog-card__excerpt"><?= e($post['excerpt']) ?></p>
                <p class="tech-label" style="margin-top:8px;">[<?= e($post['read_time'] ?? '5 мин') ?>]</p>
              </div>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/compare.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/favorites.js"></script>
</body>
</html>
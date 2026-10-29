<?php
/** @var array $data */
$featuredProducts = array_slice(get_products(), 0, 4);
$categories = get_categories();
$blogPosts = get_blog_posts();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TACTICA — Тактическое снаряжение и EDC</title>
  <meta name="description" content="Ножи, фонари, мультитулы и экипировка для страйкбола.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main>
    <section class="hero">
      <div class="container hero__inner">
        <div class="hero__content">
          <p class="tech-label">[EST. 2024] / [TACTICAL GEAR]</p>
          <h1 class="hero__title">СНАРЯЖЕНИЕ<br>ДЛЯ ТЕХ, КТО<br>ПОНИМАЕТ</h1>
          <p class="hero__subtitle">Ножи, фонари, мультитулы и экипировка для страйкбола. Отобрано и протестировано.</p>
          <div class="hero__actions">
            <a href="/catalog" class="btn btn--primary">Смотреть каталог</a>
            <a href="/quiz" class="btn btn--secondary">Подобрать снаряжение</a>
          </div>
        </div>
        <div class="hero__visual">
          <img src="/images/hero-gear.webp" alt="Тактическое снаряжение" loading="eager" width="640" height="640">
        </div>
      </div>
    </section>

    <section class="categories section">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">КАТЕГОРИИ</h2>
          <a href="/catalog" class="section__link">Все категории →</a>
        </div>
        <div class="categories__grid">
          <?php foreach ($categories as $cat): ?>
            <a href="/catalog/<?= e($cat['slug']) ?>" class="category-card">
              <div class="category-card__icon"><?= $cat['icon'] ?></div>
              <h3 class="category-card__title"><?= e($cat['title']) ?></h3>
              <span class="category-card__count tech-label"><?= (int)$cat['count'] ?> товаров</span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="featured section">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">ХИТЫ</h2>
          <a href="/catalog?sort=popular" class="section__link">Все хиты →</a>
        </div>
        <div class="products-grid" data-products-grid>
          <?php foreach ($featuredProducts as $product): ?>
            <?php include __DIR__ . '/../partials/product-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="quiz-cta section">
      <div class="container quiz-cta__inner">
        <div class="quiz-cta__content">
          <p class="tech-label">[SMART PICK]</p>
          <h2 class="quiz-cta__title">НЕ ЗНАЕШЬ, ЧТО ВЫБРАТЬ?</h2>
          <p class="quiz-cta__text">Выбери сценарий — мы подберём снаряжение под твои задачи.</p>
          <div class="quiz-cta__scenarios">
            <a href="/quiz?scenario=edc" class="scenario"><span class="scenario__key">[EDC]</span><span class="scenario__title">Нож на каждый день</span></a>
            <a href="/quiz?scenario=airsoft" class="scenario"><span class="scenario__key">[AIRSOFT]</span><span class="scenario__title">Снаряжение для игры</span></a>
            <a href="/quiz?scenario=urban" class="scenario"><span class="scenario__key">[URBAN]</span><span class="scenario__title">Городской выживальщик</span></a>
          </div>
          <a href="/quiz" class="btn btn--primary">Пройти подбор</a>
        </div>
        <div class="quiz-cta__visual">
          <img src="/images/quiz-preview.webp" alt="Подбор снаряжения" loading="lazy" width="480" height="480">
        </div>
      </div>
    </section>

    <section class="blog-preview section">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">БЛОГ</h2>
          <a href="/blog" class="section__link">Все статьи →</a>
        </div>
        <div class="blog-grid">
          <?php foreach ($blogPosts as $post): ?>
            <article class="blog-card">
              <a href="/blog/<?= e($post['slug']) ?>" class="blog-card__link">
                <div class="blog-card__image-wrapper">
                  <img src="<?= e($post['image']) ?>" alt="<?= e($post['title']) ?>" loading="lazy" width="400" height="240">
                </div>
                <div class="blog-card__body">
                  <p class="tech-label">[<?= e($post['tag']) ?>] / <?= e($post['date']) ?></p>
                  <h3 class="blog-card__title"><?= e($post['title']) ?></h3>
                  <p class="blog-card__excerpt"><?= e($post['excerpt']) ?></p>
                </div>
              </a>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
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
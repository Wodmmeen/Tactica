<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TACTICA — Тактическое снаряжение и EDC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Header / Навигация -->
  <header class="header">
    <div class="container header__inner">
      <a href="/" class="header__logo">
        <span class="header__logo-mark">[T]</span>
        <span class="header__logo-text">TACTICA</span>
      </a>
      
      <nav class="header__nav">
        <a href="/catalog/blades" class="header__link">Ножи</a>
        <a href="/catalog/flashlights" class="header__link">Фонари</a>
        <a href="/catalog/multitools" class="header__link">Мультитулы</a>
        <a href="/catalog/airsoft" class="header__link">Страйкбол</a>
        <a href="/catalog/accessories" class="header__link">Аксессуары</a>
        <a href="/blog" class="header__link">Блог</a>
      </nav>
      
      <div class="header__actions">
        <button class="btn btn--icon" aria-label="Поиск">🔍</button>
        <button class="btn btn--icon" aria-label="Избранное">♡</button>
        <button class="btn btn--icon header__cart" aria-label="Корзина">
          🛒
          <span class="header__cart-count">0</span>
        </button>
      </div>
    </div>
  </header>

  <main>
    <!-- Hero -->
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
          <img src="/images/hero-gear.webp" alt="Тактическое снаряжение" loading="eager">
        </div>
      </div>
    </section>

    <!-- Категории -->
    <section class="categories section">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">КАТЕГОРИИ</h2>
          <a href="/catalog" class="section__link">Все категории →</a>
        </div>
        <div class="categories__grid">
          <a href="/catalog/blades" class="category-card">
            <div class="category-card__icon">🔪</div>
            <h3 class="category-card__title">Ножи</h3>
            <span class="category-card__count tech-label">47 товаров</span>
          </a>
          <a href="/catalog/flashlights" class="category-card">
            <div class="category-card__icon">🔦</div>
            <h3 class="category-card__title">Фонари</h3>
            <span class="category-card__count tech-label">32 товара</span>
          </a>
          <a href="/catalog/multitools" class="category-card">
            <div class="category-card__icon">🛠</div>
            <h3 class="category-card__title">Мультитулы</h3>
            <span class="category-card__count tech-label">28 товаров</span>
          </a>
          <a href="/catalog/airsoft" class="category-card">
            <div class="category-card__icon">🎯</div>
            <h3 class="category-card__title">Страйкбол</h3>
            <span class="category-card__count tech-label">56 товаров</span>
          </a>
          <a href="/catalog/accessories" class="category-card">
            <div class="category-card__icon">🎒</div>
            <h3 class="category-card__title">Аксессуары</h3>
            <span class="category-card__count tech-label">89 товаров</span>
          </a>
        </div>
      </div>
    </section>

    <!-- Хиты -->
    <section class="featured section">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">ХИТЫ</h2>
          <a href="/catalog?sort=popular" class="section__link">Все хиты →</a>
        </div>
        <div class="products-grid">
          <!-- Карточки товаров -->
          <article class="product-card">
            <div class="product-card__image-wrapper">
              <img src="/images/product-1.webp" alt="Нож складной" class="product-card__image" loading="lazy">
              <span class="product-card__badge badge badge--sale">-15%</span>
            </div>
            <div class="product-card__body">
              <p class="product-card__category">Ножи / Складные</p>
              <h3 class="product-card__title"><a href="/catalog/blades/knife-1">Benchmade Bugout 535</a></h3>
              <div class="product-card__specs">
                <span class="product-card__spec">Сталь: S30V</span>
                <span class="product-card__spec">Вес: 52г</span>
              </div>
              <div class="product-card__footer">
                <div class="product-card__price">
                  <span class="product-card__price--old">18 900 ₽</span>
                  16 065 ₽
                </div>
                <button class="btn btn--primary btn--icon" aria-label="В корзину">🛒</button>
              </div>
            </div>
          </article>
          <!-- ... ещё карточки ... -->
        </div>
      </div>
    </section>

    <!-- Подбор по задаче (блок для ИИ) -->
    <section class="quiz-cta section">
      <div class="container quiz-cta__inner">
        <div class="quiz-cta__content">
          <p class="tech-label">[SMART PICK]</p>
          <h2 class="quiz-cta__title">НЕ ЗНАЕШЬ, ЧТО ВЫБРАТЬ?</h2>
          <p class="quiz-cta__text">Ответь на несколько вопросов — мы подберём снаряжение под твои задачи.</p>
          <a href="/quiz" class="btn btn--primary">Пройти подбор</a>
        </div>
        <div class="quiz-cta__visual">
          <img src="/images/quiz-preview.webp" alt="Подбор снаряжения" loading="lazy">
        </div>
      </div>
    </section>

    <!-- Блог -->
    <section class="blog-preview section">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">БЛОГ</h2>
          <a href="/blog" class="section__link">Все статьи →</a>
        </div>
        <div class="blog-grid">
          <article class="blog-card">
            <a href="/blog/how-to-choose-knife" class="blog-card__link">
              <div class="blog-card__image-wrapper">
                <img src="/images/blog-1.webp" alt="Как выбрать нож" loading="lazy">
              </div>
              <div class="blog-card__body">
                <p class="tech-label">[ГАЙД] / 12.03.2024</p>
                <h3 class="blog-card__title">Как выбрать первый EDC-нож</h3>
                <p class="blog-card__excerpt">Сталь, замок, вес — на что смотреть при выборе...</p>
              </div>
            </a>
          </article>
          <!-- ... ещё статьи ... -->
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__col">
        <p class="footer__brand">TACTICA</p>
        <p class="footer__desc">Тактическое снаряжение и EDC для тех, кто понимает.</p>
      </div>
      <div class="footer__col">
        <p class="footer__heading">Каталог</p>
        <a href="/catalog/blades">Ножи</a>
        <a href="/catalog/flashlights">Фонари</a>
        <a href="/catalog/multitools">Мультитулы</a>
      </div>
      <div class="footer__col">
        <p class="footer__heading">Информация</p>
        <a href="/about">О нас</a>
        <a href="/delivery">Доставка</a>
        <a href="/contacts">Контакты</a>
      </div>
      <div class="footer__col">
        <p class="footer__heading">Связь</p>
        <a href="mailto:info@tactica.ru">info@tactica.ru</a>
        <div class="footer__socials">
          <a href="#" aria-label="Telegram">TG</a>
          <a href="#" aria-label="VK">VK</a>
        </div>
      </div>
    </div>
    <div class="container footer__bottom">
      <p class="tech-label">© 2024 TACTICA / ALL RIGHTS RESERVED</p>
    </div>
  </footer>

  <script src="/js/main.js"></script>
</body>
</html>

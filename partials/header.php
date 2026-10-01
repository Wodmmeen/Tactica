<?php
$cartCount = 0; // потом будет из сессии
?>
<header class="header">
  <div class="container header__inner">
    <a href="/" class="header__logo">
      <span class="header__logo-mark">[T]</span>
      <span class="header__logo-text">TACTICA</span>
    </a>

    <nav class="header__nav" aria-label="Основная навигация">
      <a href="/catalog/blades" class="header__link">Ножи</a>
      <a href="/catalog/flashlights" class="header__link">Фонари</a>
      <a href="/catalog/multitools" class="header__link">Мультитулы</a>
      <a href="/catalog/airsoft" class="header__link">Страйкбол</a>
      <a href="/catalog/accessories" class="header__link">Аксессуары</a>
      <a href="/blog" class="header__link">Блог</a>
    </nav>

    <div class="header__actions">
      <button class="btn btn--icon" aria-label="Поиск" data-action="search-toggle">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
        </svg>
      </button>
      <a href="/account/favorites" class="btn btn--icon" aria-label="Избранное">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
      </a>
      <a href="/cart" class="btn btn--icon header__cart" aria-label="Корзина">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/>
          <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
        </svg>
        <span class="header__cart-count"><?= $cartCount ?></span>
      </a>
      <button class="btn btn--icon header__burger" aria-label="Меню" data-action="mobile-menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Мобильное меню -->
  <div class="mobile-menu" data-mobile-menu hidden>
    <nav class="mobile-menu__nav">
      <a href="/catalog/blades" class="mobile-menu__link">Ножи</a>
      <a href="/catalog/flashlights" class="mobile-menu__link">Фонари</a>
      <a href="/catalog/multitools" class="mobile-menu__link">Мультитулы</a>
      <a href="/catalog/airsoft" class="mobile-menu__link">Страйкбол</a>
      <a href="/catalog/accessories" class="mobile-menu__link">Аксессуары</a>
      <a href="/blog" class="mobile-menu__link">Блог</a>
    </nav>
  </div>
</header>
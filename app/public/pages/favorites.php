<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Избранное — TACTICA</title>
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
        <h1 class="section__title">ИЗБРАННОЕ</h1>
        <span class="tech-label" id="fav-count">[0 ITEMS]</span>
      </div>

      <div id="fav-root">
        <p class="tech-label">[LOADING]</p>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>

  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/favorites.js"></script>
  <script src="/assets/js/compare.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    (function () {
      const root = document.getElementById('fav-root');
      const countEl = document.getElementById('fav-count');

      function renderCard(p) {
        const priceFmt = new Intl.NumberFormat('ru-RU').format(p.price);
        return `
          <article class="product-card" data-product-id="${p.id}" data-title="${p.title}" data-price="${p.price}" data-image="${p.image}" data-slug="${p.slug}">
            <div class="product-card__image-wrapper">
              <a href="/product/${p.slug}" class="product-card__image-link">
                <img src="${p.image}" alt="${p.title}" class="product-card__image" loading="lazy">
              </a>
              <div class="product-card__actions">
                <button class="btn btn--secondary btn--icon is-active" aria-label="Убрать из избранного" data-action="favorite" style="color:var(--color-danger);border-color:var(--color-danger);">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                  </svg>
                </button>
              </div>
            </div>
            <div class="product-card__body">
              <p class="product-card__category">${p.category || ''}</p>
              <h3 class="product-card__title"><a href="/product/${p.slug}">${p.title}</a></h3>
              <div class="product-card__footer">
                <div class="product-card__price"><span>${priceFmt} ₽</span></div>
                <button class="btn btn--primary btn--icon" aria-label="В корзину" data-action="add-to-cart">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/>
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                  </svg>
                </button>
              </div>
            </div>
          </article>
        `;
      }

      function render() {
        const items = TacticaFavorites.read();
        countEl.textContent = '[' + items.length + ' ITEMS]';

        if (!items.length) {
          root.innerHTML = '<p class="tech-label">[EMPTY] / Пока пусто. <a href="/catalog" class="section__link">В каталог →</a></p>';
          return;
        }

        root.innerHTML = '<div class="products-grid">' + items.map(renderCard).join('') + '</div>';
      }

      document.addEventListener('fav:updated', render);
      render();
    })();
  </script>
</body>
</html>
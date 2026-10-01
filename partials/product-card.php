<?php
/**
 * @var array $product
 */
$hasOldPrice = !empty($product['old_price']);
?>
<article class="product-card" data-product-id="<?= (int)$product['id'] ?>">
  <div class="product-card__image-wrapper">
    <a href="/catalog/<?= htmlspecialchars($product['slug']) ?>" class="product-card__image-link">
      <img
        src="<?= htmlspecialchars($product['image']) ?>"
        alt="<?= htmlspecialchars($product['title']) ?>"
        class="product-card__image"
        loading="lazy"
        width="400" height="400"
      >
    </a>
    <?php if (!empty($product['badge'])): ?>
      <span class="product-card__badge badge badge--<?= htmlspecialchars($product['badge']) ?>">
        <?= htmlspecialchars($product['badge_text']) ?>
      </span>
    <?php endif; ?>

    <div class="product-card__actions">
      <button class="btn btn--secondary btn--icon" aria-label="В избранное" data-action="favorite">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
      </button>
      <button class="btn btn--secondary btn--icon" aria-label="Сравнить" data-action="compare">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 12h18M3 6h18M3 18h18"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="product-card__body">
    <p class="product-card__category"><?= htmlspecialchars($product['category']) ?></p>
    <h3 class="product-card__title">
      <a href="/catalog/<?= htmlspecialchars($product['slug']) ?>">
        <?= htmlspecialchars($product['title']) ?>
      </a>
    </h3>

    <div class="product-card__specs">
      <?php foreach ($product['specs'] as $key => $value): ?>
        <span class="product-card__spec">
          <span class="spec-key"><?= htmlspecialchars($key) ?>:</span>
          <?= htmlspecialchars($value) ?>
        </span>
      <?php endforeach; ?>
    </div>

    <div class="product-card__footer">
      <div class="product-card__price">
        <?php if ($hasOldPrice): ?>
          <span class="product-card__price--old"><?= number_format($product['old_price'], 0, '.', ' ') ?> ₽</span>
        <?php endif; ?>
        <span><?= number_format($product['price'], 0, '.', ' ') ?> ₽</span>
      </div>
      <button class="btn btn--primary btn--icon" aria-label="В корзину" data-action="quick-add">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/>
          <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
        </svg>
      </button>
    </div>
  </div>
</article>
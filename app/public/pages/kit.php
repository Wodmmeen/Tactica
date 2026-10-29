<?php
/** @var array $data */
$products = get_products();
$kitCategories = [
    'blades'      => 'Нож',
    'flashlights' => 'Фонарь',
    'multitools'  => 'Мультитул',
    'accessories' => 'Аксессуар',
];

$byCat = [];
foreach ($kitCategories as $cat => $label) {
    $byCat[$cat] = array_values(array_filter($products, fn($p) => $p['category_slug'] === $cat));
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Собери EDC-набор — TACTICA</title>
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
        <h1 class="section__title">СОБЕРИ EDC-НАБОР</h1>
        <span class="tech-label">[KIT BUILDER]</span>
      </div>

      <p style="color:var(--color-text-secondary);margin-bottom:32px;max-width:640px;">
        Выбери по одному товару из каждой категории — мы посчитаем сумму и покажем вес набора.
      </p>

      <div style="display:grid;grid-template-columns:1.6fr 1fr;gap:32px;align-items:start;">
        <div>
          <?php foreach ($byCat as $cat => $items): ?>
            <?php if (!$items) continue; ?>
            <div style="margin-bottom:32px;">
              <p class="footer__heading" style="color:var(--color-text-muted);margin-bottom:12px;">
                <?= e($kitCategories[$cat]) ?>
              </p>
              <div style="display:flex;flex-direction:column;gap:8px;">
                <?php foreach ($items as $item): ?>
                  <label style="display:flex;align-items:center;gap:12px;padding:12px;border:1px solid var(--color-border-light);background:var(--color-bg-surface);cursor:pointer;"
                         data-kit-item
                         data-id="<?= (int)$item['id'] ?>"
                         data-price="<?= (int)$item['price'] ?>"
                         data-weight="<?= (int)$item['weight_g'] ?>"
                         data-title="<?= e($item['title']) ?>">
                    <input type="checkbox" name="kit_<?= e($cat) ?>" value="<?= (int)$item['id'] ?>">
                    <img src="<?= e($item['image']) ?>" alt="" width="48" height="48" style="object-fit:cover;background:var(--color-bg-primary);">
                    <span style="flex:1;font-weight:500;"><?= e($item['title']) ?></span>
                    <span style="font-family:var(--font-mono);font-size:13px;"><?= money($item['price']) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <aside style="position:sticky;top:88px;background:var(--color-bg-surface);border:1px solid var(--color-border-light);padding:24px;">
          <p class="footer__heading" style="color:var(--color-text-muted);margin-bottom:16px;">ВАШ НАБОР</p>
          <div id="kit-items" style="margin-bottom:16px;min-height:40px;font-family:var(--font-mono);font-size:13px;color:var(--color-text-secondary);">
            <span style="color:var(--color-text-muted);">Ничего не выбрано</span>
          </div>
          <div style="display:flex;justify-content:space-between;padding-top:16px;border-top:1px solid var(--color-border-light);margin-bottom:8px;">
            <span class="footer__heading" style="color:var(--color-text-muted);">Вес</span>
            <span style="font-family:var(--font-mono);" id="kit-weight">0 г</span>
          </div>
          <div style="display:flex;justify-content:space-between;margin-bottom:24px;">
            <span class="footer__heading" style="color:var(--color-text-muted);">Итого</span>
            <span style="font-family:var(--font-mono);font-size:20px;font-weight:600;" id="kit-total">0 ₽</span>
          </div>
          <button class="btn btn--primary" id="kit-add" style="width:100%;" disabled>Добавить набор в корзину</button>
        </aside>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>

  <script src="/assets/js/cart.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    (function () {
      const itemsEl = document.getElementById('kit-items');
      const totalEl = document.getElementById('kit-total');
      const weightEl = document.getElementById('kit-weight');
      const addBtn = document.getElementById('kit-add');
      const checkboxes = document.querySelectorAll('[data-kit-item] input[type="checkbox"]');

      // По одному из категории
      function enforceCategory() {
        const selected = {};
        document.querySelectorAll('[data-kit-item]').forEach((row) => {
          const cb = row.querySelector('input');
          const cat = cb.name;
          if (cb.checked) {
            if (selected[cat]) {
              selected[cat].checked = false;
            }
            selected[cat] = cb;
          }
        });
      }

      function update() {
        const selected = [];
        document.querySelectorAll('[data-kit-item]').forEach((row) => {
          const cb = row.querySelector('input');
          if (cb.checked) {
            selected.push({
              id: row.dataset.id,
              title: row.dataset.title,
              price: Number(row.dataset.price),
              weight: Number(row.dataset.weight),
            });
          }
        });

        if (!selected.length) {
          itemsEl.innerHTML = '<span style="color:var(--color-text-muted);">Ничего не выбрано</span>';
          totalEl.textContent = '0 ₽';
          weightEl.textContent = '0 г';
          addBtn.disabled = true;
          return;
        }

        itemsEl.innerHTML = selected.map((i) => `<div style="padding:4px 0;">• ${i.title}</div>`).join('');
        const total = selected.reduce((s, i) => s + i.price, 0);
        const weight = selected.reduce((s, i) => s + i.weight, 0);
        totalEl.textContent = new Intl.NumberFormat('ru-RU').format(total) + ' ₽';
        weightEl.textContent = weight + ' г';
        addBtn.disabled = false;
      }

      checkboxes.forEach((cb) => {
        cb.addEventListener('change', () => {
          enforceCategory();
          update();
        });
      });

      addBtn.addEventListener('click', () => {
        document.querySelectorAll('[data-kit-item]').forEach((row) => {
          const cb = row.querySelector('input');
          if (!cb.checked) return;
          TacticaCart.add({
            id: row.dataset.id,
            title: row.dataset.title,
            price: Number(row.dataset.price),
            image: '',
            slug: '',
          });
        });
        addBtn.textContent = 'Добавлено ✓';
        setTimeout(() => { addBtn.textContent = 'Добавить набор в корзину'; }, 1500);
      });

      update();
    })();
  </script>
  <script src="/assets/js/favorites.js"></script>
</body>
</html>
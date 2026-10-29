// TACTICA — Quiz (scenario → products)
(function () {
  'use strict';

  // Скоринг: каждому товару — баллы по сценарию.
  // В реальном проекте — приходит с бэка; здесь — статично, по category_slug + weight.
  function scoreProduct(product, scenario, budget) {
    let score = 0;

    const cat = product.category_slug || '';
    const weight = Number(product.weight_g) || 0;
    const price = Number(product.price) || 0;

    if (scenario === 'edc') {
      if (cat === 'blades') score += 5;
      if (cat === 'flashlights') score += 3;
      if (weight > 0 && weight < 120) score += 3;
      if (price < 15000) score += 2;
    } else if (scenario === 'airsoft') {
      if (cat === 'airsoft') score += 5;
      if (cat === 'accessories') score += 3;
      if (price < 40000) score += 2;
    } else if (scenario === 'urban') {
      if (cat === 'multitools') score += 5;
      if (cat === 'flashlights') score += 3;
      if (cat === 'blades') score += 2;
      if (weight > 0 && weight < 250) score += 2;
    }

    // бюджет
    if (budget) {
      if (price <= budget) score += 2;
      else score -= 3;
    }

    return score;
  }

  window.TacticaQuiz = { scoreProduct };
})();
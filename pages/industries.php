<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
render_page_hero(
    t('industries.eyebrow'),
    rich('industries.title'),
    t('industries.intro'),
    [[t('nav.home'), url_to($locale, 'home')], [t('nav.industries'), null]]
);
?>
<section class="section">
  <div class="container card-grid">
    <?php foreach (FV_INDUSTRIES as $id => $products): ?>
      <article class="info-card" id="<?= e($id) ?>">
        <h2><?= e(t('industries.items.' . $id . '.title')) ?></h2>
        <p><?= e(t('industries.items.' . $id . '.text')) ?></p>
        <div class="chips">
          <?php foreach ($products as $productId): ?>
            <a class="chip accent-<?= e($productId) ?>" href="<?= e(url_to($locale, 'product', $productId)) ?>"><?= e(FV_PRODUCTS[$productId]['name']) ?></a>
          <?php endforeach; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php render_band(); ?>

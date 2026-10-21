<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
render_page_hero(
    t('solutions.eyebrow'),
    rich('solutions.title'),
    t('solutions.intro'),
    [[t('nav.home'), url_to($locale, 'home')], [t('nav.solutions'), null]]
);
?>
<section class="section">
  <div class="container card-grid">
    <?php foreach (FV_SOLUTIONS as $id => $productId): ?>
      <a class="info-card accent-<?= e($productId) ?>" href="<?= e(url_to($locale, 'product', $productId)) ?>">
        <span class="dot"></span>
        <h2><?= e(t('solutions.items.' . $id . '.title')) ?></h2>
        <p><?= e(t('solutions.items.' . $id . '.text')) ?></p>
        <span class="text-link"><?= e(FV_PRODUCTS[$productId]['name']) ?> <?= icon('arrow') ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</section>
<?php render_band(); ?>

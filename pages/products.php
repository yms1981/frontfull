<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
render_page_hero(
    t('products_block.eyebrow'),
    rich('products_page.title'),
    t('products_page.text'),
    [[t('nav.home'), url_to($locale, 'home')], [t('nav.products'), null]]
);
?>
<section class="section">
  <div class="container catalog">
    <?php foreach (FV_PRODUCTS as $id => $product): ?>
      <a class="catalog-card accent-<?= e($id) ?>" href="<?= e(url_to($locale, 'product', $id)) ?>">
        <span class="art-wrap"><?php art_svg($product['art']); ?></span>
        <span>
          <h2><?= e($product['name']) ?></h2>
          <p><?= e(t('products.' . $id . '.lead')) ?></p>
          <ul>
            <?php foreach (ta('products.' . $id . '.features') as $feature): ?>
              <?php if (is_string($feature)): ?><li><?= e($feature) ?></li><?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </span>
        <span class="go" aria-hidden="true"><?= icon('arrow') ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</section>
<?php render_band(); ?>

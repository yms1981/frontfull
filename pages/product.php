<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
$product = FV_PRODUCTS[$slug];
?>
<section class="page-hero accent-<?= e($slug) ?>">
  <div class="container">
    <?php render_crumbs([
        [t('nav.home'), url_to($locale, 'home')],
        [t('nav.products'), url_to($locale, 'products')],
        [$product['name'], null],
    ]); ?>
    <p class="eyebrow"><?= e(t('products.' . $slug . '.kicker')) ?></p>
    <h1><?= e($product['name']) ?></h1>
    <p class="lede"><?= e(t('products.' . $slug . '.lead')) ?></p>
    <div class="hero-actions">
      <?= demo_link('btn btn-primary', $slug) ?>
      <a class="btn btn-ghost" href="<?= e(url_to($locale, 'products')) ?>"><?= e(t('cta.all_products')) ?></a>
    </div>
  </div>
</section>
<section class="section">
  <div class="container split">
    <div>
      <h2><?= e(t('common.what')) ?></h2>
      <p class="prose"><?= e(t('products.' . $slug . '.about')) ?></p>
      <p class="audience"><strong><?= e(t('common.for_who')) ?>.</strong> <?= e(t('products.' . $slug . '.audience')) ?></p>
    </div>
    <div>
      <h2><?= e(t('common.benefits')) ?></h2>
      <ul class="benefit-list">
        <?php foreach (ta('products.' . $slug . '.benefits') as $benefit): ?>
          <?php if (!is_array($benefit)) { continue; } ?>
          <li>
            <span class="tick accent-<?= e($slug) ?>"><?= icon('check') ?></span>
            <span>
              <strong><?= e((string) ($benefit['title'] ?? '')) ?></strong>
              <p><?= e((string) ($benefit['text'] ?? '')) ?></p>
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<section class="section alt">
  <div class="container">
    <h2><?= e(t('common.features')) ?></h2>
    <ul class="feature-grid">
      <?php foreach (ta('products.' . $slug . '.features') as $feature): ?>
        <?php if (!is_string($feature)) { continue; } ?>
        <li class="accent-<?= e($slug) ?>"><span class="tick"><?= icon('check') ?></span><?= e($feature) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<section class="section">
  <div class="container">
    <h2><?= e(t('common.related')) ?></h2>
    <div class="mini-grid">
      <?php foreach (FV_PRODUCTS as $id => $item): ?>
        <?php if ($id === $slug) { continue; } ?>
        <a class="mini-card accent-<?= e($id) ?>" href="<?= e(url_to($locale, 'product', $id)) ?>">
          <span class="dot"></span>
          <strong><?= e($item['name']) ?></strong>
          <p><?= e(t('products.' . $id . '.card')) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php render_band(); ?>

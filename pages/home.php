<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
$statIcons = ['building', 'users', 'refresh', 'cloud'];
$steps = ['sell', 'pick', 'deliver', 'collect'];
?>
<section class="hero">
  <div class="container hero-grid">
    <div class="hero-copy">
      <p class="eyebrow"><?= e(t('hero.eyebrow')) ?></p>
      <h1><?= brand_html('hero.title') ?></h1>
      <p class="subtitle"><?= e(t('hero.subtitle')) ?></p>
      <div class="hero-actions">
        <?= demo_link('btn btn-primary') ?>
        <a class="btn btn-ghost" href="#how" data-open="video"><?= icon('play') ?><span><?= e(t('cta.video')) ?></span></a>
      </div>
      <ul class="pills">
        <li><?= icon('grid') ?><span><?= e(t('hero.pill_ecosystem')) ?></span></li>
        <li><?= icon('cloud') ?><span><?= e(t('hero.pill_cloud')) ?></span></li>
        <li><?= icon('chart') ?><span><?= e(t('hero.pill_size')) ?></span></li>
      </ul>
    </div>
    <?php require FV_ROOT . '/includes/mockup.php'; ?>
  </div>
</section>

<section class="products-section">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow"><?= e(t('products_block.eyebrow')) ?></p>
        <h2><?= rich('products_block.title') ?></h2>
      </div>
      <p class="section-aside"><?= e(t('products_block.aside')) ?></p>
    </div>

    <?php
    $showcase = 'fullvendor';
    $productGroups = [
        'money' => ['erp', 'finance'],
        'flow' => ['supplier', 'logistics'],
        'field' => ['salesman', 'warehouse'],
    ];
    ?>
    <a class="product-showcase" href="<?= e(url_to($locale, 'product', $showcase)) ?>">
      <span class="product-photo">
        <img src="<?= e(asset('assets/img/products/' . $showcase . '.jpg')) ?>" alt="">
      </span>
      <span class="product-copy">
        <span class="eyebrow"><?= e(t('products.' . $showcase . '.kicker')) ?></span>
        <h3><?= e(FV_PRODUCTS[$showcase]['name']) ?></h3>
        <p><?= e(t('products.' . $showcase . '.lead')) ?></p>
        <ul>
          <?php foreach (ta('products.' . $showcase . '.features') as $feature): ?>
            <?php if (is_string($feature)): ?><li><?= e($feature) ?></li><?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </span>
    </a>

    <?php foreach ($productGroups as $group => $ids): ?>
      <div class="product-band">
        <p class="product-band-title"><?= e(t('products_block.groups.' . $group)) ?></p>
        <div class="product-pair">
          <?php foreach ($ids as $id): ?>
            <a class="product-tile" href="<?= e(url_to($locale, 'product', $id)) ?>">
              <img src="<?= e(asset('assets/img/products/' . $id . '.jpg')) ?>" alt="">
              <span class="product-tile-body">
                <span class="product-kicker"><?= e(t('products.' . $id . '.kicker')) ?></span>
                <h3><?= e(FV_PRODUCTS[$id]['name']) ?></h3>
                <p><?= e(t('products.' . $id . '.lead')) ?></p>
                <span class="product-more" aria-hidden="true"><?= icon('arrow') ?></span>
              </span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="flow" id="how">
  <div class="container">
    <header class="center-head">
      <p class="eyebrow"><?= e(t('flow.eyebrow')) ?></p>
      <h2><?= e(t('flow.title')) ?></h2>
      <p class="lede"><?= e(t('flow.text')) ?></p>
    </header>
    <ol class="steps">
      <?php foreach ($steps as $index => $step): ?>
        <li>
          <span>0<?= $index + 1 ?></span>
          <h3><?= e(t('flow.steps.' . $step . '.title')) ?></h3>
          <p><?= e(t('flow.steps.' . $step . '.text')) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<section class="why">
  <div class="container why-grid">
    <div class="why-copy">
      <p class="eyebrow"><?= e(t('why.eyebrow')) ?></p>
      <h2><?= brand_html('why.title') ?></h2>
    </div>
    <ul class="stats">
      <?php foreach (ta('why.stats') as $index => $stat): ?>
        <?php if (!is_array($stat)) { continue; } ?>
        <li>
          <span class="stat-ico"><?= icon($statIcons[$index] ?? 'chart') ?></span>
          <strong><?= e((string) ($stat['value'] ?? '')) ?><?php if (($stat['suffix'] ?? '') !== ''): ?> <small><?= e((string) $stat['suffix']) ?></small><?php endif; ?></strong>
          <span><?= e((string) ($stat['label'] ?? '')) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="why-actions">
      <?= demo_link('btn btn-primary') ?>
      <a class="link-light" href="<?= e(url_to($locale, 'contact')) ?>"><span><?= e(t('cta.contact')) ?></span><?= icon('arrow') ?></a>
    </div>
  </div>
</section>

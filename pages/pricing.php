<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
render_page_hero(
    t('pricing.eyebrow'),
    rich('pricing.title'),
    t('pricing.intro'),
    [[t('nav.home'), url_to($locale, 'home')], [t('nav.pricing'), null]]
);
?>
<section class="section">
  <div class="container">
    <div class="plan-grid">
      <?php foreach (FV_PLANS as $id => $featured): ?>
        <article class="plan<?= $featured ? ' is-featured' : '' ?>">
          <?php if ($featured): ?><span class="badge"><?= e(t('pricing.recommended')) ?></span><?php endif; ?>
          <h2><?= e(t('pricing.plans.' . $id . '.name')) ?></h2>
          <p><?= e(t('pricing.plans.' . $id . '.desc')) ?></p>
          <ul>
            <?php foreach (ta('pricing.plans.' . $id . '.features') as $feature): ?>
              <?php if (is_string($feature)): ?><li><?= icon('check') ?><span><?= e($feature) ?></span></li><?php endif; ?>
            <?php endforeach; ?>
          </ul>
          <?= demo_link('btn ' . ($featured ? 'btn-primary' : 'btn-dark'), null, t('pricing.plans.' . $id . '.cta')) ?>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="pricing-note"><?= e(t('pricing.note')) ?></p>
    <h2 class="faq-title"><?= e(t('pricing.faq_title')) ?></h2>
    <div class="faq">
      <?php foreach (FV_FAQ as $id): ?>
        <details>
          <summary><?= e(t('pricing.faq.' . $id . '.q')) ?></summary>
          <p><?= e(t('pricing.faq.' . $id . '.a')) ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

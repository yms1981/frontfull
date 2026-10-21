<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
$wa = whatsapp_url();
render_page_hero(
    t('contact.eyebrow'),
    rich('contact.title'),
    t('contact.text'),
    [[t('nav.home'), url_to($locale, 'home')], [t('nav.contact'), null]]
);
?>
<section class="section">
  <div class="container contact-layout">
    <div class="contact-side">
      <ul class="pills pills-dark">
        <li><?= icon('grid') ?><span><?= e(t('hero.pill_ecosystem')) ?></span></li>
        <li><?= icon('cloud') ?><span><?= e(t('hero.pill_cloud')) ?></span></li>
        <li><?= icon('chart') ?><span><?= e(t('hero.pill_size')) ?></span></li>
      </ul>
      <ul class="contact-lines">
        <?php if (FV_CONTACT_EMAIL !== ''): ?>
          <li><span><?= e(t('contact.email')) ?></span><a href="mailto:<?= e(FV_CONTACT_EMAIL) ?>"><?= e(FV_CONTACT_EMAIL) ?></a></li>
        <?php endif; ?>
        <?php if (FV_CONTACT_PHONE !== ''): ?>
          <li><span><?= e(t('contact.phone')) ?></span><a href="tel:<?= e(preg_replace('/\s+/', '', FV_CONTACT_PHONE) ?? '') ?>"><?= e(FV_CONTACT_PHONE) ?></a></li>
        <?php endif; ?>
        <?php if ($wa): ?>
          <li><span><?= e(t('contact.whatsapp')) ?></span><a href="<?= e($wa) ?>" rel="noopener"><?= e(t('contact.whatsapp')) ?></a></li>
        <?php endif; ?>
      </ul>
    </div>
    <div class="form-card">
      <?php render_lead_form('contact'); ?>
    </div>
  </div>
</section>

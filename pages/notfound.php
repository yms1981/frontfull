<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
?>
<section class="page-hero">
  <div class="container">
    <p class="eyebrow">404</p>
    <h1><?= e(t('notfound.title')) ?></h1>
    <p class="lede"><?= e(t('notfound.text')) ?></p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="<?= e(url_to($locale, 'home')) ?>"><span><?= e(t('cta.home')) ?></span><?= icon('arrow') ?></a>
    </div>
  </div>
</section>

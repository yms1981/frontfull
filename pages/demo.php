<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
render_page_hero(
    t('demo.eyebrow'),
    rich('demo.title'),
    t('demo.text'),
    [[t('nav.home'), url_to($locale, 'home')], [t('cta.demo'), null]]
);
?>
<section class="section">
  <div class="container narrow">
    <div class="form-card">
      <?php render_lead_form('demo'); ?>
    </div>
  </div>
</section>

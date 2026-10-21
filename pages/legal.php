<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
$kind = $pageId === 'terms' ? 'terms' : 'privacy';
render_page_hero(
    t('footer.legal'),
    e(t('legal.' . $kind . '_title')),
    t('legal.' . $kind . '_intro'),
    [[t('nav.home'), url_to($locale, 'home')], [t($kind === 'terms' ? 'footer.terms' : 'footer.privacy'), null]]
);
?>
<section class="section">
  <div class="container narrow legal">
    <?php foreach (ta('legal.' . $kind) as $block): ?>
      <?php if (!is_array($block)) { continue; } ?>
      <h2><?= e((string) ($block['title'] ?? '')) ?></h2>
      <p><?= e((string) ($block['text'] ?? '')) ?></p>
    <?php endforeach; ?>
  </div>
</section>

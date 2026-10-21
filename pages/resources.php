<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
render_page_hero(
    t('resources.eyebrow'),
    rich('resources.title'),
    t('resources.intro'),
    [[t('nav.home'), url_to($locale, 'home')], [t('nav.resources'), null]]
);
?>
<section class="section">
  <div class="container resource-list">
    <?php foreach (FV_RESOURCES as $id): ?>
      <article class="resource" id="<?= e($id) ?>">
        <h2><?= e(t('resources.items.' . $id . '.title')) ?></h2>
        <p class="lede"><?= e(t('resources.items.' . $id . '.summary')) ?></p>
        <ul>
          <?php foreach (ta('resources.items.' . $id . '.points') as $point): ?>
            <?php if (is_string($point)): ?><li><?= e($point) ?></li><?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php render_band(); ?>

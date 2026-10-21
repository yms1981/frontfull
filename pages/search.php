<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }
$query = trim((string) ($_GET['q'] ?? ''));
$query = fv_cut($query, 80);
$results = [];
if ($query !== '') {
    $needle = fv_lower($query);
    foreach (search_catalog() as $item) {
        $hay = fv_lower($item['title'] . ' ' . $item['text']);
        if (str_contains($hay, $needle)) {
            $results[] = $item;
        }
    }
}
render_page_hero(
    t('a11y.search'),
    e(t('meta.search_title')),
    $query === '' ? t('search.intro') : t('search.results', ['n' => (string) count($results)]),
    [[t('nav.home'), url_to($locale, 'home')], [t('a11y.search'), null]]
);
?>
<section class="section">
  <div class="container narrow">
    <form class="search-page-form" method="get" action="<?= e(url_to($locale, 'search')) ?>">
      <label class="sr-only" for="q"><?= e(t('a11y.search')) ?></label>
      <input id="q" type="search" name="q" value="<?= e($query) ?>" placeholder="<?= e(t('search.placeholder')) ?>">
      <button class="btn btn-primary" type="submit"><?= e(t('search.button')) ?></button>
    </form>
    <?php if ($query !== '' && $results === []): ?>
      <p class="empty"><?= e(t('search.empty', ['q' => $query])) ?></p>
      <p class="muted"><?= e(t('search.hint')) ?></p>
    <?php endif; ?>
    <div class="search-list">
      <?php
      $list = $query === '' ? array_slice(search_catalog(), 0, 7) : $results;
      foreach ($list as $item):
      ?>
        <a class="search-hit" href="<?= e($item['href']) ?>">
          <small><?= e(t('search.kind_' . $item['kind'])) ?></small>
          <strong><?= e($item['title']) ?></strong>
          <span><?= e($item['text']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

$videoId = youtube_id(FV_VIDEO_URL);
$slides = ta('video.slides');
?>
  </main>
  <footer class="site-footer">
    <div class="container footer-grid">
      <div>
        <a class="logo" href="<?= e(url_to($locale, 'home')) ?>"><span class="logo-full">Full</span><span class="logo-vendor">Vendor</span></a>
        <p><?= e(t('footer.blurb')) ?></p>
      </div>
      <div>
        <p class="foot-title"><?= e(t('footer.products')) ?></p>
        <ul>
          <?php foreach (FV_PRODUCTS as $id => $product): ?>
            <li><a href="<?= e(url_to($locale, 'product', $id)) ?>"><?= e($product['name']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <p class="foot-title"><?= e(t('footer.company')) ?></p>
        <ul>
          <li><a href="<?= e(url_to($locale, 'solutions')) ?>"><?= e(t('nav.solutions')) ?></a></li>
          <li><a href="<?= e(url_to($locale, 'pricing')) ?>"><?= e(t('nav.pricing')) ?></a></li>
          <li><a href="<?= e(url_to($locale, 'contact')) ?>"><?= e(t('nav.contact')) ?></a></li>
          <li><a href="<?= e(url_to($locale, 'demo')) ?>"><?= e(t('cta.demo')) ?></a></li>
        </ul>
      </div>
      <div>
        <p class="foot-title"><?= e(t('footer.legal')) ?></p>
        <ul>
          <li><a href="<?= e(url_to($locale, 'privacy')) ?>"><?= e(t('footer.privacy')) ?></a></li>
          <li><a href="<?= e(url_to($locale, 'terms')) ?>"><?= e(t('footer.terms')) ?></a></li>
        </ul>
      </div>
    </div>
    <div class="container footer-bottom">
      <p>© <?= e(date('Y')) ?> FullVendor. <?= e(t('footer.rights')) ?></p>
    </div>
  </footer>

  <div class="modal" id="search-modal" hidden>
    <div class="modal-backdrop" data-close></div>
    <div class="modal-card search-card" role="dialog" aria-modal="true" aria-labelledby="search-title">
      <div class="search-bar">
        <?= icon('search') ?>
        <input id="search-input" type="search" placeholder="<?= e(t('search.placeholder')) ?>" aria-labelledby="search-title">
        <button type="button" class="icon-btn" data-close aria-label="<?= e(t('nav.close')) ?>"><?= icon('close') ?></button>
      </div>
      <h2 id="search-title" class="sr-only"><?= e(t('a11y.search')) ?></h2>
      <div id="search-results" class="search-results"></div>
    </div>
  </div>

  <div class="modal" id="video-modal" hidden>
    <div class="modal-backdrop" data-close></div>
    <div class="modal-card video-card" role="dialog" aria-modal="true" aria-labelledby="video-title">
      <button type="button" class="icon-btn modal-x" data-close aria-label="<?= e(t('nav.close')) ?>"><?= icon('close') ?></button>
      <h2 id="video-title"><?= e(t('video.title')) ?></h2>
      <?php if ($videoId): ?>
        <div class="video-frame">
          <iframe src="https://www.youtube-nocookie.com/embed/<?= e($videoId) ?>" title="<?= e(t('video.title')) ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      <?php else: ?>
        <?php foreach ($slides as $index => $slide): ?>
          <?php if (!is_array($slide)) { continue; } ?>
          <article class="slide<?= $index === 0 ? ' is-on' : '' ?>" data-slide="<?= (int) $index ?>">
            <span>0<?= (int) $index + 1 ?></span>
            <h3><?= e((string) ($slide['title'] ?? '')) ?></h3>
            <p><?= e((string) ($slide['text'] ?? '')) ?></p>
          </article>
        <?php endforeach; ?>
        <div class="slide-nav">
          <button type="button" class="btn btn-ghost-dark" data-slide-prev><?= e(t('video.prev')) ?></button>
          <button type="button" class="btn btn-primary" data-slide-next><?= e(t('video.next')) ?></button>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script type="application/json" id="fv-catalog"><?= json_encode(search_catalog(), JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
  <script type="application/json" id="fv-ui"><?= json_encode([
      'empty' => t('search.empty'),
      'hint' => t('search.hint'),
      'kinds' => [
          'product' => t('search.kind_product'),
          'solution' => t('search.kind_solution'),
          'industry' => t('search.kind_industry'),
          'resource' => t('search.kind_resource'),
      ],
  ], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
  <script src="<?= e(asset('assets/js/main.js')) ?>" defer></script>
</body>
</html>

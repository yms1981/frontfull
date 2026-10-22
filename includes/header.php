<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

[$pageTitle, $pageDescription] = page_meta();
$meta = LOCALES[$locale];
$spoken = locale_has_copy($locale) ? $meta : LOCALES['es'];
$switchPage = $notFound ? 'home' : $pageId;
$switchSlug = $notFound ? null : $slug;
$switchQuery = lang_switch_query();
$canonical = abs_url($notFound ? (fv_base() . $path) : url_to($locale, $pageId, $slug));
$robots = ($notFound || $pageId === 'search') ? 'noindex, follow' : 'index, follow';
?>
<!DOCTYPE html>
<html lang="<?= e($spoken['html']) ?>" dir="<?= e($spoken['dir']) ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($pageDescription) ?>">
  <meta name="robots" content="<?= e($robots) ?>">
  <meta name="theme-color" content="#e10613">
  <link rel="canonical" href="<?= e($canonical) ?>">
  <link rel="icon" href="<?= e(asset('assets/favicon.svg')) ?>" type="image/svg+xml">
  <?php if (!$notFound): ?>
    <?php foreach (translated_locales() as $code => $item): ?>
      <link rel="alternate" hreflang="<?= e($item['html']) ?>" href="<?= e(abs_url(url_to($code, $switchPage, $switchSlug))) ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= e(abs_url(url_to('es', $switchPage, $switchSlug))) ?>">
  <?php endif; ?>
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="FullVendor">
  <meta property="og:title" content="<?= e($pageTitle) ?>">
  <meta property="og:description" content="<?= e($pageDescription) ?>">
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:locale" content="<?= e($spoken['og']) ?>">
  <?php foreach (translated_locales() as $code => $item): ?>
    <?php if ($code !== $locale): ?>
      <meta property="og:locale:alternate" content="<?= e($item['og']) ?>">
    <?php endif; ?>
  <?php endforeach; ?>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?= e($pageTitle) ?>">
  <meta name="twitter:description" content="<?= e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Noto+Sans:wght@500;600;700&family=Noto+Sans+Arabic:wght@500;700&family=Noto+Sans+Bengali:wght@500;700&family=Noto+Sans+Devanagari:wght@500;700&family=Noto+Sans+Hebrew:wght@500;700&family=Noto+Sans+JP:wght@500;700&family=Noto+Sans+KR:wght@500;700&family=Noto+Sans+SC:wght@500;700&family=Noto+Sans+Thai:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.5.0/css/flag-icons.min.css">
  <link rel="stylesheet" href="<?= e(asset('assets/css/styles.css')) ?>">
  <style>
    <?php foreach (FV_PRODUCTS as $id => $product): ?>
    .accent-<?= e($id) ?>{--accent:<?= e(safe_hex($product['color'])) ?>}
    <?php endforeach; ?>
  </style>
  <script type="application/ld+json">
    <?= json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                'name' => 'FullVendor',
                'url' => abs_url(url_to($locale, 'home')),
                'description' => t('meta.home_desc'),
                'email' => FV_CONTACT_EMAIL !== '' ? FV_CONTACT_EMAIL : null,
            ],
            [
                '@type' => 'WebSite',
                'name' => 'FullVendor',
                'url' => abs_url(url_to($locale, 'home')),
                'inLanguage' => $spoken['html'],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => abs_url(url_to($locale, 'search')) . '?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
  </script>
</head>
<body class="page-<?= e($pageId) ?>">
  <a class="skip" href="#main"><?= e(t('a11y.skip')) ?></a>
  <header class="site-header">
    <div class="container header-bar">
      <a class="logo" href="<?= e(url_to($locale, 'home')) ?>" aria-label="FullVendor">
        <img class="brand-mark" src="<?= e(asset('assets/img/brand-mark.jpg')) ?>" alt="">
        <span class="brand-name">FullVendor</span>
      </a>
      <nav class="desk-nav" aria-label="<?= e(t('a11y.primary')) ?>">
        <a class="<?= e(trim(nav_on('home'))) ?>" href="<?= e(url_to($locale, 'home')) ?>"><?= e(t('nav.home')) ?></a>
        <div class="has-sub">
          <a class="<?= e(trim(nav_on('products'))) ?>" href="<?= e(url_to($locale, 'products')) ?>"><?= e(t('nav.products')) ?></a>
          <div class="sub">
            <div class="sub-inner">
              <?php foreach (FV_PRODUCTS as $id => $product): ?>
                <a href="<?= e(url_to($locale, 'product', $id)) ?>">
                  <span class="dot accent-<?= e($id) ?>"></span>
                  <span>
                    <strong><?= e($product['name']) ?></strong>
                    <small><?= e(t('products.' . $id . '.card')) ?></small>
                  </span>
                </a>
              <?php endforeach; ?>
              <a class="sub-all" href="<?= e(url_to($locale, 'products')) ?>"><?= e(t('cta.all_products')) ?> <?= icon('arrow') ?></a>
            </div>
          </div>
        </div>
        <a class="<?= e(trim(nav_on('solutions'))) ?>" href="<?= e(url_to($locale, 'solutions')) ?>"><?= e(t('nav.solutions')) ?></a>
        <a class="<?= e(trim(nav_on('pricing'))) ?>" href="<?= e(url_to($locale, 'pricing')) ?>"><?= e(t('nav.pricing')) ?></a>
        <a class="<?= e(trim(nav_on('contact'))) ?>" href="<?= e(url_to($locale, 'contact')) ?>"><?= e(t('nav.contact')) ?></a>
      </nav>
      <div class="header-tools">
        <a class="icon-btn" href="<?= e(url_to($locale, 'search')) ?>" data-open="search" aria-label="<?= e(t('a11y.search')) ?>"><?= icon('search') ?></a>
        <details class="lang">
          <summary aria-label="<?= e(t('a11y.language')) ?>">
            <?= locale_flag($locale) ?><span><?= e(strtoupper($locale)) ?></span>
          </summary>
          <div class="lang-panel">
            <input type="search" class="lang-filter" placeholder="<?= e(t('search.lang_filter')) ?>" aria-label="<?= e(t('search.lang_filter')) ?>">
            <div class="lang-list">
              <?php foreach (available_locales() as $code => $item): ?>
                <a class="lang-option<?= $code === $locale ? ' is-current' : '' ?>"
                   href="<?= e(url_to($code, $switchPage, $switchSlug, $switchQuery)) ?>"
                   hreflang="<?= e($item['html']) ?>"
                   lang="<?= e($item['html']) ?>"
                   dir="<?= e($item['dir']) ?>"
                   data-name="<?= e($item['native'] . ' ' . $item['name'] . ' ' . $code) ?>"
                   <?= $code === $locale ? 'aria-current="true"' : '' ?>>
                  <span class="lang-name"><?= locale_flag($code) ?><span><?= e($item['native']) ?></span></span>
                  <small><?= e(strtoupper($code)) ?></small>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </details>
        <?= demo_link('btn btn-primary btn-sm') ?>
        <details class="mobile-nav">
          <summary class="icon-btn" aria-label="<?= e(t('nav.open_menu')) ?>"><?= icon('menu') ?></summary>
          <div class="mobile-panel">
            <a href="<?= e(url_to($locale, 'home')) ?>"><?= e(t('nav.home')) ?></a>
            <a href="<?= e(url_to($locale, 'products')) ?>"><?= e(t('nav.products')) ?></a>
            <div class="mobile-products">
              <?php foreach (FV_PRODUCTS as $id => $product): ?>
                <a href="<?= e(url_to($locale, 'product', $id)) ?>"><span class="dot accent-<?= e($id) ?>"></span><?= e($product['name']) ?></a>
              <?php endforeach; ?>
            </div>
            <a href="<?= e(url_to($locale, 'solutions')) ?>"><?= e(t('nav.solutions')) ?></a>
            <a href="<?= e(url_to($locale, 'pricing')) ?>"><?= e(t('nav.pricing')) ?></a>
            <a href="<?= e(url_to($locale, 'contact')) ?>"><?= e(t('nav.contact')) ?></a>
            <?= demo_link('btn btn-primary') ?>
          </div>
        </details>
      </div>
    </div>
  </header>
  <main id="main">

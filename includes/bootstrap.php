<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

require __DIR__ . '/config.php';
require __DIR__ . '/locales.php';
require __DIR__ . '/helpers.php';
require __DIR__ . '/art.php';
require __DIR__ . '/lead.php';
require __DIR__ . '/form.php';

ini_set('display_errors', FV_DEBUG ? '1' : '0');
ini_set('log_errors', '1');
ini_set('error_log', FV_ROOT . '/storage/php-error.log');

set_exception_handler(static function (Throwable $exception): void {
    error_log($exception->__toString());
    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=utf-8');
    }
    echo FV_DEBUG ? $exception->getMessage() : 'Ha ocurrido un error.';
    exit;
});

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$path = rawurldecode($path);
if (str_contains($path, '..')) {
    http_response_code(400);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Bad request';
    exit;
}

$base = fv_base();
if ($base !== '' && str_starts_with($path, $base)) {
    $path = substr($path, strlen($base));
    if ($path === '' || $path === false) {
        $path = '/';
    }
}
if ($path === '/index.php') {
    $path = '/';
}
if ($path === '' || $path[0] !== '/') {
    $path = '/' . ltrim((string) $path, '/');
}

if ($path === '/robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\nAllow: /\nDisallow: /storage/\nDisallow: /includes/\nSitemap: " . fv_origin() . $base . "/sitemap.xml\n";
    exit;
}

if ($path === '/favicon.ico') {
    redirect_to($base . '/assets/favicon.svg', 302);
}

if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    echo sitemap_xml();
    exit;
}

if ($path !== '/' && str_ends_with($path, '/')) {
    $query = $_SERVER['QUERY_STRING'] ?? '';
    redirect_to($base . rtrim($path, '/') . ($query !== '' ? '?' . $query : ''), 301);
}

$locale = 'es';
$pageId = 'home';
$slug = null;
$view = 'home.php';
$notFound = false;
$i18n = [];
$oldInput = [];
$fieldErrors = [];
$formAlert = null;
$formOk = false;

$trimmed = trim($path, '/');
if ($trimmed === '') {
    redirect_to($base . '/' . detect_lang(), 302);
}

$segments = explode('/', $trimmed);
$requested = strtolower($segments[0]);
$available = available_locales();

if (!isset($available[$requested])) {
    redirect_to($base . '/' . detect_lang() . $path, 302);
}

if ($segments[0] !== $requested) {
    $rest = implode('/', array_slice($segments, 1));
    $query = $_SERVER['QUERY_STRING'] ?? '';
    redirect_to($base . '/' . $requested . ($rest !== '' ? '/' . $rest : '') . ($query !== '' ? '?' . $query : ''), 301);
}

$locale = $requested;
$i18n = load_lang($locale);

$routeMap = [];
foreach (FV_PAGES as $pageName) {
    $routeMap[route_slug($locale, $pageName)] = $pageName;
}

$rest = array_slice($segments, 1);
if ($rest !== []) {
    $piece = $rest[0];
    if (!isset($routeMap[$piece])) {
        $notFound = true;
    } else {
        $pageId = $routeMap[$piece];
        if (isset($rest[1])) {
            if ($pageId === 'products' && isset(FV_PRODUCTS[$rest[1]]) && !isset($rest[2])) {
                $pageId = 'product';
                $slug = $rest[1];
                $view = 'product.php';
            } else {
                $notFound = true;
            }
        } else {
            $view = match ($pageId) {
                'products' => 'products.php',
                'solutions' => 'solutions.php',
                'industries' => 'industries.php',
                'pricing' => 'pricing.php',
                'resources' => 'resources.php',
                'contact' => 'contact.php',
                'demo' => 'demo.php',
                'privacy', 'terms' => 'legal.php',
                'search' => 'search.php',
                default => 'notfound.php',
            };
        }
    }
}

if ($notFound) {
    $pageId = 'notfound';
    $view = 'notfound.php';
    $slug = null;
    http_response_code(404);
}

$sessionDir = FV_ROOT . '/storage/sessions';
if (!is_dir($sessionDir)) {
    mkdir($sessionDir, 0775, true);
}
session_name('FVSESS');
session_save_path($sessionDir);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => ($base === '' ? '/' : $base . '/'),
    'secure' => fv_https(),
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

if (!$notFound && in_array($pageId, ['contact', 'demo'], true) && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $result = process_lead($pageId);
    if ($result['ok']) {
        redirect_to(url_to($locale, $pageId) . '?ok=1', 303);
    }
    $oldInput = $result['old'];
    $fieldErrors = $result['errors'];
    $formAlert = $result['alert'];
}

$formOk = !$notFound
    && in_array($pageId, ['contact', 'demo'], true)
    && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET'
    && (($_GET['ok'] ?? '') === '1');

if (($_COOKIE['fv_lang'] ?? '') !== $locale) {
    setcookie('fv_lang', $locale, [
        'expires' => time() + 86400 * 365,
        'path' => ($base === '' ? '/' : $base . '/'),
        'secure' => fv_https(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

header('Content-Type: text/html; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-Frame-Options: SAMEORIGIN');

function sitemap_xml(): string
{
    $pages = ['home', 'products', 'solutions', 'industries', 'pricing', 'resources', 'contact', 'demo', 'privacy', 'terms'];
    $locales = array_keys(available_locales());
    $entries = [];
    foreach ($locales as $lang) {
        foreach ($pages as $page) {
            $entries[] = [$lang, $page, null];
        }
        foreach (array_keys(FV_PRODUCTS) as $productId) {
            $entries[] = [$lang, 'product', $productId];
        }
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
    foreach ($entries as [$lang, $page, $productId]) {
        $loc = abs_url(url_to($lang, $page, $productId));
        $xml .= "  <url>\n    <loc>" . e($loc) . "</loc>\n";
        foreach ($locales as $alt) {
            $href = abs_url(url_to($alt, $page, $productId));
            $hreflang = LOCALES[$alt]['html'] ?? $alt;
            $xml .= '    <xhtml:link rel="alternate" hreflang="' . e($hreflang) . '" href="' . e($href) . "\"/>\n";
        }
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';
    return $xml;
}

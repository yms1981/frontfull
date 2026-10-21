<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function fv_https(): bool
{
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        return true;
    }
    return strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https';
}

function fv_base(): string
{
    if (FV_BASE !== '') {
        return rtrim(FV_BASE, '/');
    }
    $script = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php'));
    if (str_ends_with($script, '/router.php')) {
        return '';
    }
    if (str_ends_with($script, '/index.php')) {
        $dir = rtrim(str_replace('\\', '/', dirname($script)), '/');
        return ($dir === '' || $dir === '/' || $dir === '.') ? '' : $dir;
    }
    return '';
}

function fv_origin(): string
{
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return (fv_https() ? 'https' : 'http') . '://' . $host;
}

function fv_cut(string $value, int $max): string
{
    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, $max);
    }
    return substr($value, 0, $max);
}

function fv_lower(string $value): string
{
    return function_exists('mb_strtolower') ? mb_strtolower($value) : strtolower($value);
}

function safe_hex(string $hex): string
{
    return preg_match('/^#[0-9a-fA-F]{6}$/', $hex) ? $hex : '#e10613';
}

function safe_slug(string $slug, string $fallback): string
{
    if (preg_match('/^[\p{L}\p{N}]+(?:-[\p{L}\p{N}]+)*$/u', $slug)) {
        return $slug;
    }
    return $fallback;
}

function available_locales(): array
{
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }
    $cache = [];
    foreach (LOCALES as $code => $meta) {
        if (is_file(FV_ROOT . '/lang/' . $code . '.json')) {
            $cache[$code] = $meta;
        }
    }
    return $cache;
}

function load_lang(string $code): array
{
    static $cache = [];
    if (isset($cache[$code])) {
        return $cache[$code];
    }
    $file = FV_ROOT . '/lang/' . $code . '.json';
    if (!is_file($file)) {
        $cache[$code] = [];
        return $cache[$code];
    }
    try {
        $data = json_decode((string) file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $exception) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Error en lang/' . $code . '.json: ' . $exception->getMessage();
        exit;
    }
    $cache[$code] = is_array($data) ? $data : [];
    return $cache[$code];
}

function dig(array $data, string $key): mixed
{
    $node = $data;
    foreach (explode('.', $key) as $part) {
        if (!is_array($node) || !array_key_exists($part, $node)) {
            return null;
        }
        $node = $node[$part];
    }
    return $node;
}

function i18n_get(string $key): mixed
{
    global $i18n, $locale;
    $value = dig(is_array($i18n ?? null) ? $i18n : [], $key);
    if ($value !== null) {
        return $value;
    }
    foreach (['en', 'es'] as $fallback) {
        if ($fallback === ($locale ?? '')) {
            continue;
        }
        $value = dig(load_lang($fallback), $key);
        if ($value !== null) {
            return $value;
        }
    }
    return null;
}

function t(string $key, array $vars = []): string
{
    $value = i18n_get($key);
    if (!is_string($value)) {
        return $key;
    }
    foreach ($vars as $name => $replacement) {
        $value = str_replace('{' . $name . '}', (string) $replacement, $value);
    }
    return $value;
}

function ta(string $key): array
{
    $value = i18n_get($key);
    return is_array($value) ? $value : [];
}

function brand_html(string $key): string
{
    $html = '';
    foreach (preg_split("/\r\n|\n/", t($key)) ?: [] as $line) {
        $html .= '<span>';
        $parts = explode('{{brand}}', $line);
        foreach ($parts as $index => $part) {
            if ($index > 0) {
                $html .= '<b class="brand">FullVendor</b>';
            }
            $html .= e($part);
        }
        $html .= '</span>';
    }
    return $html;
}

function rich(string $key, array $vars = []): string
{
    $safe = e(t($key, $vars));
    $html = preg_replace('/\[\[(.+?)\]\]/', '<em>$1</em>', $safe);
    return $html ?? $safe;
}

function route_slug(string $lang, string $pageId): string
{
    $routes = load_lang($lang)['routes'] ?? [];
    $slug = is_array($routes) ? (string) ($routes[$pageId] ?? $pageId) : $pageId;
    return safe_slug($slug, $pageId);
}

function url_to(string $lang, string $pageId = 'home', ?string $slug = null, array $query = []): string
{
    $path = rtrim(fv_base(), '/') . '/' . $lang;
    if ($pageId === 'product') {
        $path .= '/' . route_slug($lang, 'products') . '/' . rawurlencode((string) $slug);
    } elseif ($pageId !== 'home' && $pageId !== 'notfound') {
        $path .= '/' . route_slug($lang, $pageId);
    }
    if ($query !== []) {
        $path .= '?' . http_build_query($query);
    }
    return $path;
}

function abs_url(string $path): string
{
    return fv_origin() . $path;
}

function redirect_to(string $to, int $code = 302): void
{
    header('Location: ' . $to, true, $code);
    exit;
}

function detect_lang(): string
{
    $available = available_locales();
    $cookie = (string) ($_COOKIE['fv_lang'] ?? '');
    if (isset($available[$cookie])) {
        return $cookie;
    }
    $header = strtolower((string) ($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? ''));
    $best = null;
    $bestQ = -1.0;
    if (preg_match_all('/([a-z]{2})(?:-[a-z0-9]+)*\s*(?:;q=([0-9.]+))?/', $header, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $row) {
            $code = $row[1];
            $quality = isset($row[2]) && $row[2] !== '' ? (float) $row[2] : 1.0;
            if (isset($available[$code]) && $quality > $bestQ) {
                $best = $code;
                $bestQ = $quality;
            }
        }
    }
    if ($best !== null) {
        return $best;
    }
    if (isset($available['es'])) {
        return 'es';
    }
    return (string) array_key_first($available);
}

function lang_switch_query(): array
{
    global $pageId;
    $query = [];
    $product = (string) ($_GET['producto'] ?? '');
    if (isset(FV_PRODUCTS[$product])) {
        $query['producto'] = $product;
    }
    if (($pageId ?? '') === 'search') {
        $term = trim((string) ($_GET['q'] ?? ''));
        if ($term !== '') {
            $query['q'] = fv_cut($term, 80);
        }
    }
    return $query;
}

function nav_on(string $id): string
{
    global $pageId;
    $current = $pageId === 'product' ? 'products' : $pageId;
    return $current === $id ? ' is-active' : '';
}

function page_meta(): array
{
    global $pageId, $slug;
    return match ($pageId) {
        'home' => [t('meta.home_title'), t('meta.home_desc')],
        'product' => [
            t('meta.product_title', ['name' => FV_PRODUCTS[$slug]['name'] ?? '']),
            t('products.' . $slug . '.lead'),
        ],
        'privacy' => [t('meta.privacy_title'), t('legal.privacy_intro')],
        'terms' => [t('meta.terms_title'), t('legal.terms_intro')],
        'search' => [t('meta.search_title'), t('search.intro')],
        'notfound' => [t('meta.notfound_title'), t('notfound.text')],
        default => [t('meta.' . $pageId . '_title'), t('meta.' . $pageId . '_desc')],
    };
}

function icon(string $name): string
{
    $paths = [
        'grid' => '<rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/>',
        'cloud' => '<path d="M7 18h10a4 4 0 0 0 .4-8 6 6 0 0 0-11.5-1.5A3.5 3.5 0 0 0 7 18z"/>',
        'chart' => '<path d="M4 19V5M4 19h16"/><path d="M8 15l3-4 3 2 4-6"/>',
        'building' => '<path d="M4 20V7l8-3 8 3v13"/><path d="M9 20v-5h6v5"/><path d="M9 9h.01M12 9h.01M15 9h.01M9 12h.01M12 12h.01M15 12h.01"/>',
        'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9.5" cy="7" r="3"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 4.13a3 3 0 0 1 0 5.74"/>',
        'refresh' => '<path d="M20 12a8 8 0 1 1-2.1-5.4"/><path d="M20 4v5h-5"/>',
        'arrow' => '<path d="M5 12h14"/><path d="M13 6l6 6-6 6"/>',
        'search' => '<circle cx="11" cy="11" r="6.5"/><path d="M16 16l4 4"/>',
        'globe' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3c2.6 2.8 2.6 15.2 0 18"/><path d="M12 3c-2.6 2.8-2.6 15.2 0 18"/>',
        'menu' => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'close' => '<path d="M6 6l12 12M18 6L6 18"/>',
        'check' => '<path d="M5 12.5l4.2 4.2L19 7.5"/>',
        'play' => '<circle cx="12" cy="12" r="9"/><path d="M10.2 8.8v6.4l5.6-3.2z" fill="currentColor" stroke="none"/>',
    ];
    $inner = $paths[$name] ?? '';
    $class = $name === 'arrow' ? 'ico ico-dir' : 'ico';
    return '<svg class="' . $class . '" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $inner . '</svg>';
}

function demo_link(string $class, ?string $product = null, ?string $label = null): string
{
    global $locale;
    $href = url_to($locale, 'demo');
    if ($product !== null && isset(FV_PRODUCTS[$product])) {
        $href .= '?producto=' . rawurlencode($product);
    }
    $text = $label ?? t('cta.demo');
    return '<a class="' . e($class) . '" href="' . e($href) . '"><span>' . e($text) . '</span>' . icon('arrow') . '</a>';
}

function render_crumbs(array $items): void
{
    echo '<nav class="crumbs" aria-label="' . e(t('a11y.crumbs')) . '">';
    foreach ($items as $index => $item) {
        if ($index > 0) {
            echo '<span class="sep" aria-hidden="true">/</span>';
        }
        if (!empty($item[1])) {
            echo '<a href="' . e($item[1]) . '">' . e($item[0]) . '</a>';
        } else {
            echo '<span aria-current="page">' . e($item[0]) . '</span>';
        }
    }
    echo '</nav>';
}

function render_page_hero(string $eyebrow, string $titleHtml, string $text, array $crumbs, string $extraClass = ''): void
{
    echo '<section class="page-hero ' . e($extraClass) . '"><div class="container">';
    render_crumbs($crumbs);
    echo '<p class="eyebrow">' . e($eyebrow) . '</p>';
    echo '<h1>' . $titleHtml . '</h1>';
    if ($text !== '') {
        echo '<p class="lede">' . e($text) . '</p>';
    }
    echo '</div></section>';
}

function render_band(): void
{
    echo '<section class="band"><div class="container band-inner"><div>';
    echo '<h2>' . rich('band.title') . '</h2>';
    echo '<p>' . e(t('band.text')) . '</p>';
    echo '</div>' . demo_link('btn btn-primary') . '</div></section>';
}

function youtube_id(string $url): ?string
{
    if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/))([\w-]{11})~', $url, $match)) {
        return $match[1];
    }
    return null;
}

function search_catalog(): array
{
    global $locale;
    $items = [];
    foreach (FV_PRODUCTS as $id => $product) {
        $items[] = [
            'kind' => 'product',
            'title' => $product['name'],
            'text' => t('products.' . $id . '.card') . ' ' . t('products.' . $id . '.lead'),
            'href' => url_to($locale, 'product', $id),
        ];
    }
    foreach (FV_SOLUTIONS as $id => $productId) {
        $items[] = [
            'kind' => 'solution',
            'title' => t('solutions.items.' . $id . '.title'),
            'text' => t('solutions.items.' . $id . '.text'),
            'href' => url_to($locale, 'product', $productId),
        ];
    }
    foreach (array_keys(FV_INDUSTRIES) as $id) {
        $items[] = [
            'kind' => 'industry',
            'title' => t('industries.items.' . $id . '.title'),
            'text' => t('industries.items.' . $id . '.text'),
            'href' => url_to($locale, 'industries') . '#' . $id,
        ];
    }
    foreach (FV_RESOURCES as $id) {
        $points = ta('resources.items.' . $id . '.points');
        $text = t('resources.items.' . $id . '.summary');
        foreach ($points as $point) {
            if (is_string($point)) {
                $text .= ' ' . $point;
            }
        }
        $items[] = [
            'kind' => 'resource',
            'title' => t('resources.items.' . $id . '.title'),
            'text' => $text,
            'href' => url_to($locale, 'resources') . '#' . $id,
        ];
    }
    return $items;
}

function old_value(string $key): string
{
    global $oldInput;
    return (string) ($oldInput[$key] ?? '');
}

function field_error(string $key): string
{
    global $fieldErrors;
    if (empty($fieldErrors[$key])) {
        return '';
    }
    return '<small class="field-error">' . e((string) $fieldErrors[$key]) . '</small>';
}

function whatsapp_url(): ?string
{
    $digits = preg_replace('/\D+/', '', FV_WHATSAPP) ?? '';
    return $digits === '' ? null : 'https://wa.me/' . $digits;
}

function asset(string $path): string
{
    $relative = ltrim($path, '/');
    $full = FV_ROOT . '/' . $relative;
    $version = is_file($full) ? (string) filemtime($full) : '1';
    return fv_base() . '/' . $relative . '?v=' . $version;
}

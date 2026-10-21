<?php
declare(strict_types=1);

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$decoded = rawurldecode($uri);

if (preg_match('#^/(?:includes|storage|lang|pages|\.tools)(?:/|$)#', $decoded)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Forbidden';
    return true;
}

$file = __DIR__ . $decoded;
if ($decoded !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';

<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

/**
 * Sitio comercial de FullVendor.
 *
 * Para verlo en local (PHP 8.1 o superior):
 *   php -S localhost:8080 router.php
 *
 * En Apache, la carpeta del proyecto es la raíz del sitio: .htaccess
 * enruta las URLs. Si lo publicas en un subdirectorio, pon la ruta en FV_BASE
 * (por ejemplo '/fullvendor', sin barra final).
 *
 * Textos: un archivo por idioma en lang/. Para sumar un idioma, copia
 * lang/es.json, traduce solo los valores y registra el código en locales.php.
 * {{brand}} se cambia por FullVendor. [[texto]] se muestra destacado.
 * Un \n dentro de un título lo parte en líneas.
 */

const FV_ROOT = __DIR__ . '/..';
const FV_BASE = '';
const FV_DEBUG = false;

const FV_CONTACT_EMAIL = '';
const FV_CONTACT_PHONE = '';
const FV_WHATSAPP = '';
const FV_VIDEO_URL = '';

const FV_PRODUCTS = [
    'fullvendor' => ['name' => 'FullVendor', 'color' => '#e10613', 'art' => 'desktop'],
    'erp' => ['name' => 'FullVendor ERP', 'color' => '#e11d48', 'art' => 'erp'],
    'logistics' => ['name' => 'FullVendor Logistics', 'color' => '#2563eb', 'art' => 'map'],
    'supplier' => ['name' => 'Vendor Supplier', 'color' => '#16a34a', 'art' => 'portal'],
    'salesman' => ['name' => 'FullVendor Sales Man', 'color' => '#f97316', 'art' => 'phone'],
    'warehouse' => ['name' => 'FullVendor Warehouse', 'color' => '#7c3aed', 'art' => 'scan'],
    'finance' => ['name' => 'FullVendor Finance', 'color' => '#0d9488', 'art' => 'finance'],
];

const FV_SOLUTIONS = [
    'commercial' => 'fullvendor',
    'field' => 'salesman',
    'warehouse' => 'warehouse',
    'logistics' => 'logistics',
    'purchasing' => 'supplier',
    'finance' => 'finance',
];

const FV_INDUSTRIES = [
    'wholesale' => ['fullvendor', 'logistics', 'salesman'],
    'retail' => ['fullvendor', 'warehouse', 'finance'],
    'food' => ['fullvendor', 'logistics', 'warehouse'],
    'pharma' => ['fullvendor', 'warehouse', 'erp'],
    'hardware' => ['fullvendor', 'supplier', 'logistics'],
    'fmcg' => ['salesman', 'fullvendor', 'logistics'],
    'manufacturing' => ['erp', 'warehouse', 'supplier'],
    'lastmile' => ['logistics', 'warehouse', 'salesman'],
];

const FV_RESOURCES = ['unify', 'offline', 'warehouse', 'finance'];

const FV_PLANS = [
    'essential' => false,
    'professional' => true,
    'corporate' => false,
];

const FV_FAQ = ['modules', 'offline', 'multi', 'demo'];
const FV_TEAMS = ['1-10', '11-50', '51-200', '201-500', '500+'];

const FV_KPIS = [
    ['key' => 'sales', 'value' => '$24,560', 'delta' => '+12%'],
    ['key' => 'orders', 'value' => '156', 'delta' => '+8%'],
    ['key' => 'clients', 'value' => '1,248', 'delta' => '+5%'],
    ['key' => 'products', 'value' => '8,320', 'delta' => '+3%'],
];

const FV_SIDEBAR = ['dashboard', 'sales', 'purchases', 'inventory', 'clients', 'reports'];

const FV_CHANNELS = [
    ['pct' => 46, 'color' => '#e10613'],
    ['pct' => 28, 'color' => '#ff5a64'],
    ['pct' => 16, 'color' => '#ffb4b8'],
    ['pct' => 10, 'color' => '#f3d4d6'],
];

const FV_ORDERS = [
    ['id' => '10482', 'client' => 'Distribuidora Sol', 'status' => 0, 'total' => '$1,240'],
    ['id' => '10481', 'client' => 'Mercado Central', 'status' => 1, 'total' => '$860'],
    ['id' => '10480', 'client' => 'Comercial Andes', 'status' => 2, 'total' => '$2,110'],
];

const FV_TOP = [
    ['sku' => 'A', 'qty' => '1,280', 'width' => 100],
    ['sku' => 'B', 'qty' => '960', 'width' => 75],
    ['sku' => 'C', 'qty' => '740', 'width' => 58],
];

const FV_PAGES = [
    'products',
    'solutions',
    'industries',
    'pricing',
    'resources',
    'contact',
    'demo',
    'privacy',
    'terms',
    'search',
];

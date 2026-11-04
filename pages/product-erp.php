<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }

$img = static fn(string $file): string => asset('assets/img/products/erp/' . $file);

$langs = fv_landing_lang_attrs((string) $locale);
$erpLang = $langs['pack'];
$erpGoogle = $langs['google'];

$modules = [
    [
        'no' => '01',
        'title' => 'Dashboard',
        'sub' => 'Visión general del negocio',
        'desc' => 'Consulta los indicadores clave de tu empresa: compras, ventas, costos, utilidad, cuentas por cobrar y pagar. Accede rápidamente a cada módulo y observa la evolución de tu operación.',
        'file' => 'dashboard.jpg',
        'alt' => 'Overview',
    ],
    [
        'no' => '02',
        'title' => 'Sales',
        'sub' => 'Gestión de ventas',
        'desc' => 'Analiza la facturación, documentos, clientes atendidos y ticket promedio. Consulta gráficos por periodo, tipos de documento y las ventas más recientes.',
        'file' => 'sales.jpg',
        'alt' => 'Sales dashboard',
    ],
    [
        'no' => '03',
        'title' => 'Purchases',
        'sub' => 'Control de compras',
        'desc' => 'Supervisa el total de compras, órdenes, proveedores y productos adquiridos. Revisa tendencias mensuales y documentos de compra desde un panel central.',
        'file' => 'purchases.jpg',
        'alt' => 'Purchases dashboard',
    ],
    [
        'no' => '04',
        'title' => 'Inventory',
        'sub' => 'Control de inventario',
        'desc' => 'Visualiza existencias por producto y almacén, detecta productos con bajo stock, aplica filtros y realiza ajustes de inventario con trazabilidad.',
        'file' => 'inventory.jpg',
        'alt' => 'Inventory control',
    ],
    [
        'no' => '05',
        'title' => 'Finance',
        'sub' => 'Finanzas y flujo de caja',
        'desc' => 'Consulta ingresos, gastos, utilidad neta, cuentas por cobrar, cuentas por pagar y saldo bancario. Analiza el flujo de caja y la distribución de gastos.',
        'file' => 'finance.jpg',
        'alt' => 'Finance dashboard',
    ],
    [
        'no' => '06',
        'title' => 'Payroll',
        'sub' => 'Gestión de nómina',
        'desc' => 'Administra trabajadores, periodos de nómina y pagos completados. Revisa los últimos procesos, distribución por departamento y acciones rápidas.',
        'file' => 'payroll.jpg',
        'alt' => 'Payroll management',
    ],
    [
        'no' => '07',
        'title' => 'Expenses',
        'sub' => 'Control de gastos',
        'desc' => 'Registra y clasifica gastos comunes y programados. Analiza su evolución mensual, categorías y accesos directos a las tareas frecuentes.',
        'file' => 'expenses.jpg',
        'alt' => 'Expenses dashboard',
    ],
    [
        'no' => '08',
        'title' => 'Products',
        'sub' => 'Catálogo de productos',
        'desc' => 'Administra productos, categorías, estado, fotografías y existencias. Busca por SKU o nombre y controla movimientos, precios y disponibilidad.',
        'file' => 'products.jpg',
        'alt' => 'Product catalog',
    ],
    [
        'no' => '09',
        'title' => 'Company Profile',
        'sub' => 'Configuración de empresa',
        'desc' => 'Mantén actualizados los datos de identidad, parámetros, bancos, operaciones, facturación y conexiones de tu organización.',
        'file' => 'company-profile.jpg',
        'alt' => 'Company settings',
    ],
];
?>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<div class="fv-erp" id="platform" data-erp-lang="<?= e($erpLang) ?>"<?= $erpGoogle !== '' ? ' data-fv-google-lang="' . e($erpGoogle) . '"' : '' ?>>
  <section class="hero">
    <div class="wrap hero-grid">
      <div>
        <div class="eyebrow" data-t="heroTag">GESTIÓN EMPRESARIAL INTEGRAL</div>
        <h1 data-html="heroTitle">Todo tu negocio. <em>Una sola plataforma.</em></h1>
        <p data-t="heroText">Controla ventas, compras, inventario, finanzas, nómina y operaciones desde un sistema conectado, diseñado para que tengas una visión completa de tu empresa.</p>
        <div class="actions">
          <a class="primary" href="#modules" data-t="cta1">Explorar módulos</a>
          <a class="secondary" href="#benefits" data-t="cta2">Conocer la plataforma</a>
        </div>
        <div class="hero-points">
          <span data-t="b1">Información centralizada</span>
          <span data-t="b2">Módulos conectados</span>
          <span data-t="b3">Indicadores en tiempo real</span>
        </div>
      </div>
      <div class="hero-visual">
        <div class="hero-shot">
          <img src="<?= e($img('hero.jpg')) ?>" alt="FullVendor ERP dashboard" width="1200" height="900">
        </div>
        <div class="floating-stat">ÁREAS INTEGRADAS<strong>9 módulos de gestión</strong></div>
      </div>
    </div>
  </section>

  <div class="trust">
    <div class="wrap trust-row">
      <span><strong>FULLVENDOR ERP</strong> · Gestión empresarial</span>
      <span>Ventas</span>
      <span>Compras</span>
      <span>Inventario</span>
      <span>Finanzas</span>
      <span>Operaciones</span>
    </div>
  </div>

  <section class="section" id="modules">
    <div class="wrap">
      <div class="section-head">
        <div class="eyebrow" data-t="eyebrow">FULLVENDOR ERP · ECOSISTEMA EMPRESARIAL</div>
        <h2 data-t="sectionTitle">Una plataforma para cada área de tu empresa</h2>
        <p data-t="sectionText">Conecta la operación diaria con información clara, indicadores y herramientas que ayudan a tomar mejores decisiones.</p>
      </div>
      <div id="moduleList">
        <?php foreach ($modules as $index => $module): ?>
          <article class="module-card" id="module-<?= (int) $index ?>">
            <div class="module-copy">
              <span class="module-no">MÓDULO <?= e($module['no']) ?></span>
              <h3 data-mtitle="<?= (int) $index ?>"><?= e($module['title']) ?></h3>
              <h4 data-msub="<?= (int) $index ?>"><?= e($module['sub']) ?></h4>
              <p data-mdesc="<?= (int) $index ?>"><?= e($module['desc']) ?></p>
              <div class="checks">
                <span>✓ <b data-check="0">Información organizada</b></span>
                <span>✓ <b data-check="1">Control y seguimiento</b></span>
              </div>
            </div>
            <div class="screen-frame">
              <div class="screen-top"><i></i><i></i><i></i><span>FULLVENDOR</span></div>
              <img src="<?= e($img($module['file'])) ?>" alt="<?= e($module['alt']) ?>" loading="lazy" width="1200" height="900">
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="benefits" id="benefits">
    <div class="wrap benefit-grid">
      <div>
        <div class="eyebrow" data-t="nav3">Beneficios</div>
        <h2 data-t="benefitTitle">Control total. Decisiones más claras.</h2>
        <p data-t="benefitText">Centraliza tus procesos, consulta el rendimiento de cada área y mantén la información de tu empresa organizada en un solo lugar.</p>
      </div>
      <div class="benefit-list">
        <div class="benefit"><b>01</b><span data-t="b1">Información centralizada</span></div>
        <div class="benefit"><b>02</b><span data-t="b2">Módulos conectados</span></div>
        <div class="benefit"><b>03</b><span data-t="b3">Indicadores en tiempo real</span></div>
        <div class="benefit"><b>04</b><span data-t="b4">Acceso desde cualquier lugar</span></div>
      </div>
    </div>
  </section>

  <section class="contact" id="contact">
    <div class="wrap contact-box">
      <div>
        <h2 data-t="contactTitle">Haz que tu negocio avance con FullVendor</h2>
        <p data-t="contactText">Una solución integral para administrar y hacer crecer tu empresa.</p>
      </div>
      <a class="primary" href="<?= e(url_to($locale, 'contact')) ?>" data-t="contactBtn">Solicitar información ↗</a>
    </div>
  </section>
</div>
<script src="<?= e(asset('assets/js/fullvendor-erp-i18n.js')) ?>" defer></script>
<?php if ($erpGoogle !== ''): ?>
<script src="<?= e(asset('assets/js/fv-site-translate.js')) ?>" defer></script>
<?php endif; ?>


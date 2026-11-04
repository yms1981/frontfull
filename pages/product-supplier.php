<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }

$img = static fn(string $file): string => asset('assets/img/products/supplier/' . $file);

$langs = fv_landing_lang_attrs((string) $locale);
$supplierLang = $langs['pack'];
$supplierGoogle = $langs['google'];
?>
<div class="fv-supplier" id="top" data-supplier-lang="<?= e($supplierLang) ?>"<?= $supplierGoogle !== '' ? ' data-fv-google-lang="' . e($supplierGoogle) . '"' : '' ?>>
  <section class="hero">
    <div class="wrap hero-grid">
      <div>
        <div class="kicker" data-t="kicker">SUPPLIER PORTAL · GESTIÓN DE PROVEEDORES</div>
        <h1 data-t="heroTitle">Compra mejor.<br><em>Crece en equipo.</em></h1>
        <p data-t="heroDesc">El portal de proveedores de FullVendor conecta tu empresa con sus proveedores en un entorno centralizado. Gestiona órdenes de compra, consulta productos y organiza la información de tu red de suministro desde un solo lugar.</p>
        <div class="actions">
          <a class="btn" href="#modules" data-t="explore">Explorar módulos</a>
          <a class="plain" href="#benefits"><span data-t="discover">Conocer la plataforma</span> <b>↗</b></a>
        </div>
      </div>
      <div class="hero-shot">
        <img src="<?= e($img('hero.jpg')) ?>" alt="Supplier Portal - pantalla de inicio de sesión" width="1499" height="1004">
        <div class="floating"><strong>7</strong><span data-t="screensTag">áreas de gestión ilustradas</span></div>
      </div>
    </div>
  </section>

  <section class="trust">
    <div class="wrap trustline">
      <span data-t="trust1">Órdenes de compra centralizadas</span>
      <span data-t="trust2">Directorio de proveedores</span>
      <span data-t="trust3">Catálogo de productos</span>
      <span data-t="trust4">Administración de usuarios</span>
    </div>
  </section>

  <section class="intro wrap" id="modules">
    <div class="eyebrow" data-t="eyebrow">UNA PLATAFORMA, TODO CONECTADO</div>
    <h2 data-t="modulesTitle">Herramientas para gestionar tu red de suministro</h2>
    <p data-t="modulesDesc">Desde la creación de órdenes hasta el mantenimiento del catálogo y los accesos, el Supplier Portal reúne las tareas principales de tu operación en una interfaz clara y sencilla.</p>
  </section>

  <div class="wrap modules">
    <section class="module">
      <div class="copy">
        <small class="eyebrow" data-t="m1Label">MÓDULO 01 · COMPRAS</small>
        <h2 data-t="m1Title">Orders</h2>
        <h3 data-t="m1Sub">Control de órdenes de compra</h3>
        <p data-t="m1Desc">Consulta y administra órdenes de compra y pedidos asociados a tus proveedores. Revisa referencias, tipo de orden, estado, proveedor, fechas e importes desde una vista central. Los indicadores superiores ayudan a identificar el volumen de órdenes, las que aún no tienen factura y las completadas.</p>
        <ul>
          <li><i>✓</i><span data-t="m1b1">Resumen de órdenes e importes</span></li>
          <li><i>✓</i><span data-t="m1b2">Filtros por fecha, tipo, estado y proveedor</span></li>
          <li><i>✓</i><span data-t="m1b3">Sincronización de facturas y creación de órdenes</span></li>
          <li><i>✓</i><span data-t="m1b4">Seguimiento de órdenes abiertas y completadas</span></li>
        </ul>
      </div>
      <div class="screen">
        <div class="screen-top"><span>FULLVENDOR · SUPPLIER PORTAL</span><span class="dots"><i></i><i></i><i></i></span></div>
        <img src="<?= e($img('orders.jpg')) ?>" alt="Panel de órdenes de compra" loading="lazy" width="1143" height="993">
      </div>
    </section>

    <section class="module reverse">
      <div class="copy">
        <small class="eyebrow" data-t="m2Label">MÓDULO 02 · RED COMERCIAL</small>
        <h2 data-t="m2Title">Suppliers</h2>
        <h3 data-t="m2Sub">Directorio centralizado de proveedores</h3>
        <p data-t="m2Desc">Mantén organizada la información de las empresas proveedoras. El directorio permite localizar registros por código, compañía, contacto, correo o ciudad, y revisar los datos principales de cada proveedor para facilitar la coordinación comercial.</p>
        <ul>
          <li><i>✓</i><span data-t="m2b1">Búsqueda por empresa y datos de contacto</span></li>
          <li><i>✓</i><span data-t="m2b2">Listado paginado de proveedores</span></li>
          <li><i>✓</i><span data-t="m2b3">Sincronización y registro de proveedores</span></li>
          <li><i>✓</i><span data-t="m2b4">Consulta de ciudad y país</span></li>
        </ul>
      </div>
      <div class="screen">
        <div class="screen-top"><span>FULLVENDOR · SUPPLIER PORTAL</span><span class="dots"><i></i><i></i><i></i></span></div>
        <img src="<?= e($img('suppliers.jpg')) ?>" alt="Directorio de proveedores" loading="lazy" width="1116" height="1006">
      </div>
    </section>

    <section class="module">
      <div class="copy">
        <small class="eyebrow" data-t="m3Label">MÓDULO 03 · CATÁLOGO</small>
        <h2 data-t="m3Title">Products</h2>
        <h3 data-t="m3Sub">Administración del catálogo de productos</h3>
        <p data-t="m3Desc">Consulta el catálogo de artículos vinculados a tus proveedores. La vista reúne SKU, código de barras, nombre, unidad de medida, cantidad mínima de pedido, precios y categoría. También incluye herramientas para sincronizar productos, cargar fotografías por SKU y registrar nuevos artículos.</p>
        <ul>
          <li><i>✓</i><span data-t="m3b1">Búsqueda por SKU, código de barras o nombre</span></li>
          <li><i>✓</i><span data-t="m3b2">Consulta de MOQ y precios</span></li>
          <li><i>✓</i><span data-t="m3b3">Carga de fotografías por SKU</span></li>
          <li><i>✓</i><span data-t="m3b4">Organización por categorías</span></li>
        </ul>
      </div>
      <div class="screen">
        <div class="screen-top"><span>FULLVENDOR · SUPPLIER PORTAL</span><span class="dots"><i></i><i></i><i></i></span></div>
        <img src="<?= e($img('products.jpg')) ?>" alt="Catálogo de productos" loading="lazy" width="1467" height="1004">
      </div>
    </section>

    <section class="module reverse">
      <div class="copy">
        <small class="eyebrow" data-t="m4Label">MÓDULO 04 · ORGANIZACIÓN</small>
        <h2 data-t="m4Title">Categories</h2>
        <h3 data-t="m4Sub">Clasificación clara de productos</h3>
        <p data-t="m4Desc">Organiza el catálogo mediante categorías y códigos de identificación. La pantalla permite buscar por nombre o identificador, consultar el listado y sincronizar las categorías para mantener una estructura consistente en el catálogo.</p>
        <ul>
          <li><i>✓</i><span data-t="m4b1">Listado de categorías con imagen</span></li>
          <li><i>✓</i><span data-t="m4b2">Búsqueda por nombre o código</span></li>
          <li><i>✓</i><span data-t="m4b3">Paginación de resultados</span></li>
          <li><i>✓</i><span data-t="m4b4">Sincronización de categorías</span></li>
        </ul>
      </div>
      <div class="screen">
        <div class="screen-top"><span>FULLVENDOR · SUPPLIER PORTAL</span><span class="dots"><i></i><i></i><i></i></span></div>
        <img src="<?= e($img('categories.jpg')) ?>" alt="Listado de categorías" loading="lazy" width="1466" height="1001">
      </div>
    </section>

    <section class="module">
      <div class="copy">
        <small class="eyebrow" data-t="m5Label">MÓDULO 05 · SEGURIDAD</small>
        <h2 data-t="m5Title">Users</h2>
        <h3 data-t="m5Sub">Gestión de cuentas y roles</h3>
        <p data-t="m5Desc">Administra las cuentas que acceden al portal. Consulta nombre de usuario, nombre, correo, rol y proveedor asociado. Los filtros facilitan localizar usuarios y revisar la distribución de accesos entre administradores y usuarios de proveedores.</p>
        <ul>
          <li><i>✓</i><span data-t="m5b1">Búsqueda por usuario, nombre, correo o teléfono</span></li>
          <li><i>✓</i><span data-t="m5b2">Filtro por rol</span></li>
          <li><i>✓</i><span data-t="m5b3">Identificación de administradores y proveedores</span></li>
          <li><i>✓</i><span data-t="m5b4">Alta de nuevos usuarios</span></li>
        </ul>
      </div>
      <div class="screen">
        <div class="screen-top"><span>FULLVENDOR · SUPPLIER PORTAL</span><span class="dots"><i></i><i></i><i></i></span></div>
        <img src="<?= e($img('users.jpg')) ?>" alt="Administración de usuarios" loading="lazy" width="1464" height="995">
      </div>
    </section>

    <section class="module reverse">
      <div class="copy">
        <small class="eyebrow" data-t="m6Label">MÓDULO 06 · CUENTA</small>
        <h2 data-t="m6Title">My account</h2>
        <h3 data-t="m6Sub">Perfil y seguridad personal</h3>
        <p data-t="m6Desc">Cada usuario puede mantener su perfil actualizado, cambiar su contraseña y administrar su fotografía de cuenta. La pantalla reúne los campos de contraseña actual, nueva y confirmación, además de la carga de imagen de perfil.</p>
        <ul>
          <li><i>✓</i><span data-t="m6b1">Actualización de contraseña</span></li>
          <li><i>✓</i><span data-t="m6b2">Cambio de fotografía de perfil</span></li>
          <li><i>✓</i><span data-t="m6b3">Información de usuario y rol</span></li>
          <li><i>✓</i><span data-t="m6b4">Controles básicos de seguridad</span></li>
        </ul>
      </div>
      <div class="screen">
        <div class="screen-top"><span>FULLVENDOR · SUPPLIER PORTAL</span><span class="dots"><i></i><i></i><i></i></span></div>
        <img src="<?= e($img('account.jpg')) ?>" alt="Perfil de usuario y seguridad" loading="lazy" width="1477" height="993">
      </div>
    </section>
  </div>

  <section class="benefits" id="benefits">
    <div class="wrap">
      <div class="eyebrow" data-t="benefitEyebrow">UNA OPERACIÓN MÁS ORDENADA</div>
      <h2 data-t="benefitTitle">Todo tu ecosistema de proveedores, bajo control.</h2>
      <p data-t="benefitDesc">Una experiencia unificada para dar seguimiento a las órdenes, mantener actualizado el catálogo y administrar los accesos de tu equipo.</p>
      <div class="benefit-grid">
        <div class="benefit">
          <div class="ico">↗</div>
          <h3 data-t="ben1Title">Visibilidad operativa</h3>
          <p data-t="ben1Desc">Indicadores y estados para comprender rápidamente el movimiento de las órdenes.</p>
        </div>
        <div class="benefit">
          <div class="ico">▦</div>
          <h3 data-t="ben2Title">Información centralizada</h3>
          <p data-t="ben2Desc">Proveedores, productos y categorías organizados en un mismo portal.</p>
        </div>
        <div class="benefit">
          <div class="ico">♙</div>
          <h3 data-t="ben3Title">Accesos administrados</h3>
          <p data-t="ben3Desc">Cuentas y roles identificados para mantener orden en el acceso al sistema.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="cta" id="contact">
    <div class="wrap">
      <div class="eyebrow" data-t="ctaEyebrow">FULLVENDOR SUPPLIER PORTAL</div>
      <h2 data-t="ctaTitle">Conecta tus compras con tus proveedores.</h2>
      <p data-t="ctaDesc">Centraliza la gestión de órdenes, proveedores y productos con una plataforma diseñada para simplificar el trabajo diario.</p>
      <a class="btn" href="<?= e(url_to($locale, 'contact')) ?>" data-t="ctaButton">Conocer FullVendor ↗</a>
    </div>
  </section>
</div>
<script src="<?= e(asset('assets/js/fullvendor-supplier-i18n.js')) ?>" defer></script>
<?php if ($supplierGoogle !== ''): ?>
<script src="<?= e(asset('assets/js/fv-site-translate.js')) ?>" defer></script>
<?php endif; ?>


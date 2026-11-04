<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }

$langs = fv_landing_lang_attrs((string) $locale);
$whLang = $langs['pack'];
$whGoogle = $langs['google'];

$img = static function (string $file) use ($whLang): string {
    $localized = 'assets/img/products/warehouse/' . $whLang . '/' . $file;
    if (is_file(FV_ROOT . '/' . $localized)) {
        return asset($localized);
    }
    return asset('assets/img/products/warehouse/' . $file);
};
?>
<div class="fv-warehouse" id="top" data-warehouse-lang="<?= e($whLang) ?>"<?= $whGoogle !== '' ? ' data-fv-google-lang="' . e($whGoogle) . '"' : '' ?>>
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-copy">
        <div class="kicker">Control de almacén, siempre conectado</div>
        <h1>Organiza tu almacén.<br><em>Gestiona con</em><br>precisión.</h1>
        <p class="hero-lead">FullVendor Warehouse conecta la recepción de pedidos, el historial, las notas de crédito, el inventario y la comunicación del equipo en una sola aplicación móvil.</p>
        <div class="hero-actions">
          <a class="button" href="#capturas">Explorar la aplicación <span>→</span></a>
          <a class="button secondary" href="#funciones">Conocer funciones</a>
        </div>
        <div class="hero-note">
          <span><b class="check">✓</b> Recepción y despacho</span>
          <span><b class="check">✓</b> Control de inventario</span>
          <span><b class="check">✓</b> Gestión de órdenes</span>
        </div>
      </div>
      <div class="hero-visual">
        <div class="orbit"></div>
        <div class="float-label one">📦 Operaciones de almacén</div>
        <div class="float-label two">📋 Pedidos e inventario</div>
        <div class="hero-device">
          <img alt="FullVendor Warehouse — pantalla principal" src="<?= e($img('overview.png')) ?>" width="728" height="903">
        </div>
      </div>
    </div>
  </section>

  <div class="trust-strip">
    <div class="container trust-inner">
      <span><b>FullVendor</b> · Ecosistema empresarial</span>
      <span>Recepción de pedidos</span>
      <span>Control de inventario</span>
      <span>Operaciones logísticas</span>
    </div>
  </div>

  <section class="section overview" id="funciones">
    <div class="container">
      <div class="section-head">
        <span class="eyebrow">Una app para el día a día</span>
        <h2>Todo el almacén bajo control</h2>
        <p>Centraliza las tareas operativas y consulta la información clave desde una interfaz clara, visual y fácil de usar.</p>
      </div>
      <div class="overview-grid">
        <div class="overview-card"><div class="overview-icon">▣</div><h3>Pedidos recibidos</h3><p>Identifica órdenes entrantes y pendientes de procesar.</p></div>
        <div class="overview-card"><div class="overview-icon">▤</div><h3>Historial de órdenes</h3><p>Busca y consulta operaciones procesadas y sus estados.</p></div>
        <div class="overview-card"><div class="overview-icon">＄</div><h3>Notas de crédito</h3><p>Registra y revisa devoluciones y ajustes de crédito.</p></div>
        <div class="overview-card"><div class="overview-icon">▦</div><h3>Inventario</h3><p>Controla órdenes, productos, cantidades y empaques.</p></div>
        <div class="overview-card"><div class="overview-icon">☷</div><h3>Detalle de productos</h3><p>Verifica SKU, unidades, cajas y precios por artículo.</p></div>
        <div class="overview-card"><div class="overview-icon">▰</div><h3>Chat de empresa</h3><p>Comunícate con administradores y miembros del equipo.</p></div>
      </div>
    </div>
  </section>

  <section class="section features" id="capturas">
    <div class="container">
      <div class="section-head">
        <span class="eyebrow">Conoce cada pantalla</span>
        <h2>Una experiencia móvil para la operación de almacén</h2>
        <p>Las capturas originales de FullVendor Warehouse se muestran completas dentro de marcos de dispositivo, sin recortar el contenido de las pantallas.</p>
      </div>

      <?php
      $shots = [
          ['01 · Panel principal', 'Tu operación de almacén en una sola pantalla', 'Visualiza pedidos recibidos, historial de órdenes, notas de crédito, inventario y comunicación con tu equipo desde un panel central.', 'Gestión rápida del almacén', 'Indicadores y accesos directos', 'overview.png', 728, 903],
          ['02 · Pedidos recibidos', 'Revisa los pedidos pendientes de recibir', 'Consulta los pedidos entrantes que requieren procesamiento. Cuando no hay órdenes pendientes, la aplicación muestra claramente el estado vacío para que sepas que no hay tareas por recibir.', 'Pedidos pendientes', 'Actualización del estado', 'pending-receive.png', 728, 903],
          ['03 · Historial de pedidos', 'Control y seguimiento de órdenes procesadas', 'Busca órdenes, ordénalas por fecha y revisa el cliente, los datos de entrega, la cantidad de artículos, las fechas de creación y actualización y el total de cada operación.', 'Búsqueda de órdenes', 'Historial y estados', 'processed-orders.png', 728, 899],
          ['04 · Detalle de pedido', 'Toda la información de la orden, organizada', 'Accede a los datos del cliente, dirección, contacto, estado y total. Revisa además cada producto, SKU, cantidades, empaques y precios unitarios en una sola vista.', 'Datos completos del pedido', 'Detalle por producto', 'order-detail.png', 724, 966],
          ['05 · Notas de crédito', 'Gestiona devoluciones y créditos', 'Consulta las notas de crédito del mes y crea una nueva cuando sea necesario. Mantén el control de los movimientos asociados a devoluciones y ajustes.', 'Consulta mensual', 'Creación de notas', 'returns.png', 728, 922],
          ['06 · Órdenes de inventario', 'Controla las órdenes de inventario', 'Visualiza las órdenes de inventario, busca por número, revisa el cliente, el estado y las fechas. Mantén organizadas las operaciones que afectan las existencias.', 'Listado de órdenes', 'Estado y trazabilidad', 'inventory-orders.png', 728, 969],
          ['07 · Preparación y despacho', 'Prepara productos y cantidades con precisión', 'Dentro de cada orden puedes revisar los productos solicitados y gestionar cantidades y empaques antes de continuar con el despacho. La pantalla también facilita identificar la orden y al cliente.', 'Cantidades por producto', 'Control de empaques', 'prepare-products.png', 728, 969],
          ['08 · Chat de empresa', 'Comunicación directa con tu equipo', 'Mantente en contacto con administradores y vendedores. Busca contactos, identifica los chats activos e inicia conversaciones desde la misma aplicación.', 'Contactos del equipo', 'Chats activos', 'chat.png', 727, 971],
      ];
      foreach ($shots as $shot):
      ?>
        <article class="feature">
          <div class="feature-copy">
            <span class="eyebrow"><?= e($shot[0]) ?></span>
            <h3><?= e($shot[1]) ?></h3>
            <p><?= e($shot[2]) ?></p>
            <div class="feature-points">
              <span><i></i><?= e($shot[3]) ?></span>
              <span><i></i><?= e($shot[4]) ?></span>
            </div>
          </div>
          <div class="device-wrap">
            <div class="device tall">
              <div class="device-island"></div>
              <div class="device-screen">
                <img alt="<?= e($shot[1]) ?>" loading="lazy" src="<?= e($img($shot[5])) ?>" width="<?= (int) $shot[6] ?>" height="<?= (int) $shot[7] ?>">
              </div>
              <div class="device-home"></div>
            </div>
            <span class="device-glow"></span>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="cta-band" id="contacto">
    <div class="container cta-content">
      <div>
        <h2>Lleva el control de tu almacén a otro nivel.</h2>
        <p>Conecta las operaciones diarias con el ecosistema FullVendor.</p>
      </div>
      <a class="button" href="<?= e(url_to($locale, 'contact')) ?>">Conocer FullVendor ↗</a>
    </div>
  </section>
</div>
<script src="<?= e(asset('assets/js/fullvendor-warehouse-i18n.js')) ?>" defer></script>
<?php if ($whGoogle !== ''): ?>
<script src="<?= e(asset('assets/js/fv-site-translate.js')) ?>" defer></script>
<?php endif; ?>

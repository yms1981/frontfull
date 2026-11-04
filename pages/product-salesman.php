<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }

$img = static fn(string $file): string => asset('assets/img/products/salesman/' . $file);

$langs = fv_landing_lang_attrs((string) $locale);
$salesmanLang = $langs['pack'];
$salesmanGoogle = $langs['google'];
?>
<div class="fv-salesman" id="top" data-salesman-lang="<?= e($salesmanLang) ?>"<?= $salesmanGoogle !== '' ? ' data-fv-google-lang="' . e($salesmanGoogle) . '"' : '' ?>>
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-copy">
        <div class="kicker">La fuerza de ventas, siempre conectada</div>
        <h1>Vende mejor.<br><em>Gestiona desde</em><br>cualquier lugar.</h1>
        <p class="hero-lead">FullVendor Salesman reúne clientes, pedidos, productos y comunicación comercial en una aplicación móvil pensada para vendedores que trabajan en movimiento.</p>
        <div class="hero-actions">
          <a class="button" href="#capturas">Explorar la aplicación <span>→</span></a>
          <a class="button secondary" href="#funciones">Conocer funciones</a>
        </div>
        <div class="hero-note">
          <span><b class="check">✓</b> Clientes y pedidos</span>
          <span><b class="check">✓</b> Catálogo organizado</span>
          <span><b class="check">✓</b> Comunicación directa</span>
        </div>
      </div>
      <div class="hero-visual">
        <div class="orbit"></div>
        <div class="float-label one">🛒 Gestión de pedidos</div>
        <div class="float-label two">👥 Clientes en un solo lugar</div>
        <div class="hero-device">
          <img alt="Pantalla de inicio de FullVendor Salesman" src="<?= e($img('home.png')) ?>" width="931" height="1005">
        </div>
      </div>
    </div>
  </section>

  <div class="trust-strip">
    <div class="container trust-inner">
      <span><b>FullVendor</b> · Ecosistema comercial</span>
      <span>Ventas en campo</span>
      <span>Gestión de clientes</span>
      <span>Seguimiento de pedidos</span>
    </div>
  </div>

  <section class="section overview" id="funciones">
    <div class="container">
      <div class="section-head">
        <div class="eyebrow">Una app para el día a día</div>
        <h2>Todo lo que necesita tu equipo de ventas</h2>
        <p>Accede a la información comercial y continúa el trabajo con menos pasos, desde una interfaz clara y fácil de usar.</p>
      </div>
      <div class="overview-grid">
        <article class="overview-card">
          <div class="overview-icon">⌂</div>
          <h3>Panel de inicio</h3>
          <p>Indicadores rápidos y accesos a los principales módulos de trabajo.</p>
        </article>
        <article class="overview-card">
          <div class="overview-icon">▤</div>
          <h3>Pedidos</h3>
          <p>Consulta órdenes pendientes y completadas, con búsqueda y datos de cada pedido.</p>
        </article>
        <article class="overview-card">
          <div class="overview-icon">◇</div>
          <h3>Categorías</h3>
          <p>Explora el catálogo por familias y encuentra rápidamente lo que busca el cliente.</p>
        </article>
        <article class="overview-card">
          <div class="overview-icon">▣</div>
          <h3>Nuevo pedido</h3>
          <p>Selecciona al cliente para iniciar el proceso de creación de una orden.</p>
        </article>
        <article class="overview-card">
          <div class="overview-icon">♙</div>
          <h3>Clientes</h3>
          <p>Consulta contactos, ubicación, balance y opciones de comunicación.</p>
        </article>
        <article class="overview-card">
          <div class="overview-icon">▰</div>
          <h3>Chat de empresa</h3>
          <p>Conversa con los administradores y revisa los chats activos.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section features" id="capturas">
    <div class="container">
      <div class="section-head">
        <div class="eyebrow">Conoce cada pantalla</div>
        <h2>Una experiencia móvil para vender en movimiento</h2>
        <p>Las capturas originales de FullVendor Salesman se presentan dentro de marcos de dispositivo para mostrar cómo se ve la aplicación en uso.</p>
      </div>

      <article class="feature feature-wide" id="feature-1">
        <div class="feature-copy">
          <span class="eyebrow">01 · Inicio</span>
          <h3>Un centro de trabajo para el vendedor</h3>
          <p>Consulta de un vistazo la actividad del mes, el cliente seleccionado y los accesos directos a pedidos, categorías, productos y clientes.</p>
          <div class="feature-points">
            <span><i></i>Diseñado para ventas en campo</span>
            <span><i></i>Información conectada con FullVendor</span>
          </div>
        </div>
        <div class="device-wrap">
          <div class="device wide">
            <div class="device-island"></div>
            <div class="device-screen">
              <img alt="Captura de FullVendor Salesman: Inicio" loading="lazy" src="<?= e($img('inicio.png')) ?>" width="931" height="1005">
            </div>
            <div class="device-home"></div>
          </div>
          <span class="device-glow"></span>
        </div>
      </article>

      <article class="feature feature-wide" id="feature-2">
        <div class="feature-copy">
          <span class="eyebrow">02 · Pedidos</span>
          <h3>Control de pedidos pendientes y completados</h3>
          <p>Busca pedidos por cliente, correo o teléfono y cambia entre pedidos pendientes y completados. Revisa el importe, la cantidad de productos y el estado de cada operación.</p>
          <div class="feature-points">
            <span><i></i>Diseñado para ventas en campo</span>
            <span><i></i>Información conectada con FullVendor</span>
          </div>
        </div>
        <div class="device-wrap">
          <div class="device wide">
            <div class="device-island"></div>
            <div class="device-screen">
              <img alt="Captura de FullVendor Salesman: Pedidos" loading="lazy" src="<?= e($img('pedidos.png')) ?>" width="931" height="1005">
            </div>
            <div class="device-home"></div>
          </div>
          <span class="device-glow"></span>
        </div>
      </article>

      <article class="feature feature-tall" id="feature-3">
        <div class="feature-copy">
          <span class="eyebrow">03 · Categorías</span>
          <h3>Encuentra productos por categoría</h3>
          <p>Explora el catálogo visual organizado por categorías. Las imágenes y los contadores permiten identificar rápidamente dónde están los productos que necesita cada cliente.</p>
          <div class="feature-points">
            <span><i></i>Diseñado para ventas en campo</span>
            <span><i></i>Información conectada con FullVendor</span>
          </div>
        </div>
        <div class="device-wrap">
          <div class="device tall">
            <div class="device-island"></div>
            <div class="device-screen">
              <img alt="Captura de FullVendor Salesman: Categorías" loading="lazy" src="<?= e($img('categorias.png')) ?>" width="673" height="1005">
            </div>
            <div class="device-home"></div>
          </div>
          <span class="device-glow"></span>
        </div>
      </article>

      <article class="feature feature-tall" id="feature-4">
        <div class="feature-copy">
          <span class="eyebrow">04 · Nuevo pedido</span>
          <h3>Crea pedidos desde la selección del cliente</h3>
          <p>Busca entre los clientes disponibles y selecciona la cuenta correcta para comenzar una nueva orden de venta.</p>
          <div class="feature-points">
            <span><i></i>Diseñado para ventas en campo</span>
            <span><i></i>Información conectada con FullVendor</span>
          </div>
        </div>
        <div class="device-wrap">
          <div class="device tall">
            <div class="device-island"></div>
            <div class="device-screen">
              <img alt="Captura de FullVendor Salesman: Nuevo pedido" loading="lazy" src="<?= e($img('nuevo-pedido.png')) ?>" width="673" height="1005">
            </div>
            <div class="device-home"></div>
          </div>
          <span class="device-glow"></span>
        </div>
      </article>

      <article class="feature feature-tall" id="feature-5">
        <div class="feature-copy">
          <span class="eyebrow">05 · Clientes</span>
          <h3>Toda la información del cliente en un solo lugar</h3>
          <p>Consulta datos comerciales, contacto, ubicación y balance pendiente. Desde la ficha puedes enviar catálogos, contactar por email o continuar la conversación por WhatsApp.</p>
          <div class="feature-points">
            <span><i></i>Diseñado para ventas en campo</span>
            <span><i></i>Información conectada con FullVendor</span>
          </div>
        </div>
        <div class="device-wrap">
          <div class="device tall">
            <div class="device-island"></div>
            <div class="device-screen">
              <img alt="Captura de FullVendor Salesman: Clientes" loading="lazy" src="<?= e($img('clientes.png')) ?>" width="673" height="1005">
            </div>
            <div class="device-home"></div>
          </div>
          <span class="device-glow"></span>
        </div>
      </article>

      <article class="feature feature-tall" id="feature-6">
        <div class="feature-copy">
          <span class="eyebrow">06 · Chat de empresa</span>
          <h3>Comunicación directa con los administradores</h3>
          <p>Consulta los chats activos y comunícate con los responsables de tu empresa desde la aplicación, sin salir del flujo de trabajo.</p>
          <div class="feature-points">
            <span><i></i>Diseñado para ventas en campo</span>
            <span><i></i>Información conectada con FullVendor</span>
          </div>
        </div>
        <div class="device-wrap">
          <div class="device tall">
            <div class="device-island"></div>
            <div class="device-screen">
              <img alt="Captura de FullVendor Salesman: Chat de empresa" loading="lazy" src="<?= e($img('chat.png')) ?>" width="673" height="1005">
            </div>
            <div class="device-home"></div>
          </div>
          <span class="device-glow"></span>
        </div>
      </article>
    </div>
  </section>

  <section class="cta-band" id="contacto">
    <div class="container cta-content">
      <div>
        <h2>Impulsa la productividad de tu equipo comercial.</h2>
        <p>Conecta la gestión diaria de vendedores con el ecosistema FullVendor.</p>
      </div>
      <a class="button" href="<?= e(url_to($locale, 'contact')) ?>">Conocer FullVendor ↗</a>
    </div>
  </section>
</div>
<script src="<?= e(asset('assets/js/fullvendor-salesman-i18n.js')) ?>" defer></script>
<?php if ($salesmanGoogle !== ''): ?>
<script src="<?= e(asset('assets/js/fv-site-translate.js')) ?>" defer></script>
<?php endif; ?>


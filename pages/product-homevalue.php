<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }

$img = static fn(string $file): string => asset('assets/img/products/homevalue/' . $file);

$langs = fv_landing_lang_attrs((string) $locale);
$hvLang = $langs['pack'];
$hvGoogle = $langs['google'];
?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<div class="fv-homevalue" id="top" data-hv-lang="<?= e($hvLang) ?>"<?= $hvGoogle !== '' ? ' data-fv-google-lang="' . e($hvGoogle) . '"' : '' ?>>
  <section class="hero">
    <div class="wrap heroGrid">
      <div class="heroCopy">
        <div class="pill"><i></i><span data-k="heroTag">PLATAFORMA MAYORISTA · HOME VALUE LLC</span></div>
        <h1 data-k-html="heroTitle">Todo lo que tu negocio necesita, <em>en un solo lugar.</em></h1>
        <p data-k="heroText">Explora miles de productos para tiendas, supermercados y restaurantes. Consulta disponibilidad, organiza tus compras por caja y mantente conectado con Home Value.</p>
        <a class="btn" href="https://homevalue-store.com/en/catalog" target="_blank" rel="noopener"><span data-k="heroBtn">Explorar catálogo</span> →</a>
        <div class="note"><b>✓</b><span data-k="heroNote">Precios mayoristas disponibles para cuentas aprobadas.</span></div>
      </div>
      <div class="heroVisual">
        <div class="hero-frame">
          <div class="hero-frame-bar" aria-hidden="true">
            <span class="hero-frame-dots"><i></i><i></i><i></i></span>
            <span class="hero-frame-title">Home Value · Wholesale catalog</span>
          </div>
          <img
            src="<?= e($img('hero-catalog.jpg')) ?>"
            alt="Home Value wholesale catalog"
            width="2259"
            height="1218"
            decoding="async"
            fetchpriority="high"
          >
        </div>
        <div class="stat"><strong>1,170+</strong><span>Wholesale products</span></div>
      </div>
    </div>
  </section>

  <section class="band features-band">
    <div class="wrap">
      <div class="sectionHead">
        <div class="kicker">HOME VALUE LLC</div>
        <h2 data-k="screens">Conoce las principales secciones</h2>
        <p data-k="screensSub">Una vista de las herramientas que forman parte de la experiencia Home Value.</p>
      </div>
      <div class="features">
        <article class="feature">
          <div class="ficon" aria-hidden="true">▣</div>
          <h3 data-k="f1">Catálogo</h3>
          <p data-k="d1">Explora productos por categoría, SKU y disponibilidad antes de comprar.</p>
        </article>
        <article class="feature">
          <div class="ficon" aria-hidden="true">▤</div>
          <h3 data-k="f2">Historias</h3>
          <p data-k="d2">Descubre novedades y productos destacados en reels diarios.</p>
        </article>
        <article class="feature">
          <div class="ficon" aria-hidden="true">♟</div>
          <h3 data-k="f3">Contacto</h3>
          <p data-k="d3">Comunícate con el equipo comercial para cuentas y pedidos.</p>
        </article>
        <article class="feature">
          <div class="ficon" aria-hidden="true">▱</div>
          <h3 data-k="f4">Administración</h3>
          <p data-k="d4">Supervisa visitas, pedidos y la actividad de la tienda.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="screens">
    <div class="wrap">
      <div class="sectionHead">
        <div class="kicker">HOME VALUE LLC</div>
        <h2 data-k="features">Una plataforma creada para comprar mejor</h2>
        <p data-k="featuresSub">Herramientas para descubrir productos, realizar pedidos y mantener una relación directa con nuestro equipo.</p>
      </div>
      <div class="showcases">
        <article class="showcase" id="catalog">
          <div class="shot"><img src="<?= e($img('shot-catalog.jpg')) ?>" alt="catalog screenshot" width="800" height="500" loading="lazy"></div>
          <div class="shotcopy">
            <div class="eyebrow" data-k="tagCatalog">01 · COMPRAS MAYORISTAS</div>
            <h3 data-k="catalog">Catálogo mayorista</h3>
            <p data-k="catalogDesc">Explora el inventario por categorías o busca directamente por nombre y SKU. Consulta disponibilidad, revisa presentaciones, cantidades por caja y MOQ antes de preparar tu compra. Los precios mayoristas aparecen al iniciar sesión con una cuenta aprobada.</p>
            <a class="textlink" href="https://homevalue-store.com/en/catalog" target="_blank" rel="noopener"><span data-k="heroBtn">Explorar catálogo</span> <b>↗</b></a>
          </div>
        </article>

        <article class="showcase reverse" id="stories">
          <div class="shot"><img src="<?= e($img('shot-stories.jpg')) ?>" alt="stories screenshot" width="800" height="500" loading="lazy"></div>
          <div class="shotcopy">
            <div class="eyebrow" data-k="tagStories">02 · CONTENIDO Y NOVEDADES</div>
            <h3 data-k="stories">Historias y reels diarios</h3>
            <p data-k="storiesDesc">Descubre productos destacados, novedades y contenido de Home Value mediante reels breves. Una forma visual de conocer artículos, promociones y novedades del catálogo. Las publicaciones diarias permanecen disponibles durante siete días.</p>
            <a class="textlink" href="https://homevalue-store.com/en/blog" target="_blank" rel="noopener"><span data-k="heroBtn">Explorar catálogo</span> <b>↗</b></a>
          </div>
        </article>

        <article class="showcase" id="contact">
          <div class="shot"><img src="<?= e($img('shot-contact.jpg')) ?>" alt="contact screenshot" width="800" height="500" loading="lazy"></div>
          <div class="shotcopy">
            <div class="eyebrow" data-k="tagContact">03 · SOPORTE COMERCIAL</div>
            <h3 data-k="contact">Contacto y atención comercial</h3>
            <p data-k="contactDesc">Comunícate con el equipo de Home Value para consultas de ventas, cuentas mayoristas, soporte de pedidos y logística. Completa el formulario con tus datos, el motivo de contacto y un mensaje para que el equipo pueda orientarte.</p>
            <a class="textlink" href="<?= e(url_to($locale, 'contact')) ?>"><span data-k="heroBtn">Explorar catálogo</span> <b>↗</b></a>
          </div>
        </article>

        <article class="showcase reverse" id="admin">
          <div class="shot"><img src="<?= e($img('shot-admin.jpg')) ?>" alt="admin screenshot" width="800" height="500" loading="lazy"></div>
          <div class="shotcopy">
            <div class="eyebrow" data-k="tagAdmin">04 · CONTROL Y ANALÍTICA</div>
            <h3 data-k="admin">Panel de administración</h3>
            <p data-k="adminDesc">Un espacio de gestión para supervisar la actividad de la tienda: visitas, usuarios, inicios de sesión, pedidos, búsquedas y acciones registradas. Incluye filtros por período y gráficos para analizar el comportamiento de la plataforma.</p>
            <a class="textlink" href="https://homevalue-store.com/en/" target="_blank" rel="noopener"><span data-k="heroBtn">Explorar catálogo</span> <b>↗</b></a>
          </div>
        </article>

        <article class="showcase" id="profile">
          <div class="shot"><img src="<?= e($img('shot-profile.jpg')) ?>" alt="profile screenshot" width="800" height="500" loading="lazy"></div>
          <div class="shotcopy">
            <div class="eyebrow" data-k="tagProfile">05 · CUENTA Y SEGURIDAD</div>
            <h3 data-k="profile">Perfil y seguridad de la cuenta</h3>
            <p data-k="profileDesc">Consulta la información de tu perfil y actualiza tu contraseña. Esta sección ayuda a mantener tus credenciales protegidas y administrar el acceso a tu cuenta.</p>
            <a class="textlink" href="https://homevalue-store.com/en/" target="_blank" rel="noopener"><span data-k="heroBtn">Explorar catálogo</span> <b>↗</b></a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="benefits">
    <div class="wrap benefitGrid">
      <div class="benefitCard">
        <div class="kicker" style="color:#ffb5b6">HOME VALUE WHOLESALE</div>
        <h3 data-k="workflow">Una experiencia mayorista más sencilla</h3>
        <p>Browse a broad wholesale selection and connect with a dedicated team for account and order support.</p>
        <div class="chips">
          <div class="chip"><b>1,170+</b><span>Products</span></div>
          <div class="chip"><b>30+</b><span>Categories</span></div>
          <div class="chip"><b>7 days</b><span>Daily stories</span></div>
        </div>
      </div>
      <div>
        <div class="kicker">HOW IT WORKS</div>
        <h2 style="font-size:30px;letter-spacing:-1px;margin:12px 0 25px" data-k="workflow">Una experiencia mayorista más sencilla</h2>
        <div class="benefitList">
          <div class="benefit">
            <div class="check">✓</div>
            <div>
              <h4 data-k="w1">Encuentra lo que buscas</h4>
              <p data-k="wd1">Navega por categorías, utiliza la búsqueda y localiza productos por SKU.</p>
            </div>
          </div>
          <div class="benefit">
            <div class="check">✓</div>
            <div>
              <h4 data-k="w2">Verifica disponibilidad</h4>
              <p data-k="wd2">Consulta existencias y condiciones de compra antes de preparar el pedido.</p>
            </div>
          </div>
          <div class="benefit">
            <div class="check">✓</div>
            <div>
              <h4 data-k="w3">Mantente conectado</h4>
              <p data-k="wd3">Contacta al equipo comercial y consulta las novedades de Home Value.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="wrap cta">
    <div class="ctaBox">
      <div>
        <h2 data-k="ctaTitle">¿Listo para abastecer tu negocio?</h2>
        <p data-k="ctaText">Explora el catálogo y solicita acceso a los precios mayoristas de Home Value.</p>
      </div>
      <a href="https://homevalue-store.com/en/catalog" target="_blank" rel="noopener" data-k="ctaBtn">Visitar Home Value</a>
    </div>
  </div>
</div>
<script src="<?= e(asset('assets/js/homevalue-i18n.js')) ?>" defer></script>
<?php if ($hvGoogle !== ''): ?>
<script src="<?= e(asset('assets/js/fv-site-translate.js')) ?>" defer></script>
<?php endif; ?>

<?php
declare(strict_types=1);
if (!defined('FV_APP')) { http_response_code(403); exit; }

$img = static fn(string $file): string => asset('assets/img/products/finance/' . $file);

$langs = fv_landing_lang_attrs((string) $locale);
$financeLang = $langs['pack'];
$financeGoogle = $langs['google'];
?>
<div class="fv-finance" id="top" data-finance-lang="<?= e($financeLang) ?>"<?= $financeGoogle !== '' ? ' data-fv-google-lang="' . e($financeGoogle) . '"' : '' ?>>
  <section class="hero hero-art">
    <div class="container">
      <img class="hero-artwork" src="<?= e($img('hero.jpg')) ?>" alt="FullVendor Finanzas: controla tus finanzas siempre, gestiona clientes, saldos, facturas y pagos desde tu móvil." width="1600" height="900">
    </div>
  </section>

  <section id="features">
    <div class="container">
      <div class="sectionhead">
        <div class="kicker">FULLVENDOR FINANCE</div>
        <h2 data-t="features">Todo lo que necesitas para gestionar tus finanzas</h2>
        <p data-t="sub">Información clara y organizada para tomar mejores decisiones cada día.</p>
      </div>
      <div class="features">
        <article class="feature">
          <div class="ficon">♟</div>
          <h3 data-t="f1">Clientes</h3>
          <p data-t="d1">Gestiona la información y las cuentas de crédito de tus clientes.</p>
        </article>
        <article class="feature">
          <div class="ficon">▣</div>
          <h3 data-t="f2">Saldos</h3>
          <p data-t="d2">Consulta saldos pendientes y el estado de cuenta de cada cliente.</p>
        </article>
        <article class="feature">
          <div class="ficon">▤</div>
          <h3 data-t="f3">Facturas</h3>
          <p data-t="d3">Revisa tus facturas y conoce su estado en cualquier momento.</p>
        </article>
        <article class="feature">
          <div class="ficon">▱</div>
          <h3 data-t="f4">Pagos</h3>
          <p data-t="d4">Da seguimiento a los pagos recibidos y pendientes.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="screens" id="screens">
    <div class="container">
      <div class="sectionhead">
        <div class="kicker">EN CADA MOMENTO</div>
        <h2 data-t="screens">Una experiencia sencilla y profesional</h2>
        <p data-t="screensSub">Cada módulo está diseñado para que encuentres la información que necesitas en segundos.</p>
      </div>
      <div class="screenlist">
        <article class="screenitem">
          <div class="screenimg">
            <img src="<?= e($img('clientes.jpg')) ?>" alt="Customer list" loading="lazy" width="791" height="978">
          </div>
          <div class="screeninfo">
            <div class="num">01 / MODULE</div>
            <h3 data-t="shot1">Directorio de clientes</h3>
            <p data-t="d1">Gestiona la información y las cuentas de crédito de tus clientes.</p>
          </div>
        </article>
        <article class="screenitem">
          <div class="screenimg">
            <img src="<?= e($img('saldos.jpg')) ?>" alt="Customer balances" loading="lazy" width="796" height="975">
          </div>
          <div class="screeninfo">
            <div class="num">02 / MODULE</div>
            <h3 data-t="shot2">Saldos de clientes</h3>
            <p data-t="d2">Consulta saldos pendientes y el estado de cuenta de cada cliente.</p>
          </div>
        </article>
        <article class="screenitem">
          <div class="screenimg">
            <img src="<?= e($img('facturas.jpg')) ?>" alt="Invoices" loading="lazy" width="793" height="967">
          </div>
          <div class="screeninfo">
            <div class="num">03 / MODULE</div>
            <h3 data-t="shot3">Consulta de facturas</h3>
            <p data-t="d3">Revisa tus facturas y conoce su estado en cualquier momento.</p>
          </div>
        </article>
        <article class="screenitem">
          <div class="screenimg">
            <img src="<?= e($img('pagos.jpg')) ?>" alt="Payments" loading="lazy" width="790" height="969">
          </div>
          <div class="screeninfo">
            <div class="num">04 / MODULE</div>
            <h3 data-t="shot4">Seguimiento de pagos</h3>
            <p data-t="d4">Da seguimiento a los pagos recibidos y pendientes.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section id="benefits">
    <div class="container benefitsgrid">
      <div class="benefitvisual">
        <div class="visualtitle" data-t="benefitTitle">Tu operación financiera, más simple.</div>
        <div class="visualstats">
          <div class="stat"><b>24/7</b><span>Access</span></div>
          <div class="stat"><b>4</b><span>Modules</span></div>
          <div class="stat"><b>1</b><span>Platform</span></div>
        </div>
      </div>
      <div>
        <div class="kicker">WHY FULLVENDOR</div>
        <h2 data-t="benefitTitle">Tu operación financiera, más simple.</h2>
        <div class="benefitlist">
          <div class="benefit">
            <div class="check">✓</div>
            <div>
              <h3 data-t="b1">Acceso rápido</h3>
              <p data-t="bd1">Consulta la información esencial de tu empresa desde tu teléfono.</p>
            </div>
          </div>
          <div class="benefit">
            <div class="check">✓</div>
            <div>
              <h3 data-t="b2">Visibilidad de cuentas</h3>
              <p data-t="bd2">Identifica fácilmente clientes, saldos y documentos pendientes.</p>
            </div>
          </div>
          <div class="benefit">
            <div class="check">✓</div>
            <div>
              <h3 data-t="b3">Información organizada</h3>
              <p data-t="bd3">Navega por módulos claros con datos fáciles de consultar.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container cta">
    <div class="ctabox">
      <div>
        <h2 data-t="finalTitle">Lleva el control de tu negocio contigo.</h2>
        <p data-t="finalText">FullVendor Finance reúne la información financiera que necesitas, estés donde estés.</p>
      </div>
      <a href="<?= e(url_to($locale, 'contact')) ?>" data-t="cta">Descubre FullVendor Finance →</a>
    </div>
  </div>
</div>
<script src="<?= e(asset('assets/js/fullvendor-finance-i18n.js')) ?>" defer></script>
<?php if ($financeGoogle !== ''): ?>
<script src="<?= e(asset('assets/js/fv-site-translate.js')) ?>" defer></script>
<?php endif; ?>


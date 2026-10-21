<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

$channels = ta('mock.channels');
$statuses = ta('mock.status');
$salesMenu = ta('mock.sales_menu');
$warehouseMenu = ta('mock.warehouse_menu');
?>
<div class="stage" aria-hidden="true">
  <div class="devices">
    <div class="laptop">
      <div class="laptop-screen">
        <aside class="sb">
          <strong class="sb-logo"><span>Full</span>Vendor</strong>
          <?php foreach (FV_SIDEBAR as $index => $key): ?>
            <span class="sb-item<?= $index === 0 ? ' is-on' : '' ?>"><?= e(t('mock.sidebar.' . $key)) ?></span>
          <?php endforeach; ?>
        </aside>
        <div class="app-main">
          <div class="app-top"><span><?= e(t('mock.sidebar.dashboard')) ?></span><span class="mini-search"></span></div>
          <div class="kpis">
            <?php foreach (FV_KPIS as $kpi): ?>
              <article class="kpi">
                <span><?= e(t('mock.kpi.' . $kpi['key'])) ?></span>
                <strong><?= e($kpi['value']) ?></strong>
                <em><?= e($kpi['delta']) ?></em>
              </article>
            <?php endforeach; ?>
          </div>
          <div class="app-mid">
            <article class="panel">
              <h3><?= e(t('mock.chart')) ?></h3>
              <svg class="chart-svg" viewBox="0 0 220 78" preserveAspectRatio="none">
                <defs>
                  <linearGradient id="fvChartFill" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#e10613" stop-opacity=".45"/>
                    <stop offset="100%" stop-color="#e10613" stop-opacity="0"/>
                  </linearGradient>
                </defs>
                <path d="M0 58 L22 50 L44 54 L66 38 L88 42 L110 26 L132 30 L154 16 L176 20 L198 8 L220 12 V78 H0 Z" fill="url(#fvChartFill)"/>
                <path d="M0 58 L22 50 L44 54 L66 38 L88 42 L110 26 L132 30 L154 16 L176 20 L198 8 L220 12" fill="none" stroke="#e10613" stroke-width="2.4"/>
              </svg>
            </article>
            <article class="panel donut-panel">
              <h3><?= e(t('mock.channel')) ?></h3>
              <div class="donut-row">
                <div class="donut"><span></span></div>
                <ul>
                  <?php foreach (FV_CHANNELS as $index => $channel): ?>
                    <li><i style="background:<?= e($channel['color']) ?>"></i><?= e((string) ($channels[$index] ?? '')) ?> <b><?= e((string) $channel['pct']) ?>%</b></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </article>
          </div>
          <div class="app-bot">
            <article class="panel">
              <h3><?= e(t('mock.orders')) ?></h3>
              <div class="order-head">
                <span><?= e(t('mock.col_order')) ?></span>
                <span><?= e(t('mock.col_client')) ?></span>
                <span><?= e(t('mock.col_status')) ?></span>
                <span><?= e(t('mock.col_total')) ?></span>
              </div>
              <?php foreach (FV_ORDERS as $order): ?>
                <div class="order-row">
                  <span>#<?= e($order['id']) ?></span>
                  <span><?= e($order['client']) ?></span>
                  <span class="st st-<?= (int) $order['status'] ?>"><?= e((string) ($statuses[$order['status']] ?? '')) ?></span>
                  <span><?= e($order['total']) ?></span>
                </div>
              <?php endforeach; ?>
            </article>
            <article class="panel">
              <h3><?= e(t('mock.top')) ?></h3>
              <?php foreach (FV_TOP as $item): ?>
                <div class="top-row">
                  <span><?= e(t('mock.product')) ?> <?= e($item['sku']) ?></span>
                  <span class="bar"><i style="width:<?= (int) $item['width'] ?>%"></i></span>
                  <b><?= e($item['qty']) ?></b>
                </div>
              <?php endforeach; ?>
            </article>
          </div>
        </div>
      </div>
      <div class="laptop-base"></div>
    </div>
    <div class="ph ph-sales">
      <div class="ph-screen">
        <div class="ph-notch"></div>
        <header>FullVendor Sales Man</header>
        <ul>
          <?php foreach ($salesMenu as $item): ?>
            <?php if (is_string($item)): ?>
              <li><i></i><span><?= e($item) ?></span></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="ph ph-wh">
      <div class="ph-screen">
        <div class="ph-notch"></div>
        <header>FullVendor Warehouse</header>
        <ul>
          <?php foreach ($warehouseMenu as $item): ?>
            <?php if (is_string($item)): ?>
              <li><i></i><span><?= e($item) ?></span></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

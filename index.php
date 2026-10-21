<?php
declare(strict_types=1);

define('FV_APP', true);

require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/header.php';
require FV_ROOT . '/pages/' . $view;
require __DIR__ . '/includes/footer.php';

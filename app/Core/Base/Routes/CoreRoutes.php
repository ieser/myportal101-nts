<?php
$f3 = \Base::instance();
$f3->route('GET /assets/@module/@file', 'Core\Base\Controllers\AssetsController->serve');

$f3->route('GET /navbar',               'Core\Base\Controllers\NavController->getNavbar');
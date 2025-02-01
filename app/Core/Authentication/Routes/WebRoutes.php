<?php
$f3 = \Base::instance();

$f3->redirect('GET /', '/login');
//$f3->reroute('GET /@notfound', '/login');

$f3->route('GET /login',    'Core\Authentication\Controllers\WebController->showLogin');
$f3->route('GET /logout',   'Core\Authentication\Controllers\WebController->showLogout');
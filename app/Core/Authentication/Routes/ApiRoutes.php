<?php
$f3 = \Base::instance();

$f3->route('POST /api/auth/login',          'Core\Authentication\Controllers\ApiController->login');
$f3->route('POST /api/auth/token',          'Core\Authentication\Controllers\ApiController->loginWithToken');
$f3->route('GET  /api/auth/oauth-enabled',  'Core\Authentication\Controllers\ApiController->getOAuthsEnabled');
$f3->route('POST /api/auth/logout',         'Core\Authentication\Controllers\ApiController->logout');

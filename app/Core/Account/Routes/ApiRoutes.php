<?php
$f3 = \Base::instance();

$f3->route('GET    /api/account',                'Account\Controllers\ApiController->get');
$f3->route('POST   /api/account',                'Account\Controllers\ApiController->update');
$f3->route('POST   /api/password',               'Account\Controllers\ApiController->updatePassword');
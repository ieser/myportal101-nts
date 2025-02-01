<?php
$f3 = \Base::instance();

$f3->route('GET /api/users',               'Core\Users\Controllers\ApiController->list');
$f3->route('GET /api/user/@id',            'Core\Users\Controllers\ApiController->details');
$f3->route('POST /api/user/@id/assign',    'Core\Users\Controllers\ApiController->assign');
$f3->route('POST /api/user/@id/unassign',  'Core\Users\Controllers\ApiController->unassign');




<?php
$f3 = \Base::instance();

$f3->route('GET /users',        'Core\Users\Controllers\WebController->list');
$f3->route('GET /user/@id',     'Core\Users\Controllers\WebController->single');

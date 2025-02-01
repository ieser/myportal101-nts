<?php
$f3 = \Base::instance();

$f3->route('GET   /api/privileges',                'Privileges\Controllers\ApiController->all');
$f3->route('GET   /api/privileges/sections',        'Privileges\Controllers\ApiController->sections');
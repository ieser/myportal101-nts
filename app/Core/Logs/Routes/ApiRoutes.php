<?php
$f3 = \Base::instance();

$f3->route('GET   /api/logs', 'Logs\Controllers\ApiController->list');
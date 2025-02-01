<?php
$f3 = \Base::instance();

$f3->route('GET     /logs', 'Logs\Controllers\WebController->list');
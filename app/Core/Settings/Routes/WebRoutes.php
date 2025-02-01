<?php
$f3 = \Base::instance();

$f3->route('GET /settings',          'Core\Settings\Controllers\WebController->show');
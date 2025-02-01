<?php
$f3 = \Base::instance();
$f3->route('GET /dashboard',    'Core\Dashboard\Controllers\WebController->show');
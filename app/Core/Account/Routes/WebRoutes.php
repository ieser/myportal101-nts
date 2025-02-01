<?php
$f3 = \Base::instance();

$f3->route('GET     /account',             'Account\Controllers\WebController->show');
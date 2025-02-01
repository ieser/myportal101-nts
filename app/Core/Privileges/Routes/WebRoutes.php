<?php
$f3 = \Base::instance();

$f3->route('GET     /privileges',             'Privileges\Controllers\WebController->list');
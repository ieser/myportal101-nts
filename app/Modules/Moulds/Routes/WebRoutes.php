<?php
$f3 = \Base::instance();

$f3->route('GET     /moulds',           'Modules\Moulds\Controllers\WebController->list');
$f3->route('GET     /moulds/@mould',    'Modules\Moulds\Controllers\WebController->single');

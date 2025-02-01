<?php
$f3 = \Base::instance();

$f3->route('GET     /api/updates',          'Core\Settings\Controllers\ApiController->updates');
$f3->route('POST    /api/update',           'Core\Settings\Controllers\ApiController->update');



$f3->route('GET     /api/settings/identity',       'Core\Settings\Controllers\ApiController->getIdentity');
$f3->route('POST    /api/settings/identity',       'Core\Settings\Controllers\ApiController->updateIdentity');
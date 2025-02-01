<?php
$f3 = \Base::instance();
$f3->route('GET /api/appearance', 'Controllers\Backend\Appearance->get');
$f3->route('POST /api/appearance', 'Controllers\Backend\Appearance->update');
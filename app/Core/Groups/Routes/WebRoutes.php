<?php
$f3 = \Base::instance();
$f3->route('GET     /groups',                'Groups\Controllers\WebController->list');
$f3->route('GET     /groups/@id',            'Groups\Controllers\WebController->show');
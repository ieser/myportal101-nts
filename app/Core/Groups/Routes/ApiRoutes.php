<?php
$f3 = \Base::instance();
$f3->route('GET     /api/groups',                'Groups\Controllers\ApiController->all');
$f3->route('GET     /api/groups/@id',            'Groups\Controllers\ApiController->single');
$f3->route('POST    /api/groups',                'Groups\Controllers\ApiController->add');
$f3->route('POST    /api/groups/@id',            'Groups\Controllers\ApiController->edit');
$f3->route('DELETE  /api/groups/@id',            'Groups\Controllers\ApiController->delete');
$f3->route('POST    /api/groups/@id',            'Groups\Controllers\ApiController->assign');
$f3->route('POST    /api/groups/@id',            'Groups\Controllers\ApiController->unassign');


$f3->route('GET   /api/groups/@id/privileges', 'Groups\Controllers\ApiController->getPrivileges');
$f3->route('POST  /api/groups/@id/privileges', 'Groups\Controllers\ApiController->updatePrivileges');


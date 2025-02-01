<?php
$f3 = \Base::instance();

$f3->route('GET     /api/moulds',           'Modules\Moulds\Controllers\ApiController->list');
$f3->route('GET     /api/moulds/@mould',    'Modules\Moulds\Controllers\ApiController->single');



$f3->route('GET     /api/moulds/@mould/warranties',                'Modules\Moulds\Controllers\WarrantiesApiController->list');
$f3->route('POST    /api/moulds/@mould/warranties',                'Modules\Moulds\Controllers\WarrantiesApiController->add');
$f3->route('GET     /api/moulds/@mould/warranties/@warranty',      'Modules\Moulds\Controllers\WarrantiesApiController->single');
$f3->route('POST    /api/moulds/@mould/warranties/@warranty',      'Modules\Moulds\Controllers\WarrantiesApiController->update');
$f3->route('DELETE  /api/moulds/@mould/warranties/@warranty',      'Modules\Moulds\Controllers\WarrantiesApiController->delete');

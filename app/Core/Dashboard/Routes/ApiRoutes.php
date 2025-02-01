<?php
$f3 = \Base::instance();


$f3->route('POST /api/notes',   'Core\Dashboard\Controllers\ApiController->updateNotes');
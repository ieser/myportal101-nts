<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
date_default_timezone_set("Europe/Rome");

require_once('../vendor/autoload.php');

$bootstrap = new \Core\Base\Bootstrap();
$bootstrap->run();

<?php
namespace Core\Base\Controllers;
use \Helpers\Database as DB;

class NavShortcuts {

    public function __construct() {

    }

    public static function getShortcuts(){
        $sections = DB::sql()->select("SELECT * FROM navshortcuts ORDER BY name", array()); 
        return $sections;
    }
    
    public static function getNavbar(){
        $sections = DB::sql()->select("SELECT * FROM navshortcuts ORDER BY name", array()); 
        return $sections;
    }
    
}

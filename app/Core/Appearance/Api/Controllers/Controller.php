<?php
namespace Controllers\Backend;
use \Helpers\General as hp;
class Appearance {
    
    function __construct() {
        \Models\Authentication::checkAuthentication();
    }
    
    public function get() {
        $appearance = \Helpers\Appearance::instance()->load();
        echo json_encode($appearance->toArray());
    }
    
    public function update() {
        $theme = hp::post("theme");
        \Helpers\AppearanceHelper::updateTheme($theme);
    }
    

}

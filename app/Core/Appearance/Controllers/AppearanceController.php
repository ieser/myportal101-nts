<?php
namespace Modules\Appearance\Frontend\Controller;
use \Helpers\Generic as Helper;
class AppearanceController {
    
    function __construct() {
        \Models\Authentication::checkAuthentication();
        \Models\Language::setup();
    }
    
    public function show() {
        $page = new Page();
        $page->setMetaTitle(Helper::fetch("tr_appearance"));
        $page->addContent("appearance");
        $page->addJavascript("appearance");
        $page->display();
        
    }   
}
<?php

namespace Controllers\Frontend;
use \Models\Utils as ut;
class Account {

    function __construct() {
        \Models\Authentication::checkAuthentication();
        \Models\Language::setup();
    }
    
    public function show() {
        
        $page = new Page();
        $page->setMetaTitle(ut::fetch("tr_account"));
        $page->addContent("account");
        $page->display();


    }

}

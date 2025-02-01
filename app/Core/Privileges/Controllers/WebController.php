<?php
namespace Controllers\Frontend;
use \Models\Utils as ut;
class Privileges {

    function __construct() {
        \Models\Language::setup();
    }
    public function list() {
        $account = \Models\Account::instance();
        if(!$account->isGranted("privileges","update")){ 
            \Base::instance()->error('403');
        }
        ut::set("privileges", \Models\Privilege::all());
        ut::set("groups", \Models\Group::all());
        
        $page = new Page();
        $page->setTitle(ut::fetch("tr_privileges"));
        $page->setMetaTitle(ut::fetch("tr_privileges"));

        $page->activateBreadcrumbs()->setBreadcrumbs([ut::fetch("tr_privileges") => "/privileges"]);

        $page->addContent("privileges/page-list");
        $page->addJavascript("privileges");
        $page->display();
    } 
}

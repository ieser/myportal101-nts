<?php
namespace Controllers\Frontend;
use \Models\Utils as ut;
use \Controllers\Frontend\Page as Page;
class Logs {

    function __construct() {
        \Models\Authentication::checkAuthentication();
        \Models\Language::setup();
    }

    public function list() {
        ut::set("languages", \Models\Language::all());
        

        $page = new Page();
        $page->setMetaTitle(ut::fetch("tr_logs"));

        $page->setTitle(ut::fetch("tr_logsTitle"));
        $page->activateBreadcrumbs()->setBreadcrumbs([ut::fetch("tr_logs") => "/logs"]);

        $page->addContent("logs/page-list");
        $page->addJavascript("logs");
        $page->display();

    }


}

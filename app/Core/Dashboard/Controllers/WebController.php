<?php
namespace Core\Dashboard\Controllers;
class WebController extends \Core\Base\Controllers\WebpageController{

    public function __construct(){
        parent::__construct('Core/Dashboard');
    }
    
    public function show() {
        \PrivilegesHelpers::isGranted("dashboard", "read");
        
        
        $this->setTitle(\LanguagesHelpers::get("dashboard"));
        $this->setMetaTitle(\LanguagesHelpers::get("dashboard"));
        $this->setBreadcrumbs([\LanguagesHelpers::get("moulds") => "/moulds"]);

        $this->addContent("dashboard.php");
        $this->addJavascript("dashboard/dashboard.js");
        $this->send();
        
        
    }

}

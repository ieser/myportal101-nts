<?php
namespace Core\Settings\Controllers;
class WebController extends \Core\Base\Controllers\WebpageController{
    

    public function __construct(){
        parent::__construct('Core/Settings');
    }
    
    
    public function show() {
        \PrivilegesHelpers::isGranted("settings", "read");
        
        $this->setTitle(\LanguagesHelpers::get("settings"));
        $this->setMetaTitle(\LanguagesHelpers::get("settings"));
        $this->setBreadcrumbs([\LanguagesHelpers::get("settings") => "/settings"]);

        $this->addContent("settings.php");
        $this->addJavascript("settings/identity.js");
        $this->addJavascript("settings/updates.js");
        $this->send();
    }
        
}
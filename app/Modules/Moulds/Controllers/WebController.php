<?php
namespace Modules\Moulds\Controllers;
class WebController extends \Core\Base\Controllers\WebpageController{

    public function __construct(){
        parent::__construct("Modules/Moulds");
    }


    public function list() {
        \PrivilegesHelpers::isGranted("moulds", "read");
        
        $this->setTitle(\LanguagesHelpers::get("moulds-list"));
        $this->setMetatitle(\LanguagesHelpers::get("moulds-list"));
        $this->addContent('page-list.php');
        $this->addJavascript('moulds/moulds-list.js');
        $this->send();
        
    }

    public function single() {
        \PrivilegesHelpers::isGranted("moulds", "read");
        
        $this->setTitle(\LanguagesHelpers::get("moulds-details"));
        $this->setMetaTitle(\LanguagesHelpers::get("moulds"));
        $this->setBreadcrumbs([\LanguagesHelpers::get("moulds") => "/moulds"]);

        $this->addContent("page-single.php");
        $this->addContent("modal-add-warranty.php");
        $this->addJavascript("moulds/moulds-single.js");
        $this->send();
    }

}
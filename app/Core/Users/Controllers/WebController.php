<?php
namespace Core\Users\Controllers;
class WebController extends \Core\Base\Controllers\WebpageController{
    

    public function __construct(){
        parent::__construct('Core/Users');
    }
    
    
    public function list() {
        \PrivilegesHelpers::isGranted("users", "read");
        
        $this->setTitle(\LanguagesHelpers::get("users"));
        $this->setMetaTitle(\LanguagesHelpers::get("users"));
        $this->setBreadcrumbs([\LanguagesHelpers::get("users") => "/users"]);

        $this->addContent("page-list-users.php");
        $this->addJavascript("users/users-list.js");
        $this->send();
    }
        
}
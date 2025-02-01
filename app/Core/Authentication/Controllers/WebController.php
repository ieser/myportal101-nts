<?php
namespace Core\Authentication\Controllers;
class WebController extends \Core\Base\Controllers\WebpageController{

    public function __construct(){
        parent::__construct('Core/Authentication');
        
        
    }
    
    
    
    public function showLogin() {
        \CSRFHelpers::set();
        
        $this->addContent('login.php');
        $this->setMetatitle(\LanguagesHelpers::get("loginMetaTitle"));
        $this->setMetadescription(\LanguagesHelpers::get("loginMetaDescription"));
        $this->setMetakeywords(\LanguagesHelpers::get("loginMetaKeywords"));
        $this->addJavascript('authentication/login.js');
        $this->addStylesheet('authentication/login.css');
        $this->send();
    }

    
    public function showLogout() {
        
        $this->addContent('logout.php');
        $this->setMetatitle(\LanguagesHelpers::get("logoutMetaTitle"));
        $this->setMetadescription(\LanguagesHelpers::get("logoutMetaDescription"));
        $this->setMetakeywords(\LanguagesHelpers::get("logoutMetaKeywords"));
        $this->addJavascript('authentication/logout.js');
        $this->addStylesheet('authentication/logout.css');
        $this->send();
        
        
    }

}
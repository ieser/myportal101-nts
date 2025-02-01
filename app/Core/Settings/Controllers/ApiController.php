<?php
namespace Core\Settings\Controllers;
use Core\Settings\Models\UpdatesModel as UpdatesModel;
use Core\Settings\Models\IdentityModel as IdentityModel;

class ApiController extends \Core\Base\Controllers\ApiController{

    function __construct() {
    }
    
    public function updates() {
        \PrivilegesHelpers::isGranted("updates", "read");
        
        $current = UpdatesModel::current();
        $latest = UpdatesModel::latest();
        $this->response(200, [ "current" => $current, "latest" => $latest] );
    }
    
    public function update() {
        \PrivilegesHelpers::isGranted("updates", "write");
        
        $current = UpdatesModel::current();
        $latest = UpdatesModel::latest();
        $this->response(200, [ "current" => $current, "latest" => $latest] );
    }
    
    public function getIdentity() {
        \PrivilegesHelpers::isGranted("identity", "read");
        
        $identity = IdentityModel::get();
        $this->response(200, ["identity" => $identity]);
    }
    public function updateIdentity() {
        \PrivilegesHelpers::isGranted("identity", "update");
        
        IdentityModel::updateLogo();
        
        $title = \Helpers::post("identity-title");
        IdentityModel::updateTitle($title);
        
        $identity = IdentityModel::get();
        $this->response(200, ["identity" => $identity]);
    }
}
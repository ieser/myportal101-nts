<?php
namespace Core\Users\Controllers;
use Core\Users\Models\UsersModel as UsersModel;

class ApiController extends \Core\Base\Controllers\ApiController{

    function __construct() {
    }
    public function list() {
        \PrivilegesHelpers::isGranted("users", "read");
        $users = UsersModel::all();
        $this->response(200, [ "users" => $users ] );
    }
    
    
    /*
    public function show() {
        PrivilegesHelpersAccess::isGranted("users", "read");
        
        $id = \Helpers::param("id");
        $user = new \Models\User();
        $user->load($id);
        $user->setGroups();
        \Helpers::set("user", $user);

        $logs = \Models\Log::all(["idUser" => $id]);
        \Helpers::set("logs", $logs);


        \Helpers::set("groups", \Models\Group::all());

        $page = new Page();
        $this->setMetaTitle(\Helpers::fetch("tr_userEdit"));
        $this->setTitle(\Helpers::fetch("tr_userEdit"));
        $this->activateBreadcrumbs()->setBreadcrumbs([Helpers::fetch("tr_users") => "/users", $user->fullname => "#"]);
        $this->addContent("users/page-details");
        $this->addContent("users/modal-add-to-group");
        $this->display();
    }


    public function assign() {
        \Helpers::isGranted("users", "update");
        $idUser = \Helpers::post("idUser");
        $user = \Models\User::instance()->load($idUser);

        $idGroup = \Helpers::post("idGroup");
        $group = \Models\Group::instance()->load($idGroup);

        $user->assign($group);

        $page = new Page();
        $ajax = new Ajax();

        $block = $this->render("users/row-group", array("group" => $group,"user" => $user) );
        $ajax->addHTML($block, "table#groups-list tbody");
        $ajax->setSuccess();
        $ajax->send();

    }
    
    public function unassign() {
        \Helpers::isGranted("users", "update");
        $idUser = \Helpers::post("idUser");
        $user = \Models\User::instance()->load($idUser);

        $idGroup = \Helpers::post("idGroup");
        $group = \Models\Group::instance()->load($idGroup);
        
        $user->unassign($group);

        $page = new Page();
        $ajax = new Ajax();

        $ajax->setSuccess();
        $ajax->send();

    }*/
}
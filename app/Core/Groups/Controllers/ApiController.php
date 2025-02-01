<?php
namespace Groups\Controllers;
use Groups\Models\GroupModel as GroupModel;
class ApiController extends \Core\Base\Controllers\ApiController {


    function __construct() {
    }
    public function all() {
        Acceess::isGranted("groups","read");
        $groups = \Models\Group::all();
        echo json_encode(["status" => "ok", "groups" => $groups]);    
    }
    public function getPrivileges(){
        \Helpers::isGranted("groups","read");
        $id = \Helpers::param("id");
        $group = \Models\Group::instance()->load($id);
        echo json_encode($group->privileges);  
    }
    
    public function updatePrivileges() {
        \Helpers::isGranted("privileges","update");

        $id = \Helpers::param("id");
        $group = \Models\Group::instance()->load($id);

        $idPrivilege = \Helpers::post("privilege");
        $status = \Helpers::post("status") == "true" ? "1" : "0";
        $group->updatePrivilege($idPrivilege,$status);
        echo json_encode(["ok" => true]);   
    }

    

    public function add(){
        $ajax = new Ajax();
        $name = \Helpers::post("name");
        $group = new \Models\Group();
        $group->setName($name);
        $group->insert();

        $page = new Page();
        $block = $page->render("groups/row-list", array("group" => $group) );
        $ajax->addHTML($block, "#groups-list");

        $ajax->setSuccess(\Helpers::fetch("tr_groupInsered"));
        $ajax->send();
    }

    public function delete() {
        $id = \Helpers::post("id");
        $group = new \Models\Group();
        $group->load($id);
        $group->delete();
        $ajax = new Ajax();
        $ajax->setSuccess(\Helpers::fetch("tr_groupDeleted"));
        $ajax->send();

    }

    public function details() {
        $id = \Helpers::post("id");
        $group = \Models\Group::instance()->load($id);
        $ajax = new Ajax();
        $ajax->addData("group",$group);
        $ajax->setSuccess();
        $ajax->send();

    }

    public function assign() {
        $id = \Helpers::post("id");
        $idUsers = \Helpers::post("users");
        $group = \Models\Group::instance()->load($id);
        
        $page = new Page();
        $ajax = new Ajax();

        foreach($idUsers as $idUser){
            $user = \Models\User::instance()->load($idUser);
            $user->assign($group);
            $block = $page->render("groups/row-user", array("user" => $user) );
            $ajax->addHTML($block, "table#users-list tbody");
        }
        $ajax->setSuccess();
        $ajax->send();

    }
    
    public function unassign() {
        $id = \Helpers::post("id");
        $idUsers = \Helpers::post("users");
        $group = \Models\Group::instance()->load($id);
        
        $page = new Page();
        $ajax = new Ajax();

        foreach($idUsers as $idUser){
            $user = \Models\User::instance()->load($idUser);
            $user->unassign($group);
        }
        $ajax->setSuccess();
        $ajax->send();

    }
    
    

    public function edit() {
        $id = \Helpers::post("id");
        $name = \Helpers::post("name");

        $group = new \Models\Group();
        $group->load($id);
        $group->setName($name);
        $group->save();

        $ajax = new Ajax();
        $ajax->setSuccess();
        $page = new Page();
        $block = $page->render("groups/row-list", array("group" => $group) );
        $ajax->addHTML($block, "#groups-list");
        $ajax->send();
    }

}
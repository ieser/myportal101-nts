<?php
namespace Groups\Controllers;
class WebController extends \Core\Base\Controllers\WebpageController{

    public function __construct(){
        parent::__construct();
        \LanguagesHelpers::addDictionary('Core/Groups/Dict');
        $this->setViewsPath('Core/Groups/Views');
        $this->setLayout('ReservedLayout');

    }
    
    public function list() {
        \PrivilegesHelpers::isGranted("groups", "read");

        $this->setTitle(\LanguagesHelpers::get("groups"));
        $this->setMetaTitle(\LanguagesHelpers::get("groups"));
        $this->setBreadcrumbs([\LanguagesHelpers::get("groups") => "/groups"]);
        $this->addContent("page-list");
        $this->addContent("modal-edit");
        $this->addContent("modal-add");
        $this->addJavascript("groups/list.js");
        $this->display();
    }
    
    public function show() {
        $id = \Helpers::param("id");
        $group = \Models\Group::instance()->load($id);
        if(!$group){
            \Helpers::reroute("/groups");
        }
        $group->setUsers();
        \Helpers::set("group", $group);
        
        $allUsers = \Models\User::all();
        foreach($group->users as &$user){
            foreach($allUsers as $key => &$allUser){
                if($user->id ==  $allUser->id){
                    unset($allUsers[$key]);
                }
            }
        }
        \Helpers::set("usersCanBeLinked", $allUsers);

        $page = new Page();
        $page->setTitle(\Helpers::fetch("tr_groupsDetailsTitle"));
        $page->activateBreadcrumbs()->setBreadcrumbs([\LanguagesHelpers::get("groups") => "/groups",$group->name => "/group/show/".$group->id ]);
        $page->addContent("groups/page-details");
        $page->addContent("groups/modal-link-user");
        $page->display();
    }   
}
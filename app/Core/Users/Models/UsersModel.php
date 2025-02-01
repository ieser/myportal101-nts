<?php
namespace Core\Users\Models;
use \Core\Base\Database as DB;

class UsersModel {

    public $id;
    public $username, $password;
    public $name,$lastname,$fullname ;
    public $email,$image, $role;
    public $language, $theme;
    public $active,$dateinsert;
    public $lastlogin,$lastloginago;
    public $groups = [];

    public function __construct() {
    }
    public static function instance() {
        return new self();
    } 

    public function load($id) {
        $proprieties = DB::sql()->select("SELECT id, name, lastname, email, image, role, dateinsert, lastlogin, theme, language, active FROM users WHERE id=?", [$id] );
        if(count($proprieties)==1){
            $this->setProprieties($proprieties[0]);
        }
        return $this;
    }
    public static function all() {
        $selected = DB::sql()->select("SELECT * FROM users WHERE 1=1 ;");
        foreach($selected as &$single){
            $user = new self();
            $user->setProprieties($single);
            $users[] = $user;
        }
        return $users;
    }

    public function setProprieties($proprieties){
        foreach($proprieties as $key => $propriety){
            $this->$key = $propriety;
        }
        $this->fullname = $this->name." ".$this->lastname;
        $this->lastloginago = \DateHelpers::when($proprieties["lastlogin"]);
        $this->image = empty($proprieties["image"]) ? "default.webp" : $proprieties["image"];
        return $this;
    }

    public function setGroups(){
        $groups = DB::sql()->select("SELECT group_id AS id FROM user_groups WHERE user_id=?", array($this->id) );
        foreach($groups as $group){
            $this->groups[] = \Models\Group::instance()->load( $group["id"]);
        }
        return $this;
    }

    public function updateTheme($theme) {
        $this->theme = $theme;
        $details = DB::sql()->select("UPDATE users SET theme=? WHERE id=?", array($theme, $this->id) );
    }

    public function assign($group) {
        DB::sql()->insert("INSERT INTO user_groups (group_id,user_id) VALUES (?,?)", array($group->id, $this->id));
        return true;
    }
    public function unassign($group) {
        DB::sql()->delete("DELETE FROM user_groups WHERE group_id=? AND user_id=?", array($group->id, $this->id));
        return true;
    }
}

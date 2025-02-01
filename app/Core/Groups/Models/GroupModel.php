<?php
namespace Models;
class Group {
    public $id, $name;
    public $privileges = [];
    public $users = [];

    public function __construct() {
    }
    public static function instance() {
        return new self();
    } 

    public static function setup() {
        ut::session("group", "admin");
    } 

    public function setProprietes($proprieties){
        foreach($proprieties as $key => $propriety){
            $this->$key = $propriety;
        }
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setUsers(){
        $users = DB::sql()->select("SELECT idUser AS id FROM user_groups WHERE idGroup=?", array($this->id) );
        foreach($users as $user){
            $this->users[] = \Models\User::instance()->load( $user["id"]);
        }
        return $this;
    }

    public function load($id){
        $res = DB::sql()->select("SELECT * FROM groups WHERE id=? ;",[$id]);
        $privileges = DB::sql()->select("SELECT idPrivilege, section, operation, status FROM groups_privileges LEFT JOIN privileges on idPrivilege = privileges.id WHERE idGroup=?;", [$id] );
        if(isset($res[0])){
            $this->setProprietes($res[0]);
            $this->privileges = $privileges;
            return $this;
        }else{
            return false;
        }
    }
    public function save(){
        DB::sql()->update("UPDATE groups SET name=? WHERE id=? ;",[$this->name,$this->id]);
        return true;
    }

    public function insert(){
        $id = DB::sql()->insert("INSERT INTO groups (name) VALUES (?) ;",[$this->name]);
        $this->id = $id;
    }

    public function delete(){
        DB::sql()->delete("DELETE FROM groups WHERE id=?;",[$this->id]);
        DB::sql()->delete("DELETE FROM user_groups WHERE idGroup=?;",[$this->id]);
    }

    public static function all() {
        $groups = [];
        $all = DB::sql()->select("SELECT * FROM groups ;");
        foreach($all as $proprieties){
            $group = new Group();
            $group->setProprietes($proprieties);
            $groups[] = $group;
        }

        return $groups;
    }

    
    
    public function createTable(){
        Database::sql()->create("CREATE TABLE user_groups (
            user_id INT NOT NULL,
            group_id INT NOT NULL,
            PRIMARY KEY (user_id, group_id),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE
        );");
    }
}

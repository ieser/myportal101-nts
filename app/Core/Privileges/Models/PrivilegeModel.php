<?php
namespace Models;
class Privilege {
    public $id;
    public $section, $privilege;

    public function __construct() {
    }
    public static function instance() {
        return new self();
    } 

    public static function all() {
        $trsections =  ["groups" => "Gruppi", "credentials" => "Credenziali", "bulletin" => "Annunci", "log" => "Log", "privileges" => "Privilegi", "users" => "Utenti"];
        $trprivileges = ["read"=> "Visualizzare", "update" => "Modificare","create" => "Aggiungere","delete" => "Elminare"];

        $privileges = [];
        $select = DB::sql()->select("SELECT * FROM privileges ORDER BY section, operation;");
        foreach($select as $sel){
            $privileges[$sel["section"]]["slug"] = $sel["section"];
            $privileges[$sel["section"]]["name"] = $trsections[$sel["section"]];
            $privileges[$sel["section"]]["privileges"][] = ["id"=> $sel["id"], "slug" => $sel["operation"], "name" => $trprivileges[$sel["operation"]]];
        }
        return $privileges;
    }

    
    public static function allSections() {
        $sections = DB::sql()->select("SELECT DISTINCT section FROM privileges ORDER BY section;");
        return array_column($sections,"section");
    }
    
    public function load($id){
        $select = DB::sql()->select("SELECT * FROM privileges WHERE id=?;",[$id]);
        if(isset($select[0])){
            $this->id =  $select[0]["id"];
            $this->section =  $select[0]["section"];
            $this->privilege = $select[0]["privilege"];
        }
        return $this;
    }

    
    
    public function update($privilege,$status){
        DB::sql()->insert("INSERT INTO groups_privileges (idPrivilege,idGroup,status) VALUES (?,?,?) ON DUPLICATE KEY UPDATE status=?;",[$privilege,$this->id,$status,$status]);
    }

    
    
    public function granted($section,$privilege){
        $select = DB::sql()->select("SELECT status FROM privileges LEFT JOIN groups_privileges ON privileges.id = groups_privileges.idPrivilege WHERE section=? AND operation=? AND idGroup=?;",[$section,$privilege,$this->id]);
        $granted = !(!isset($select[0]) OR $select[0]["status"]==0);
        return $granted;
    }
}

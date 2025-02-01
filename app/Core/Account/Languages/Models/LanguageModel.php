<?php
namespace Models;
use \Helpers\Database as DB;
class Language {
    private $db;
    public readonly string $acronym;
    public string $name;
    public $active;
    
    public function __construct($acronym){
        $this->acronym = $acronym;
        $this->load();
    }

    public static function all($filters = false) {
        $conditions = "";
        $params = [];
        if($filters){
            if(isset($filters["active"]) AND $filters["active"]){
                $conditions .= " AND active=1 ";
            } 
        }
        $langs = DB::sql()->select("SELECT * FROM languages WHERE 1=1 $conditions ORDER BY acronym;", $params);
        return $langs;
    }
    public function insert() {
        DB::sql()->insert("INSERT INTO languages (acronym) VALUES (?)", array($this->acronym));
    }
    public function exists() {
        $check = DB::sql()->select("SELECT * FROM languages WHERE acronym=?", array($this->acronym));
        $exists = count($check) == 1;
        return $exists;
    }
    
    public function load() {
        $details = DB::sql()->select("SELECT name FROM languages WHERE acronym=?", array($this->acronym));
        if(is_array($details)){
            $details = $details[0];
            foreach($details as $key => $detail){
                $this->$key = $detail;
            }
        }
        return $details;
    }
    public function setName($name) {
        $this->name = $name;
        DB::sql()->update("UPDATE languages SET name=? WHERE acronym=?;", array($name,$this->acronym));
    }

    public function activate() {
        $this->setStatus(1);
    }
    public function deactivate() {
        $this->setStatus(0);
    }
    public function setStatus($active) {
        $this->active = $active;
        DB::sql()->update("UPDATE languages SET active=? WHERE acronym=?;", array($this->active,$this->acronym));
    }
}

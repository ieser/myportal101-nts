<?php
namespace Models;
use \Helpers\Generic as Helper;
use \Helpers\Database as DB;
class Notes {

    public function __construct() {
    }

    public function getToDoList() {
        $name = "todolist";
        $result = self::getPropriety($name);
        return $result;
    }


    public function getNotes() {
        $name = "notes";
        $result = self::getPropriety($name);
        return $result;
    }
    public static function updateNotes($notes) {
        $name = "notes";
        $result = self::setPropriety($name, $notes);
        return true;
    }




    public static function getPropriety($name) {
        $note = DB::sql()->select("SELECT value FROM dashboard WHERE name=?", array($name));
        $result = $note[0]["value"] ?? false; 
        return $result;
    }
    public static function setPropriety($name, $value) {
        $note = DB::sql()->update("UPDATE dashboard SET value=? WHERE name=?", array($value, $name));
        return true;
    }

}
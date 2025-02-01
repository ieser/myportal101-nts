<?php
namespace Controllers\Backend;
use Models\Utils as ut;
class Dashboard {

    function __construct() {
    }


    
    public function updateNotes(){
        $notes = ut::post("notes");
        \Models\Notes::updateNotes($notes);
        echo json_encode(["status" => "ok"]); 

    }
}
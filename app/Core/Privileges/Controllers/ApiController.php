<?php
namespace Controllers\Backend;
use Models\Utils as ut;
class Privileges {

    function __construct() {
    }

    
    public function getAll() {
        $privileges = \Models\Privilege::all();
        echo json_encode($privileges);    
    }
     
    public function getSections() {
        $sections = \Models\Privilege::allSections();
        echo json_encode($sections);    
    }
}

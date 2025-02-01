<?php
namespace Account\Controllers;
use Account\Models\AccountModel as AccountModel;
class ApiController extends \Core\Base\Controllers\ApiController{

    function __construct() {
    }
    public function get() {
        
        $account = AccountModel::instance()->toArray();
        echo json_encode(["status" => "ok", "account" => $account]);    
    }


    public function edit() { 
        $account = \Models\Account::instance();

        if (!empty($name)){
            $account->updateName($name);
        }
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $account->updateEmail($email);
        }
        if (!empty($lagnuage)){
            $account->updateLanguage($lagnuage);
        }
        echo json_encode(["status" => "ok"]);
    }
}
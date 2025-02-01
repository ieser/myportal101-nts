<?php
namespace Core\Authentication\Controllers;
use Core\Authentication\Models\AuthenticationModel as AuthenticationModel;
use Core\Account\Models\AccountModel as AccountModel;
class ApiController extends \Core\Base\Controllers\ApiController {

    public function __construct(){
        
    }

    public function login() {    
        
        $email = \Helpers::post("email");
        $password = \Helpers::post("password");
       
        if(!\CSRFHelpers::check() AND false){
            $this->response(400, "css-detected");
        }
        
        if(empty($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->response(400, "invalid-email");
        }
        
        $logged = AuthenticationModel::login($email,$password);
        if(!$logged) {
            $this->response(400, "login-incorrect");
        }

        \LogsHelpers::insert("login");
        $routeRequested = \Helpers::session("routeRequestedBeforeLogin") ?? "/dashboard";
        $authToken = AuthenticationModel::createAuthToken();
        $account = AccountModel::instance()->toArray();
        $this->response(200, [
                "reroute" => $routeRequested,
                "authToken" => $authToken,
                "account" => $account
        ]);
    }

    
    public function loginWithToken() {
        \Helpers::session("authenticated", false);
        
        $token = \Helpers::post("token");
        $logged = AuthenticationModel::loginAuthToken($token);
        if(!$logged) {
            $this->response(400, "login-incorrect");
        }
        \LogsHelpers::insert("login-with-token");
        $routeRequested = \Helpers::session("routeRequestedBeforeLogin") ?? "/dashboard";
        $account = AccountModel::instance()->toArray();
        $this->response(200, [
                "reroute" => $routeRequested,
                "account" => $account
        ]);
    }

    public function logout() {
        \Helpers::clear('SESSION');
        return true;
    }


    public function getOAuthsEnabled() {
        $oauths = AuthenticationModel::getOAuthsStaus();
        $account = AccountModel::instance()->toArray();
        $this->response(200, [ "oauths" => $oauths ] );
    }
}
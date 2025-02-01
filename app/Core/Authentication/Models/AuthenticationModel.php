<?php
namespace Core\Authentication\Models;
use \Core\Base\Database as Database;
class AuthenticationModel {
    public function __construct() {
    }

    public static function isRegistered($email) {
        $result = false;
        $users = Database::sql()->select("SELECT id FROM users WHERE email=? AND active=1", array($email));
        return isset($users[0]["id"]);
    }

    public static function isAuthenticated() {
        return \Helpers::session("authenticated");
    }


    public static function login($email, $password) {

        \Helpers::session("authenticated", false);
        $user = Database::sql()->select("SELECT users.id FROM users WHERE email=? AND password=? AND active=1 ", array($email, $password));
        if (sizeof($user) == 1) {
            self::setSession($user[0]);
            return true;
        }
        return false;
    }
    public static function loginAuthToken($authToken){
        \Helpers::session("authenticated", false);
        $user = Database::sql()->select("SELECT users.id FROM users LEFT JOIN  auth_tokens ON users.id=auth_tokens.user_id WHERE token=? AND expires_at > NOW()",[$authToken]);
        if (sizeof($user) == 1) {
            self::setSession($user[0]);
            return true;
        }
        return false;
    }


    public static function createAuthToken() {
        $idUser = \Helpers::session("id");
        $authToken = bin2hex(random_bytes(32)); 
        $expiresAt = (new \DateTime('+30 days'))->format('Y-m-d H:i:s');

        Database::sql()->insert("INSERT INTO auth_tokens (user_id, token, expires_at) VALUES (?, ?, ?)", 
            [$idUser, $authToken, $expiresAt]);

        \Helpers::session("authToken", $authToken);
        return $authToken;
    }

    

    public static function getOAuthsStaus() {
        $oauths = self::getOAuthsConfig() ?? [];
        $result = [];
        foreach($oauths as $key => $oauth){
                $result[] = [$key => $oauth["enabled"]];
        }
        return $result;
    }

    public static function getOAuthsConfig() {
        $oauths = false;
        $oauthsFile = APP_PATH . '/Config/oauth.php';
        if(file_exists($oauthsFile)){
            $oauths = include($oauthsFile);
        }
        return $oauths;
    }

    public static function setSession($user){
        \Helpers::session("authenticated", true);
        \Helpers::session("id",  $user["id"]);
        
        $groups = Database::sql()->select("SELECT group_id FROM user_groups WHERE user_id=?", array( $user["id"]));
        \Helpers::session("groups", array_values($groups));

        $lastlogin = date("Y-m-d H:i:s");
        Database::sql()->select("UPDATE users SET lastlogin=? WHERE id=?", [$lastlogin, $user["id"]]);
    }


    public static function createTokenTableIfNotExists(){
        Database::sql()->create("CREATE TABLE IF NOT EXISTS auth_tokens (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            token VARCHAR(64) NOT NULL UNIQUE,
            expires_at DATETIME NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );");
    }

    
}
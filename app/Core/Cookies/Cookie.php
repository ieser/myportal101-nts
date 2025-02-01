<?php
namespace Models;
class Cookie {
    private $db;
    
    public function __construct() {
    }

    
    public static function savePreferences($ip,$agent,$functionality,$marketing,$statistics) {

        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            DB::sql()->insert("INSERT INTO cookies (ip,agent,functionality,marketing,statistics) VALUES (?,?,?,?,?) 
                ON DUPLICATE KEY UPDATE agent=?,functionality=?,marketing=?,statistics=? ",
                    [$ip,$agent,$functionality,$marketing,$statistics,$agent,$functionality,$marketing,$statistics]);
        }
        return true;

    }
}

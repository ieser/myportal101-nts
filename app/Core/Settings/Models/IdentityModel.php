<?php
namespace Core\Settings\Models;
use \Core\Base\Database as DB;

class IdentityModel {

    public function __construct() {
    }

    public static function get() {
        $identity = DB::sql()->select("SELECT title, logo FROM identity WHERE id=1");
        if(!isset($identity[0])){
             DB::sql()->insert("INSERT INTO identity (id,title,logo,updated) VALUES (1, '', '', '0000-00-00');");
        }
        return $identity[0] ?? ["title" => "", "logo"=>""];
    }
    
    
    public static function updateTitle($title, $logo) {
        $date = date("Y-m-d");
        DB::sql()->insert("INSERT INTO identity (id,title,updated) VALUES (1, ?, ?, ?)
           ON DUPLICATE KEY UPDATE title=?, updated=?;", [$title, $date, $title, $date]);
        return true;
    }
    
    
    
    public static function updateLogo() {
        \Helpers::set('UPLOADS','uploads/');
        $overwrite = true;
        $files = \Web::instance()->receive(function($file, $formFieldName) {

            $extension = substr($file["name"], strripos($file["name"], ".") + 1);
            if (!in_array(strtolower($extension), array("jpg", "jpeg", "png", "webp", "svg"))) {
                return false;
            }elseif($file['size'] > (10 * 1024 * 1024)){
                return false;
            }     
            return true;
        }, $overwrite, function($fileBaseName, $formFieldName) {
            $extension = strtolower(substr($fileBaseName, strripos($fileBaseName, ".") + 1));
            $filename = time()."_logo.".$extension;
            return $filename;
        });
        $files = array_keys($files);
        $logo = "/".$files[0];
        
        if(is_array($files)){
            $date = date("Y-m-d");
            DB::sql()->insert("INSERT INTO identity (id,logo,updated) VALUES (1, ?, ?, ?)
               ON DUPLICATE KEY UPDATE logo=?, updated=?;", [$logo, $date, $logo, $date]);
            $result = true;
        }else{
            $result = false;
        }
        
        return $result;
    }
}

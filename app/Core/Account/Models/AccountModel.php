<?php
namespace Core\Account\Models;
use \Core\Base\Database as DB;
class AccountModel {
    private static $instance;
    public $id;
    public $name,$lastname,$fullname;
    public $email,$image,$role;
    public $groups = [];
    public $privileges = [];

    public function __construct() {
        $this->id = \Helpers::session("id");
        $this->loadUserDetails();
        $this->loadUserGroups();
    }

    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new AccountModel();
        }
        return self::$instance;
    }

    private function loadUserDetails() {
        $user = DB::sql()->select("SELECT name, lastname, image, email, role FROM users WHERE id=?", [$this->id]);
        if (!empty($user)) {
            $user = $user[0];
            $this->name = $user["name"];
            $this->lastname = $user["lastname"];
            $this->email = $user["email"];
            $this->role = $user["role"];
            $this->image = empty($user["image"]) ? "default.webp" : $user["image"];
            $this->fullname = $this->name . " " . $this->lastname;
        }
    }

    private function loadUserGroups() {
        $groups = DB::sql()->select("SELECT group_id AS id FROM user_groups WHERE user_id=?", [$this->id]);
        foreach ($groups as $group) {
            $this->groups[] = $group["id"];
            $this->loadPrivileges($group["id"]);
        }
    }

    private function loadPrivileges($groupId) {
        $privileges = DB::sql()->select("SELECT section, operation, status FROM privileges LEFT JOIN groups_privileges ON privileges.id = groups_privileges.idPrivilege WHERE group_id=?", [$groupId]);
        foreach ($privileges as $privilege) {
            if ($privilege["status"] == "1") {
                $section = $privilege["section"];
                $operation = $privilege["operation"];
                $this->privileges[$section][$operation] = true;
            }
        }
    }


    public function update($field, $value) {
        if (property_exists($this, $field)) {
            $this->$field = $value;
            DB::sql()->update("UPDATE users SET $field=? WHERE id=?", [$value, $this->id]);
        }
    }
    
    public function updateName($name) {
        $this->name = $name;
        $this->fullname = $this->name." ".$this->lastname;
        DB::sql()->update("UPDATE users SET name=? WHERE id=?", array($name, $this->id) );
    }

    public function updateLastname($lastname) {
        $this->lastname = $lastname;
        $this->fullname = $this->name." ".$this->lastname;
        DB::sql()->update("UPDATE users SET lastname=? WHERE id=?", array($lastname, $this->id) );
    }   
    public function updateRole($role) {
        $this->role = $role;
        DB::sql()->update("UPDATE users SET role=? WHERE id=?", array($role, $this->id) );
    }
    public function updateEmail($email) {
        $this->email = $email;
        DB::sql()->update("UPDATE users SET email=? WHERE id=?", array($email, $this->id) );
    }
    
    public function updateImage($image){
        $this->image = $image;
        DB::sql()->update("UPDATE users SET image=? WHERE id=?", array($image, $this->id) );
    }
    public function truncateImage(){
        $this->image = "";
        DB::sql()->update("UPDATE users SET image=NULL WHERE id=?", array($this->id) );
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'image' => $this->image,
            'role' => $this->role,
            'groups' => $this->groups,
            'privileges' => $this->privileges
        ];
    }

  
    public function uploadProfilePicture() {
        Helper::set('UPLOADS','img/profile-pictures/');
        $overwrite = true;
        $files = \Web::instance()->receive(function($file, $formFieldName) {

            $extension = substr($file["name"], strripos($file["name"], ".") + 1);
            if (!in_array(strtolower($extension), array("jpg", "jpeg", "png", "webp"))) {
                return ["status" => "error", "message"=>"Estensione non riconosciuta" ];
            }elseif($file['size'] > (10 * 1024 * 1024)){
                return ["status" => "error", "message"=>"File troppo grande" ];
            }     
            return true;
        }, $overwrite, function($fileBaseName, $formFieldName) {
            $extension = strtolower(substr($fileBaseName, strripos($fileBaseName, ".") + 1));
            $filename = time().strtolower(str_replace(" ","-",$this->fullname)).".$extension";
            return $filename;
        });
        $files = array_keys($files);
        return "/".$files[0];
    }
}

<?php
namespace Helpers;
use \Helpers\Generic as Helper;
class Appearance {
    public $idUser;
    public $theme, $language;

    public function __construct(){
        $this->checkTable();
    }

    public static function instance(){
        return new self();
    }

    public function setProprietes($proprieties){
        foreach($proprieties as $key => $propriety){
            $this->$key = $propriety;
        }
    }
    
    public function load() {
        $this->idUser = Helper::session("id");
        $preferences = Database::sql()->select("SELECT * FROM users_preferences WHERE idUser=?", array($this->idUser));
        if(isset($preferences[0])){
            $this->setProprietes($preferences[0]);
        }
        return $this;
    }
    
    public function getTheme() {
        
        $user = Database::sql()->select("SELECT theme FROM users_preferences WHERE idUser=?", array($this->idUser) );
        return $user[0]["theme"] ?? "dark";
    }


    public function updateTheme($theme) {
        $this->theme = $theme;
        Database::sql()->update("UPDATE users_preferences SET theme=? WHERE idUser=?", array($theme, $this->idUser) );
    }

    public function updateLanguage($language) {
        $this->language = $language;
        Database::sql()->update("UPDATE users_preferences SET language=? WHERE idUser=?", array($language, $this->idUser) );
    }

    /**
     * Controllo se la tabella esiste, in caso contrario viene creata dalla funzione sotto
     * @return void
     */
    public function checkTable(){
        $tables = Database::sql()->select("SHOW TABLES LIKE 'users_preferences'");
        if (!$tables OR count($tables) == 0) {
           $this->createTable();
        }
    }
    public function createTable(){
        Database::sql()->create("CREATE TABLE users_preferences (
            idUser int(11) NOT NULL, theme varchar(20) DEFAULT 'dark',  language varchar(2) DEFAULT 'it'
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
        Database::sql()->alter("ALTER TABLE users_preferences ADD PRIMARY KEY (idUser);");
        Database::sql()->alter("ALTER TABLE users_preferences ADD CONSTRAINT users_preferences_ibfk_1 FOREIGN KEY (idUser) REFERENCES users (id);");
    }

    public function toArray(){
        return [
            "theme" => $this->theme,
            "language" => $this->language
        ];
    }

}
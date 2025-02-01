<?php
namespace Core\Languages\Helpers;
class LanguagesHelpers{
    
    public static function current(){
        return $_SESSION["language"] ?? "it";
    }

    
    public static function set($name, $value = "") {
        $core = \Base::instance();
        $core->set("tr.".$name, $value);
        return $value;
    }
    public static function get($field) {
        $core = \Base::instance();
        return $core->get("tr.".$field);
    }
    
    public static function addDictionary($path){
        $f3 = \Base::instance();
        //$dictionaryModulePath = APP_PATH . "/$path/";
        $dictionaries = \Helpers::fetch('LOCALES') ?? "";
        if (file_exists($path)) {
            $dictionaries .= '; '.$path;
            \Helpers::set('LOCALES', $dictionaries);
        }
    }
}

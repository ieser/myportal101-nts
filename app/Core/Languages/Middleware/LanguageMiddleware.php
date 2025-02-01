<?php
namespace Core\Languages\Middleware;
class LanguageMiddleware {
    
    public static function setup(){
        self::setVariables();
        self::loadCoreDictionary();
        
    }
    public static function setVariables(){
        $lang = "it";
        \Helpers::set("lang", $lang);
        \Helpers::set("language", $lang);
        \Helpers::set('PREFIX', 'tr.');
        \Helpers::set('FALLBACK', 'it');
    }
    public static function loadCoreDictionary(){
        $dictionaryCorePath = APP_PATH . "/Core/Base/Dict/";
        if (file_exists($dictionaryCorePath)) {
            \Helpers::set('LOCALES', $dictionaryCorePath );
        }
    }
    
    
}
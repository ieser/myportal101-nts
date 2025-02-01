<?php
namespace Core\Base\Helpers;
class UtilsHelpers {

    public static function post($field, $optional = false) {
        $f3 = \Base::instance();
        $res =  $f3->get("POST." . $field);
        if(!$optional AND empty($res)){
            $f3->error('422');
        }
        return $res;
    }
    
    public static function param($field, $optional = false) {
        $f3 = \Base::instance();
        $param = $f3->get("PARAMS." . $field);
        if(!$optional AND empty($param)){
            $f3->error('422');
        }
        return $param;
    }

    public static function print_array($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    public static function randomstring($lenght) {
        $characters = 'ABCDEFGHILMNOPQRSTYJKXZ1234567890abcdefghilmnopqurstyuxzyv';
        $stringRandom = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $lenght; $i++) {
            $stringRandom .= $characters[mt_rand(0, $max)];
        }
        return $stringRandom;
    }
    
    public static function session($field, $value = "") {
        $core = \Base::instance();
        if (func_num_args() == 1)
            return $core->get("SESSION." . $field);
        else
            $core->set("SESSION." . $field, $value);
    }
    public static function cookie($field, $value = "") {
        $core = \Base::instance();
        if (func_num_args() == 1)
            return $core->get("COOKIE." . $field);
        else
            $core->set("COOKIE." . $field, $value);
    }
    public static function error($code,$message = "") {
        $core = \Base::instance();
        return $core->error($code,$message);
    }
    
    public static function get($field) {
        $core = \Base::instance();
        return $core->get("GET." . $field);
    }
    
    public static function set($name, $value = "") {
        $core = \Base::instance();
        $core->set($name, $value);
        return $value;
    }
    public static function fetch($field) {
        $core = \Base::instance();
        return $core->get($field);
    }

    
    public static function mlreroute($route){
        $ml = \Multilang::instance();
        $ml->reroute($route);
    }
    public static function f3reroute($route){
        $f3 = \Base::instance();
        $f3->reroute($route);
    }
    public static function currentroute(){
        $route = self::param("0");
        return $route;
    }

    public static function clear(){
        $f3 = \Base::instance();
        $f3->clear('SESSION');
    }
    public static function header($field, $value = "") {
        header("$field: $value");
    }
   

    public static function slugify($text, string $divider = '-'){
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
    
}

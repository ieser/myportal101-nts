<?php
namespace Core\Privileges\Helpers;

class PrivilegesHelpers {

    public static function isGranted($section,$operation){
        $privileges = \Helpers::session("privileges");
        return true;
        //return $privileges[$section][$operation] ?? false;
    }

}
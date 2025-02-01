<?php
namespace Core\Base\Helpers;
class CSRFHelpers {

    public static function set() {
        $csrf = \Helpers::randomstring(10);
        \Helpers::set('csrf', $csrf);
        \Helpers::session('csrf', $csrf);
        return true;
    }
    
    public static function check() {
        $getCSRF = \Helpers::get('csrf');
        $postCSRF = \Helpers::post('csrf');
        $sessionCSRF = \Helpers::session('csrf');
        $result = ($sessionCSRF == $getCSRF OR $sessionCSRF == $postCSRF);
        return $result;
    }
}
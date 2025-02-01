<?php
namespace Core\Settings\Models;
use \Core\Base\Database as DB;

class UpdatesModel {

    public function __construct() {
    }

    public static function current() {
        $versionInfo = json_decode(file_get_contents(APP_PATH.'/Core/version.json'), true);
        return $versionInfo;
    }
    
    public static function latest() {
        
        $url = "https://raw.githubusercontent.com/ieser/myportal101/refs/heads/master/version.json";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception("Errore durante il recupero del file: $error");
        }
        curl_close($ch);
        $versionInfo = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Errore nel parsing del JSON: " . json_last_error_msg());
        }
        if (!isset($versionInfo['version'])) {
            throw new \Exception("Errore nella versione recuperata: " . json_last_error_msg());
        }
        
        return $versionInfo;
    }
    
    
    public static function update() {
        
        $url = "https://raw.githubusercontent.com/ieser/myportal101/refs/heads/master/version.json";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception("Errore durante il recupero del file: $error");
        }
        curl_close($ch);
        $versionInfo = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Errore nel parsing del JSON: " . json_last_error_msg());
        }
        if (!isset($versionInfo['version'])) {
            throw new \Exception("Errore nella versione recuperata: " . json_last_error_msg());
        }
        
        return $versionInfo;
    }
}

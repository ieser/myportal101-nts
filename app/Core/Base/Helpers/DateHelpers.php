<?php
namespace Core\Base\Helpers;
class DateHelpers {

    public static function date_encode($it_date) {
        $nd = explode("/", $it_date);
        return implode("-", array($nd[2], $nd[1], $nd[0]));
        //return date("Y-m-d", strtotime($it_date));
    }

    public static function date_decode($us_date) {
        $nd = explode("-", $us_date);
        return implode("/", array($nd[2], $nd[1], $nd[0]));
        //return date("d/m/Y", strtotime($us_date));
    }
    
    public static function when($datetime) {   

        $second = 1;
        $minute = $second * 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $month = $day * 30;
        $delta = time() - strtotime($datetime);
    
        if($delta < 1 * $minute) { return $delta == 1 ? "un secondo fa" : $delta." secondi fa"; }
        if($delta < 2 * $minute) { return "un minuto fa"; }
        if($delta < 45 * $minute) { return floor($delta / $minute)." minuti fa"; }
        if($delta < 90 * $minute) { return "un'ora fa"; } 
        if($delta < 24 * $hour) { return floor($delta / $hour)." ore fa"; }
        if($delta < 48 * $hour) { return "ieri"; }
        if($delta < 30 * $day) { return floor($delta / $day)." giorni fa"; }
        if($delta < 12 * $month) { $months = floor($delta / $day / 30); return $months <= 1 ? "un mese fa" : $months." mesi fa"; }
        else { $years = floor($delta / $day / 365); return $years <= 1 ? "un anno fa" : $years." anni fa"; }
    
    }

}

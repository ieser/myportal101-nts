<?php
namespace Controllers\Backend;
use Models\Utils as ut;
class Logs {

    function __construct() {
    }
    public function all() {
        ut::isGranted("log","read");
        $filters = [];
        $pageNumber = ut::get("pagenumber", true);
        $pageSize = ut::get("pagesize", true);
        $logs = \Models\Log::all($filters, $pageNumber, $pageSize);
        echo json_encode(["status" => "ok", "logs" => $logs]);    
    }
}
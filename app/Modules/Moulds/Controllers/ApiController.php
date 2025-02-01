<?php
namespace Modules\Moulds\Controllers;


use Modules\Moulds\Models\MouldModel as Mould;

class ApiController extends \Core\Base\Controllers\ApiController {

    function __construct() {
    }
    
    public function list() {
        \PrivilegesHelpers::isGranted("moulds","read");
        try {

            $pagenumber = \Helpers::get("pagenumber", true) ?? 0;
            $pagesize = \Helpers::get("pagesize", true) ?? 0;
            $search = \Helpers::get("search", true) ?? 0;

            $moulds = Mould::all(["pagenumber" => $pagenumber, "pagesize" => $pagesize, "search" => $search]);
            $total = Mould::count();
            $this->response(200, [
                "moulds" => $moulds,
                "pagination" => [
                    "total" => $total,
                    "pagenumber" => $pagenumber,
                    "pagesize" => $pagesize,
                ],
            ]);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            $this->response(500, $error);
        }
    }

    public function single(){
        \PrivilegesHelpers::isGranted("moulds","read");
        
        $code = \Helpers::param("mould");
        $mould = new Mould($code);
        $this->response(200, [ "mould"=> $mould->toArray()]);

    }

}
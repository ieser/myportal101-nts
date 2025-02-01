<?php
namespace Modules\Moulds\Controllers;


use Modules\Moulds\Models\MouldModel as Mould;
use Modules\Moulds\Models\MouldWarrantyModel as Warranty;

class WarrantiesApiController extends \Core\Base\Controllers\ApiController {

    function __construct() {
    }
    
    public function list() {
        \PrivilegesHelpers::isGranted("moulds-warranties","read");
        try {
            $mould = \Helpers::param("mould");

            $warranties = Warranty::all($mould);
            $this->response(200, [ "warranties" => $warranties ]);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            $this->response(500, $error);
        }
    }

    public function add(){
        \PrivilegesHelpers::isGranted("moulds-warranties","add");
        try {
            $warranty = new Warranty();

            $warranty->mould = \Helpers::param("mould");
            $warranty->startDate = \Helpers::post("start-date");
            $warranty->startStrokes = \Helpers::post("start-strokes");
            $warranty->guaranteedPart =Helpers::post("guaranteed-part");
            $warranty->guaranteedStrokes = \Helpers::post("guaranteed-strokes");
            $warranty->isTotalWarranty =  \Helpers::post("total", true) ?? 0;
            $warranty->notes = \Helpers::post("notes", true) ?? '';
            $warranty->insert();

            $this->response(200, [ "warranty" => $warranty->toArray() ]);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            $this->response(500, $error);
        }

    }

}
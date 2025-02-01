<?php
namespace Modules\Moulds\Models;
use \Core\Base\Database as DB;
class MouldModel {
    public $No_;
    public $Description;
    public function __construct($No_){
        if ($No_) {
            $this->load($No_);
        }
    }

    public static function all($filters = []){
        $moulds = [];
        $conditions = "";
        $pagination = "";
        $params = [];

        if (!empty($filters["pagenumber"]) && !empty($filters["pagesize"])) {
            $offset = ($filters["pagenumber"] -1) * $filters["pagesize"];
            $pagination = " OFFSET {$offset} ROWS FETCH NEXT {$filters['pagesize']} ROWS ONLY";
        }

        if(!empty($filters["search"])){
            $conditions .= " AND (No_ LIKE ? OR Description LIKE ?)";
            $params[] = "%" . $filters["search"] . "%"; 
            $params[] = "%" . $filters["search"] . "%";
        }

        $moulds = DB::sql("bc")->select("SELECT No_, Description FROM BC_Mould WHERE 1=1 $conditions ORDER BY No_ DESC $pagination;", $params);
        return $moulds;
    }

    public static function instance($id = null) {
        return new self($id);
    }

    private function load($No_) {
        $details = DB::sql("bc")->select("SELECT No_,Description  FROM BC_Mould WHERE No_=? ", array($No_));
        if (isset($details[0])) {
            $data = $details[0];
            $this->No_ = $data['No_']; 
            $this->Description = $data['Description'];
        } else {
            throw new \Exception("error-mould-not-found");
        }
        return $this;
    }


    public function exists() {
        $check = DB::sql()->select("SELECT 1 FROM BC_Mould WHERE No_=?", array($this->No_));
        $exists = count($check) == 1;
        return $exists;
    }

    public static function count() {
        try {
            $result = DB::sql("bc")->select("SELECT COUNT(*) as total FROM BC_Mould");
            return (int)$result[0]['total'];
        } catch (\Exception $e) {
            throw new \Exception("Failed to count moulds: " . $e->getMessage());
        }
    }

    public function toArray() {
        return [
            'No_' => $this->No_,
            'Description' => $this->Description
        ];
    }

}
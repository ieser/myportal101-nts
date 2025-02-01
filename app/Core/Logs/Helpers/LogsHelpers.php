<?php
namespace Core\Logs\Helpers;
class LogsHelpers {
    public $id;
    public $idUser, $action, $datetime;
    public function __construct() {
    }
    public static function insert($action){
        //Database::sql()->insert("INSERT INTO logs (idUser,action) VALUES (?,?);",[$idUser,$action]);
    }
    public static function all($filters = [], $pageNumber = 1, $pageSize = 30){
        $conditions = "";
        $params = [];
        if(isset($filters["idUser"])){
            $conditions = " AND idUser=? ";
            $params[] = $filters["idUser"];
        }

        $limit =  is_numeric($pageSize) ? $pageSize : 1;
        $offset = is_numeric($pageNumber) ? ($pageNumber -1)*$pageSize : 30;

        $logs = Database::sql()->select("SELECT logs.id,logs.action,logs.datetime,users.name,users.lastname,users.email
            FROM logs LEFT JOIN users ON idUser=users.id
                WHERE 1=1 $conditions ORDER BY datetime LIMIT $limit OFFSET $offset ;", $params);
        return $logs;
    }
}
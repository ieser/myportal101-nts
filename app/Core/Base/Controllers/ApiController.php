<?php
namespace Core\Base\Controllers;
class ApiController  {
    public function construct(){
        
    }

    protected function response($statusCode, $data) {
        http_response_code($statusCode);
        if($statusCode == 200){
            $answer = [
                "success" => true,
                "data" => $data
            ];
        }else{
            $answer = [
                "success" => false,
                "error" => $data
            ];
        }
        echo json_encode($answer);
        exit;
    }

}

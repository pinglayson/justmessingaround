<?php

namespace Api;

class BaseApi
{
    public static function returnSuccess($data){
        header('Content-Type: application/json');
        echo json_encode(array(
            "code" => 0,
            "msg" => "success",
            "data" => $data
        ));
        exit();
    }

    public static function returnFailed($data){
        header('Content-Type: application/json');
        echo json_encode(array(
            "code" => 1,
            "msg" => $data
        ));
        exit();
    }
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utilities;


class ResponseProvider {
    const OK_CODE = 200;
    const PRECONDITION_FAILED_CODE = 412;
    const INTERNAL_SERVER_ERROR_CODE = 500;
    
    
    public static function buildResponseMessage($code,$responseBody){
        $response = [];
        $response['responseCode'] = $code;
        $response['responseBody'] = $responseBody;
        return $response;
    }
    
    
}

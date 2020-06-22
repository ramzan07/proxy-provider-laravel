<?php

namespace App\Http\Traits;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Response;

trait ApiService {

    /**
     * jsonErrorResponse method
     * @param type $error
     * @param type $code
     * @return Response
     */
    public function jsonErrorResponse($error, $code = 204) {
        $response = [];
        $response['success'] = false;
        $response['message'] = $error;
        $response['status_code'] = $code;
        return Response::json($response);
    }

    /**
     * jsonSuccessResponse method
     * @param type $msg
     * @param type $data
     * @param type $code
     * @return type
     */
    public function jsonSuccessResponse($msg, $data = [], $code = 200) {
        $response = [];
        $response['success'] = true;
        $response['data'] = $data;
        $response['message'] = $msg;
        $response['status_code'] = $code;
        return Response::json($response);
    }

    /**
     * jsonSuccessResponseWithoutData method
     * @param type $msg
     * @return type
     */
    public function jsonSuccessResponseWithoutData($msg) {
        $response = [];
        $response['success'] = true;
        $response['message'] = $msg;
        return Response::json($response);
    }

}

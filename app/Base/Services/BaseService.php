<?php
namespace App\Base\Services;

class BaseService 
{

    // response methods
    public function error($message, $redirect=null, $http_code=500, $additional=[])
    {
        $additional['http_code'] = $http_code;
        return $this->response('error', $message, $redirect, $additional);
    }

    public function success($message, $redirect=null, $additional=[])
    {
        return $this->response('success', $message, $redirect, $additional);
    }

    protected function response($type, $message, $redirect=null, $additional=[])
    {
        $response = [
            'type' => $type,
            'message' => $message,
            'redirect' => $redirect,
        ];

        if ($additional) {
            $response = array_merge($response, $additional);
        }
        return $response;
    }

}
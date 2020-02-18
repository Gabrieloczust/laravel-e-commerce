<?php

namespace App\Api;

class ApiMessage
{
    public static function errorMessage($message, $code = 1010)
    {
        return [
            'msg' => $message,
            'code' => $code,
        ];
    }
    public static function successMessage($message, $code = 201)
    {
        return [
            'msg' => $message,
            'code' => $code,
        ];
    }
}

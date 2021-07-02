<?php

namespace App\Traits;

trait ResponseTrait
{
    protected function handleResponse($err, $code, $data)
    {

        $res = new \stdClass();
        $res->error_code = $err;
        $res->code = $code;
        $res->data = $data;

        return response()->json($res);

    }
}

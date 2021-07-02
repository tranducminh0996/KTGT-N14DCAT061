<?php


namespace App\Traits;

use App\Exceptions\CustomException;
use Exception;

trait Response
{
    protected $data = [];

    protected $header = [];

    protected $statusCode = 200;

    protected $errors;

    protected $message = "Success";

    protected $exception;

    protected $errorCode = 0;

    public function addData($data)
    {
        $this->data = $data;
    }

    public function setHeaders(array $headers)
    {
        foreach ($headers as $key => $value) {
            $this->header[$key] = $value;
        }

        return $this;
    }

    public function setStatusCode(int $code)
    {
        $this->statusCode = $code;

        return $this;
    }

    public function addErrors(array $errors)
    {
        foreach ($errors as $key => $value) {
            $this->errors[$key] = $value;
        }

        return $this;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    public function setErrorCode(int $errorCode) {
        $this->errorCode = $errorCode;
        return $this;
    }

    public function setException(Exception $e)
    {
        $this->exception = $e;

        return $this;
    }

    public function getResponse()
    {
        $data = [];
        $data["error_code"] = $this->errorCode;
        $data["message"] = $this->message;
        if ($this->data) {
            $data['data'] = $this->data;
        }
        if (env('APP_DEBUG') && $this->exception) {
            $data['debug'] = [
                'message' => $this->exception->getMessage(),
                'code'    => $this->exception->getCode(),
                'file'    => $this->exception->getFile(),
                'line'    => $this->exception->getLine(),
            ];
            if ($this->exception instanceof CustomException) {
                $data['debug']['message'] = $this->exception->getPrivateMessage();
            }
        }
        if (!empty($this->headers)) {
            return response()->json($data, $this->statusCode, $this->header);
        } else {
            return response()->json($data, $this->statusCode);
        }
    }
}

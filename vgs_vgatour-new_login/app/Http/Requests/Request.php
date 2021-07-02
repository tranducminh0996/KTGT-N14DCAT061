<?php

namespace App\Http\Requests;

use App\Traits\JsonResponseTrait;
use App\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends FormRequest
{
    use Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        $this->setErrorCode(2);
        $this->setMessage($error);
        throw new HttpResponseException($this->getResponse());
    }
}

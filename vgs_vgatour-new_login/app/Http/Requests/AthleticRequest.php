<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse as JsonResponse;

class AthleticRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:1|max:50',
            'vga_id' => 'required|numeric|min:0|max:10000000000',
            'country' => 'required|numeric',
            // 'height' => 'required|numeric',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',


        ];
    }
    public function messages()
    {
        return [
            // 'name.required' => 'name is required!',
            // 'name.min' => 'min name!',
            'vga_id.max' => 'Mã VGA không quá 10 ký tự.',
            'vga_id.min' => 'Mã VGA phải là giá trị dương.',
            // 'url.alpha_dash' => 'Link ảnh chỉ có thể chứa chữ cái (không dấu), chữ số và dấu gạch ngang.',

        ];
    }
    public function attributes()
    {
        return [
            'first_name' => 'Tên',
            'vga_id' => 'Mã VGA',
            'country' => 'Quốc tịch',
            // 'height' => 'required|numeric',
            'avatar' => 'Avatar',
        ];
    }


    protected function failedValidation(Validator $validator) 
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}

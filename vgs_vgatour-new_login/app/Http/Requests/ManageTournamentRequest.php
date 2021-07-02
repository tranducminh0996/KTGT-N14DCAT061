<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse as JsonResponse;

class ManageTournamentRequest extends FormRequest
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
            'name' => 'required|min:5|max:255',
            'time' => 'required|numeric|min:2021',
            'facility_id' => 'required|numeric',
            // 'link_livescore' => 'url',
            'number_athletic' => 'numeric',
            'url.*' => 'required|distinct|min:3',

            
        ];
    }
    public function messages()
    {
        return [
            // 'name.required' => 'name is required!',
            // 'name.min' => 'min name!',
            'url.required' => '',
            // 'url.alpha_dash' => 'Link ảnh chỉ có thể chứa chữ cái (không dấu), chữ số và dấu gạch ngang.',
            
        ];
    }
    public function attributes()
{
    return [
        'name' => 'Tên giải đấu',
        'time' => 'Năm',
        'facility_id' => 'Sân thi đấu',
        'link_livescore' => 'Link livescore',
        'number_athletic' => 'Số lượng VĐV',
        'url.*' => '',
    ];
}
    
    
    // protected function failedValidation(Validator $validator) 
    // {

    //     $errors = (new ValidationException($validator))->errors();
    //     throw new HttpResponseException(response()->json(
    //         [
    //             'error' => $errors,
    //             'status_code' => 422,
    //         ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    // }
}

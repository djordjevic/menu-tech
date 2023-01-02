<?php

namespace App\Http\Api\Requests;

use \Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class CalculationRequest extends  FormRequest {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return Config::get('boilerplate.calculation_input.validation_rules');

    }

    public function messages(): array
    {
        return Config::get('boilerplate.calculation_input.validation_messages');
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(422, 'no', response()->json($validator->errors()));
//    }

}

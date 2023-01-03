<?php

namespace App\Http\API\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


/**
 *
 */
class CalculationRequest extends  FormRequest {

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return Config::get('boilerplate.calculation_input.validation_rules');

    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return Config::get('boilerplate.calculation_input.validation_messages');
    }


}

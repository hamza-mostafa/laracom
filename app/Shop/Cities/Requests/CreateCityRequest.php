<?php

namespace App\Shop\Cities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCityRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Todo: need to add multiple rule for naming in cities, checking the city and its province Id
        return [
            'name' => 'required | min:3 | max: 25 | alpha_num',
            'province_id' => 'required | max: 6 | numeric'
        ];
    }
}

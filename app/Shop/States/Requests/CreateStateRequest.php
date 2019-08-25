<?php

namespace App\Shop\Cities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | min:3 | max: 25 | alpha_num',
            'province_id' => 'required | max: 6 | numeric'
        ];
    }
}

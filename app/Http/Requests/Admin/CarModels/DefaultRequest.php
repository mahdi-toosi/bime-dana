<?php

namespace App\Http\Requests\Admin\CarModels;

use Illuminate\Foundation\Http\FormRequest;

class DefaultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'carModel'  =>  'required|exists:car_models,id'
        ];
    }
}

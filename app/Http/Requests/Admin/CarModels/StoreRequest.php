<?php

namespace App\Http\Requests\Admin\CarModels;

use App\Rules\Admin\CheckPlan;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title'     =>  'required|string|unique:car_models,title',
            'carType'   =>  'required|exists:car_types,id',
            'plans'     =>  ['required', 'exists:plans,id', new CheckPlan($this->carType)]
        ];
    }
}

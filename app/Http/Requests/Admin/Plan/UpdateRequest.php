<?php

namespace App\Http\Requests\Admin\Plan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'           =>  'required',
            'car_id'         =>  'required|exists:cars,id',
            'base_price'     =>  'required',
            'driver_price'   =>  'required',
            'daily_penalty'  =>  'required',
        ];
    }
}

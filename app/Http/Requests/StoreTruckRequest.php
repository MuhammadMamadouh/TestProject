<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTruckRequest extends FormRequest
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
            'license' => 'required|string|min:7|max:7',
            'depth' => 'required|numeric|min:1|max:4',
            'height' => 'required|numeric|min:1|max:3',
            'width' => 'required|numeric|min:1|max:2',
            'truck_type'=>'required|exists:trucks_types,id'
        ];
    }
}

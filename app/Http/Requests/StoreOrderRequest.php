<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'sender_name' => 'required|string|max:255',
            'reciever_name' => 'required|string|max:255',
            'truck_id' => 'required|exists:trucks,id',
            'item_name' => 'required|array|min:1',
            'width' => 'required|array|min:1',
            'depth' => 'required|array|min:1',
            'height' => 'required|array|min:1',
            ];
    }

    public function messages()
    {
        return
            [
            'truck_id.required' => 'Truck is Required',
            'item_name.required' => 'Item name is Required',
            'width.required' => 'Item width is Required',
            'height.required' => 'Item Height is Required',
            'depth.required' => 'Item Depth is Required',
            'qty.required' => 'Item Quantity is Required',
        ];
    }
}

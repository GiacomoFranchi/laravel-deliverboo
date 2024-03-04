<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customers_name' => 'required|string',
            'customers_phone_number'=>'required|string',
            'customers_address'=>'required|string',
            'customers_email'=>'required|string',
            'food_items' => 'required|array',
            'food_items.*.id' => 'exists:food_items,id',
            'food_items.*.quantity' => 'integer|min:1'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'name' => 'required', 'min:5', 'max:100',
            'address' => 'required',
            'image' => 'required', 'image', 'max:2048', 
            'vat_number' => 'nullable', 
            'phone_number' => 'required',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'closure_day' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name of the restaurant is required',
            'title.min' => 'Name lenght must be at least of :min letters',
            'title.max' => 'Name lenght must max of :max letters',
            'address.required' => 'Address of the restaurant is required',
            'vat_number.min' => 'VAT number lenght must be at least of :min letters',
            'vat_number.max' => 'VAT number lenght must be at least of :max letters',
            'opening_time.required' => 'Opening time of the restaurant is required',
            'closing_time.required' => 'Closing time of the restaurant is required',
            'closure_day.required' => 'Closing day of the restaurant is required',
            'cover_image.required' => 'Image of the restaurant is required',
        ];
    }
}

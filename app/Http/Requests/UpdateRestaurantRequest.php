<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:100'],
            'address' => ['required'],
            'image' => ['nullable', 'image', 'max:2048'], 
            'vat_number' => ['required', 'min:13' ,'max:13'], 
            'phone_number' => ['required', 'string', 'regex:/^\+?[0-9()\s-]{8,20}$/'],
            'opening_time' => ['required'],
            'closing_time' => ['required'],
            'closure_day' => ['required'],
            'cusine_types' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name of the restaurant is required',
            'title.min' => 'Name lenght must be at least of :min letters',
            'title.max' => 'Name lenght must max of :max letters',
            'image.image' =>'The format of the image is incorrect',
            'vat_number.required' => 'The VAT number is required',
            'vat_number.min' => 'The VAT number must be of 11 numbers',
            'vat_number.max' => 'The VAT number must be of 11 numbers',
            'address.required' => 'Address of the restaurant is required',
            'opening_time.required' => 'Opening time of the restaurant is required',
            'closing_time.required' => 'Closing time of the restaurant is required',
            'closure_day.required' => 'Closing day of the restaurant is required',
            'cusine_types.required' => 'Select at least one type of cuisine',
        ];
    }
}

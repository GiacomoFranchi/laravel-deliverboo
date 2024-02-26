<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFood_itemRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:100'],
            'image' => ['nullable', 'image', 'max:512'],
            'description' => ['required'],
            'price' => ['required','numeric','min:0'],
            'is_visible' => ['required']
        ];
    }
    public function messages(){
        return[
            'name.required' => 'Inserisci il titolo del piatto',
            'description.required' => 'Inserisci la descrizione o il nass ti fa chiudere',
            'name.min' => 'Il titolo può avere minimo :min caratteri',
            'name.max' => 'Il titolo può avere al massimo :max caratteri',
            'image.image' =>'formato errato',
            'image.max' =>'dimensione eccessiva',
            'price.required' => 'Inserisci un prezzo',
            'price.numeric' => 'solo numeri grazie',
            'price.min' => 'Non può essere il prezzo giusto...',
            'is_visible.required' => 'è disponibile o no?'            
        ];
    }
}

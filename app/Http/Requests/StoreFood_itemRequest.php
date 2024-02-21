<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFood_itemRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'max:1512'],
            'description' => ['required'],
            'price' => ['required','numeric','min:0', 'max:999'],
            'is_visible' => ['required'],
            'restaurant_id' => ['exists:restaurants,id'],

        ];
    }

    public function messages(){
        return[
            'name.required' => 'Inserisci il nome del piatto',
            'description.required' => 'Inserisci la descrizione del piatto o i nass i faranno chiudere',
            'name.min' => 'Il titolo può avere minimo :min caratteri',
            'name.max' => 'Il titolo può avere al massimo :max caratteri',
            'image.image' =>'formato errato',
            'image.max' =>'dimensione eccessiva',
            'price.required' => 'Inserisci un prezzo',
            'price.numeric' => 'solo numeri grazie',
            'price.min' => 'Non può essere il prezzo giusto...',
            'price.max' => 'Non può essere il prezzo giusto...',
            'is_visible.required' => 'è disponibile o no?'            
        ];
    }
}

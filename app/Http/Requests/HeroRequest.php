<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
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
            'user_id' => 'required',
            'clan_id' => 'required',
            'name' => 'required|max:255',
            'energy' => 'required|numeric|min:2|max:10',
            'attack' => 'required|numeric|min:2|max:10',
            'defense' => 'required|numeric|min:2|max:10',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo :attribute richiesto',
            'numeric' => 'Campo :attribute numerico',
            'min' => 'Minimo valore per :attribute è :min',
            'max' => 'Massimo valore per :attribute è :max',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'Utente',
            'clan_id' => 'Clan',
            'name' => 'Nome',
            'energy' => 'Energia',
            'attack' => 'Attacco',
            'defense' => 'Difesa',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->energy + $this->attack + $this->defense > 10) {
                $validator->errors()
                    ->add('total', __('validation.abilities_total'))
                ;
            }
        });
    }
}

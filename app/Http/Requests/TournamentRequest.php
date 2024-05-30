<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:2',
            'description' => 'required|max:1000',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }

    // public function messages(): array
    // {
    //     return[
    //         'name.required' => 'El nombre del torneo es obligatorio y ademas debe contener almenos 3 caracteres.', 
    //         'description.required' => 'La descripción del torneo es obligatoria.',
    //         'image.required' => 'La imagen representativa del torneo es obligatoria.'
    //     ];
    // } 
}

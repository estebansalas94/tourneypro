<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'description' => 'required|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
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

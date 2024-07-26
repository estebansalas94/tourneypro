<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:3',
            'coach_name' => 'required|min:5',
            'description' => 'required|max:1000',
        ];
    
        if ($this->isMethod('post')) {
            $rules['shield'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['shield'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
    
        return $rules;
    }
}

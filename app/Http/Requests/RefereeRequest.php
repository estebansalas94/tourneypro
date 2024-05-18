<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefereeRequest extends FormRequest
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
            'name' => 'required|min:3',
            'last_name' => 'required',
            'referee_type' => 'required',
            'nationality' => 'required',
            'description' => 'required|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}

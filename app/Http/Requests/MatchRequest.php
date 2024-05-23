<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
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
            'team_local_id' => 'required|numeric',
            'team_visitor_id' => 'required|numeric',
            'stadium_id' => 'required|numeric',
            'tournament_id' => 'required|numeric',
            'date_at' => 'required|date',
        ];
    }
}

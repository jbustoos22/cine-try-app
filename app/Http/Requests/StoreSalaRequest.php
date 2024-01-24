<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalaRequest extends FormRequest
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
            'numero' => ['required', 'integer', 'max:11'],
            'tipo' => ['required', 'integer', 'max:11'],
            'aforo' => ['required', 'string', 'max:255'],
            'desde' => ['required', 'string', 'max:255'],
            'hasta' => ['required', 'string', 'max:255'],
            'id_pelicula' => ['required', 'integer', 'max:11']
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'codpes' => 'required|integer',
        ];
        return $rules;
    }

    public function messages(){
        return[
            'codpes.required' => 'Número USP é obrigatório',
            'codpes.integer' => 'Número USP precisa ser um valor inteiro',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContaRequest extends FormRequest
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
            #'email' => 'required|email|unique:users,email',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'codpes' => [
                'required',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'name' => 'required',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|min:4|same:password',
            'remember_token' => 'nullable',
            'newsletters' => 'integer',
        ];
        
        return $rules;
    }
}
